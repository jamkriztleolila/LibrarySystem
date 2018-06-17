<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Books_data extends CI_Model{
	public function getBookData($id)
    {
        return $this->db->get_where('book_data',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all book_data count
     */
    public function getBookCount($school)
    {
    	$this->db->where("schoolId", $school);
        $this->db->from('book_data');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all book_data
     */
    public function getAllBookData($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);

            if(isset($params['school']))
            	$this->db->where("schoolId", $params['school']);
        }
        return $this->db->get('book_data')->result_array();
    }
        
    /*
     * function to add new book_datum
     */
    public function addBookData($params)
    {
    	$params['id'] = $this->_createNewID("book_data");
        $this->db->insert('book_data',$params);
        if($this->db->affected_rows() === 1) {
        	return $params['id'];
	    }
		else{
			$data['error_message'] = "Error in Inserting new Book";
			return $data;
		}
    }
    
    /*
     * function to update book_datum
     */
    public function updateBookData($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('book_data',$params);
    }

    private function _createNewID($table){
    $this->db->select("id");
    $this->db->order_by("id", "ASC");
    $query = $this->db->get($table);
    $id = date("Y");

    if($table == "book_data"){
      $id .= "B";
    }
    else if($table == "book_record"){
      $id .= "A";
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