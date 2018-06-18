<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  //consturctor
  public function index()
	{
    $data['user_in'] = $this->session->userdata('user_in');
		$this->load->view('head');
		$this->load->view('admin\header', $data);
		$this->load->view('admin\nav_main', $data);
		$this->load->view('admin\dashboard');
		$this->load->view('footer');
	}

  public function viewAddTeacher(){
    $data['schools'] = $this->Users_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\add_teacher', $data);
		$this->load->view('footer');
  }

  public function viewEditTeacher(){
    $params['userType'] = "teacher";
    $params['status'] = "deactivated";
    $data['teachers'] = $this->Users_data->get_all_users($params);
    $data['schools'] = $this->Users_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\edit_teacher', $data);
		$this->load->view('footer');
  }

  public function viewAvailTeacher(){
    $params['school'] = $this->input->post('school');
    $params['userType'] = "teacher";
    $params['status'] = "deactivated";
    echo  json_encode($this->Users_data->get_all_users($params));
  }

  public function viewInfoTeacher(){
    echo json_encode($this->Users_data->get_user($this->input->post('schoolId'), $this->input->post('school')));
  }

  public function viewListTeacher($page = 1){
      $params['limit'] =  2;
      $params['offset'] = ($page - 1) * 2;
      $params['userType'] = "teacher";

      $view["userType"] = "teacher";

      $config['base_url'] = base_url()."admin/view/teacher/";
      $config['total_rows'] = $this->Users_data->get_all_users_count($view);
      $config['num_links'] = $this->Users_data->get_all_users_count($view);
      $config['per_page'] = 2;
      $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';
      $config['last_link'] = FALSE;
      $config['first_link'] = FALSE;
      $this->pagination->initialize($config);
      $data['users'] = $this->Users_data->get_all_users($params);
      $data['user_in'] = $this->session->userdata('user_in');

      $this->load->view('head');
      $this->load->view('admin\header', $data);
      $this->load->view('admin\nav_main', $data);
      $this->load->view('admin\view_teacher', $data);
  		$this->load->view('footer');
  }

  public function viewAddLibrarian(){
    $data['schools'] = $this->Users_data->getSchools();
    $data['user_in'] = $this->session->userdata('user_in');

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\add_librarian', $data);
    $this->load->view('footer');
  }

  public function viewAvailPosition(){
    $school = $this->input->post('school');
    echo  json_encode($this->Users_data->getAvailPosition($school));
  }

  public function viewEditLibrarian(){
    $params['userType'] = "librarian";
    $params['status'] = "deactivated";
    $data['librarian'] = $this->Users_data->get_all_users($params);
    $data['schools'] = $this->Users_data->getSchools();
    $data['user_in'] = $this->session->userdata('user_in');

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\edit_librarian', $data);
    $this->load->view('footer');
  }

  public function viewAvailLibrarian(){
    $params['school'] = $this->input->post('school');
    $params['userType'] = "librarian";
    $params['status'] = "deactivated";
    echo  json_encode($this->Users_data->get_all_users($params));
  }

  public function viewInfoLibrarian(){
    echo json_encode($this->Users_data->get_user($this->input->post('schoolId'), $this->input->post('school')));
  }

  public function viewListLibrarian($page = 1){
      $params['limit'] =  2;
      $params['offset'] = ($page - 1) * 2;
      $params['userType'] = "librarian";

      $view["userType"] = "librarian";

      $config['base_url'] = base_url()."admin/view/librarian/";
      $config['total_rows'] = $this->Users_data->get_all_users_count($view);
      $config['num_links'] = $this->Users_data->get_all_users_count($view);
      $config['per_page'] = 2;
      $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';
      $config['last_link'] = FALSE;
      $config['first_link'] = FALSE;
      $this->pagination->initialize($config);
      $data['users'] = $this->Users_data->get_all_users($params);
      $data['user_in'] = $this->session->userdata('user_in');

      $this->load->view('head');
      $this->load->view('admin\header', $data);
      $this->load->view('admin\nav_main', $data);
      $this->load->view('admin\view_librarian', $data);
      $this->load->view('footer');
  }

  public function addTeacher()
  {
    		$this->form_validation->set_rules('schoolId','SchoolId','required');
    		$this->form_validation->set_rules('email','Email','required|valid_email');
    		$this->form_validation->set_rules('firstName','FirstName','required');
    		$this->form_validation->set_rules('lastName','LastName','required');
    		$this->form_validation->set_rules('school','School','required');

    		if($this->form_validation->run())
        {
            $params = array(
      				'userType' => 'teacher',
      				'school' => $this->input->post('school'),
      				'schoolId' => $this->input->post('schoolId'),
      				'email' => $this->input->post('email'),
      				'firstName' => $this->input->post('firstName'),
      				'middleName' => $this->input->post('middleName'),
      				'lastName' => $this->input->post('lastName'),
            );

        $result = $this->Users_data->addUser($params);
        if(isset($result["error_message"]))
          $this->session->set_flashdata('error_message',  $result["error_message"]);
        else
          $this->session->set_flashdata('result', $result);
        redirect('admin/add/teacher');
      }
      else
      {
          $data['error_message'] = validation_errors();
          $data['error_message'] = explode("</p>", $data['error_message']);
          $this->session->set_flashdata('error_message',  $data['error_message'][0]);
          redirect('admin/add/teacher');
      }
  }

  public function editTeacher()
  {
        $this->form_validation->set_rules('schoolId','SchoolId','required');
  			$this->form_validation->set_rules('email','Email','required|valid_email');
  			$this->form_validation->set_rules('firstName','FirstName','required');
  			$this->form_validation->set_rules('lastName','LastName','required');

  			if($this->form_validation->run())
        {
            $initial = array(
              'schoolId' => $this->input->post('userID'),
              'school' => $this->input->post('userSchool'),
              'userType' => "teacher",
            );
            $params = array(
    					'schoolId' => $this->input->post('schoolId'),
    					'email' => $this->input->post('email'),
    					'firstName' => $this->input->post('firstName'),
    					'middleName' => $this->input->post('middleName'),
    					'lastName' => $this->input->post('lastName'),
            );
            $result = $this->Users_data->updateUser($initial,$params);

            if(isset($result["success_message"]))
              $this->session->set_flashdata('success_message', $result["success_message"]);
            else
              $this->session->set_flashdata('error_message', $result["error_message"]);

            $this->session->set_flashdata('user',  $this->input->post());

            $params = array();
            $params['school'] = $this->input->post('userSchool');
            $params['userType'] = "teacher";
            $params['status'] = "deactivated";

            $this->session->set_flashdata('teachers',  $this->Users_data->get_all_users($params));

            redirect('admin/edit/teacher');
        }
        else
        {
          $data['error_message'] = validation_errors();
          $data['error_message'] = explode("</p>", $data['error_message']);
          $this->session->set_flashdata('error_message',  $data['error_message'][0]);
          $this->session->set_flashdata('user',  $this->input->post());
          redirect('admin/edit/teacher');
        }
  }

  public function addLibrarian()
  {
      $this->form_validation->set_rules('schoolId','SchoolId','required');
      $this->form_validation->set_rules('email','Email','required|valid_email');
      $this->form_validation->set_rules('firstName','First Name','required');
      $this->form_validation->set_rules('lastName','Last Name','required');
      $this->form_validation->set_rules('school','School','required');
      $this->form_validation->set_rules('userLevel','User Level','required');

      if($this->form_validation->run())
      {
          $params = array(
            'userType' => 'librarian',
            'userLevel' => $this->input->post('userLevel'),
            'school' => $this->input->post('school'),
            'schoolId' => $this->input->post('schoolId'),
            'email' => $this->input->post('email'),
            'firstName' => $this->input->post('firstName'),
            'middleName' => $this->input->post('middleName'),
            'lastName' => $this->input->post('lastName'),
          );

          $result = $this->Users_data->addUser($params);
          if(isset($result["error_message"]))
            $this->session->set_flashdata('error_message',  $result["error_message"]);
          else
            $this->session->set_flashdata('result', $result);
          redirect('admin/add/librarian');
      }
      else
      {
          $data['error_message'] = validation_errors();
          $data['error_message'] = explode("</p>", $data['error_message']);
          $this->session->set_flashdata('error_message',  $data['error_message'][0]);
          redirect('admin/add/librarian');
      }
  }

  public function editLibrarian()
    {
          $this->form_validation->set_rules('schoolId','SchoolId','required');
          $this->form_validation->set_rules('email','Email','required|valid_email');
          $this->form_validation->set_rules('firstName','FirstName','required');
          $this->form_validation->set_rules('lastName','LastName','required');

          if($this->form_validation->run())
          {
              $initial = array(
                'schoolId' => $this->input->post('userID'),
                'school' => $this->input->post('userSchool'),
                'userType' => "librarian",
              );
              $params = array(
                'schoolId' => $this->input->post('schoolId'),
                'email' => $this->input->post('email'),
                'firstName' => $this->input->post('firstName'),
                'middleName' => $this->input->post('middleName'),
                'lastName' => $this->input->post('lastName'),
              );

              $result = $this->Users_data->updateUser($initial, $params);

              if(isset($result["success_message"]))
                $this->session->set_flashdata('success_message', $result["success_message"]);
              else
                $this->session->set_flashdata('error_message', $result["error_message"]);

              $this->session->set_flashdata('user',  $this->input->post());

              $params = array();
              $params['school'] = $this->input->post('userSchool');
              $params['userType'] = "librarian";
              $params['status'] = "deactivated";

              $this->session->set_flashdata('librarian',  $this->Users_data->get_all_users($params));

              redirect('admin/edit/librarian');
          }
          else
          {
            $data['error_message'] = validation_errors();
            $data['error_message'] = explode("</p>", $data['error_message']);
            $this->session->set_flashdata('error_message',  $data['error_message'][0]);
            $this->session->set_flashdata('user',  $this->input->post());
            redirect('admin/edit/librarian');
          }
    }



  public function deactivateUser(){

    $initial = array(
      'schoolId' => $this->input->post('id'),
      'school' => $this->input->post('school'),
      'userType' => ucfirst($this->input->post('userType')),
    );
    $params = array(
      'status' => "deactivated",
    );
    $result = $this->Users_data->updateUser($initial,$params);

    $params['userType'] = "teacher";
    $result['teachers'] = $this->Users_data->get_all_users($params);

    if(isset($result["success_message"]))
      echo json_encode($result);
    else
      echo json_encode(null);
  }

  public function resetPassword(){
    $initial = array(
      'schoolId' => $this->input->post('id'),
      'school' => $this->input->post('school'),
      'userType' => ucfirst($this->input->post('userType')),
    );
    $params = array(
      'password' => "password1234",
    );
    $result = $this->Users_data->updateUser($initial,$params);

    if(isset($result["success_message"]))
      echo json_encode($result);
    else
      echo json_encode(null);
  }

  private function _checkAdminRights(){
    if(isset($this->session->userdata['user_in']) &&
        $this->session->userdata['user_in']['userType'] == 'student'){
      redirect('student'); //student
    }
    else if(isset($this->session->userdata['user_in']) &&
        $this->session->userdata['user_in']['userType'] == 'teacher'){
      redirect('teacher'); //teacher
    }
    else if(isset($this->session->userdata['user_in']) &&
        $this->session->userdata['user_in']['userType'] == 'librarian'){
      redirect('librarian'); //librarian
    }
    else{
      redirect("OPAC");
    }
  }

}
