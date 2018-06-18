<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_data extends CI_Model{

  public function getSchools(){
    $this->db->select('id, name');
    $query = $this->db->get('schools');
    if($query->num_rows() > 0){
      $result = $query->result_array();
      return $result;
    }
    else{
      return null;
    }
  }

  function getAvailPosition($school){
    $data = array();
    for ($position=1; $position < 4; $position++) {
      $this->db->where('school', $school);
      $this->db->where('status !=', "deactivated" );
      $this->db->where('userLevel', $position );
      $query = $this->db->get('users');

      array_push($data, $query->num_rows());
    }

    return $data;
  }

  /*
   * Get user by id
   */
  function get_user($id, $school)
  {
      return $this->db->get_where('users',array('schoolId'=>$id, 'school' => $school))->row_array();
  }

  /*
   * Get all users count
   */
  function get_all_users_count($params)
  {
      $this->db->order_by('id', 'desc');
      if(isset($params) && !empty($params))
      {
        if(isset($params['userType']))
          $this->db->where("userType", $params['userType']);
        if(isset($params['status']))
          $this->db->where("status", $params['status']);
        if(isset($params['school']))
          $this->db->where("school", $params['school']);
      }
      $this->db->from('users');
      return $this->db->count_all_results();
  }

  /*
   * Get all users
   */
  function get_all_users($params = array())
  {
      $this->db->order_by('id', 'desc');
      if(isset($params) && !empty($params))
      {
        if(isset($params['limit']) && isset($params['offset']))
          $this->db->limit($params['limit'], $params['offset']);
        if(isset($params['userType']))
          $this->db->where("userType", $params['userType']);
        if(isset($params['status']))
          $this->db->where("status !=", $params['status']);
        if(isset($params['school']))
          $this->db->where("school", $params['school']);
      }
      return $this->db->get('users')->result_array();
  }

  public function addUser($params)
  {
    if($this->_checkSchoolId($params)){
      $data['error_message'] = "School I.D. already used";
      return $data;
    }
    else if($this->_checkEmail($params)){
      $data['error_message'] = "Email is already used";
      return $data;
    }
    else if($params['userType'] == "librarian" && $this->_checkPosition($params)){
      $data['error_message'] = "Position Not Available";
      return $data;
    }
    else{
      $params['id'] = $this->_createNewID("users");
      $this->db->insert('users',$params);
      if($this->db->affected_rows() === 1) {
        $res = $this->_emailTransaction($params, "registration");
        if(!isset($res['error_message']))
            return $params;
        else
            return $res;
      }
      else{
        $data['error_message'] = "Error in registration";
        return $data;
      }
    }
  }

  function updateUser($initial, $params)
  {
      $this->db->where($initial);
      $this->db->update('users',$params);

      if($this->db->affected_rows() === 1 && isset($params["schoolId"])) {
        $data["success_message"] = $params["schoolId"]." Successfully updated";
      }
      else if($this->db->affected_rows() === 1) {
        $data["success_message"] = $initial["schoolId"]." Successfully updated";
      }
      else if($this->db->affected_rows() === 0) {
        $data["error_message"] = $initial["schoolId"]." has no changes";
      }
      else{
        $data["error_message"] = "Database Error";
      }

      return $data;
  }

  private function _checkSchoolId($data){
    $this->db->where('schoolId', $data["schoolId"]);
    $this->db->where('school', $data['school']);
    $this->db->where('status !=', "deactivated" );
    $query = $this->db->get('users');
    if($query->num_rows() == 1){
      return true;
    }
    else{
      return false;
    }
  }

  private function _checkEmail($data){
    $this->db->where('email', $data["email"]);
    $this->db->where('school', $data['school']);
    $this->db->where('status !=', "deactivated" );
    $query = $this->db->get('users');
    if($query->num_rows() == 1){
      return true;
    }
    else{
      return false;
    }
  }

  private function _checkPosition($data){

    $allowedPeople = 0;
    $this->db->where('school', $data['school']);
    $this->db->where('status !=', "deactivated" );

    if($data['userLevel'] == 3){
      $allowedPeople = 1;
      $this->db->where('userLevel', 3);
      $this->db->where('userType', "librarian");
    }
    else if($data['userLevel'] == 2){
      $allowedPeople = 5;
      $this->db->where('userLevel', 2);
      $this->db->where('userType', "librarian");
    }
    else if($data['userLevel'] == 1){
      $allowedPeople = 10;
      $this->db->where('userLevel', 1);
      $this->db->where('userType', "librarian");
    }
    $query = $this->db->get('users');
    if($query->num_rows() >= $allowedPeople){
      return true;
    }
    else{
      return false;
    }
  }

  private function _emailTransaction($data, $purpose){
    $emailData["id"] = $this->_createNewID("email_record");
    $data["emailId"] = $emailData["id"];
    if($purpose == "registration"){
      $currDate = new DateTime('now', new DateTimeZone('Asia/Manila'));
      $newDate = $currDate->modify("+5 day");

      $emailData["receiverId"] = $data["id"];
      $emailData["receiverEmail"] = $data["email"];
      $emailData["purpose"] = $purpose;
      $emailData["validityPeriod"] = $newDate->format('Y-m-d H:i:s');
    }

    if($this->_registerEmail($data)){
      $this->db->insert("email_record", $emailData);
    }
    else{
      $emailData["status"] = "error";
      $this->db->insert("email_record", $emailData);
    }

    if($this->db->affected_rows() === 1 && !isset($emailData["status"]))
        return $data;
    else if($this->db->affected_rows() === 1 && isset($emailData["status"])){
        $error['error_message'] = "Email confirmation Error <br>
                                  We will send you another confirmation email later.<br>
                                  Thank you!";
        return $error;
    }
    else {
      $error['error_message'] = "Email confirmation Error<br>
                                We will send you another confirmation email later.<br>
                                Thank you!";
      return $error;
    }
  }

  private function _registerEmail($data){
    $mail['protocol']='smtp';
    $mail['smtp_host']='ssl://smtp.gmail.com';
    $mail['smtp_port']= 465; // ssl - 465 none - 587
    $mail['smtp_timeout']='30';
    $mail['smtp_user']='ana.tolentino8991@gmail.com';
    $mail['smtp_pass']='MGrey_32';
    $mail['charset']='utf-8';
    $mail['newline']="\r\n";
    $mail['mailtype']="html";
    $mail['wordwrap'] = TRUE;
    $this->email->initialize($mail);

    $this->email->from('ana.tolentino8991@gmail.com', 'Library System Admin');
    $this->email->to($data["email"]);
    $this->email->subject("Welcome To Library System!");
    $this->email->message($this->load->view('emails/new_teacher', $data, true));

    if($this->email->send()) return true;
    else print_r('Email conformation Error: '.$this->email->print_debugger());
  }

  private function _createNewID($table){
    $this->db->select("id");
    $this->db->order_by("id", "ASC");
    $query = $this->db->get($table);
    $id = date("Y");

    if($table == "users"){
      $id .= "U";
    }
    else if($table == "email_record"){
      $id .= "E";
    }

    if($query->num_rows() == 0){
      $id .= "00001";
    }
    else{
      $row = $query->last_row('array');
      $id .= substr(((substr($row['id'], 5) + 100000) + 1), 1);
    }
    return $id;
  }

}
