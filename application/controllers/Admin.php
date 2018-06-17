<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  //consturctor
  public function index()
	{
    if(!$this->session->has_userdata('user_in') || $this->session->userdata('user_in')['userType'] != "admin")
      redirect('login/'.$this->session->userdata('user_in')['userType']);

    $data['user_in'] = $this->session->userdata('user_in');
		$this->load->view('head');
		$this->load->view('admin\header', $data);
		$this->load->view('admin\nav_main', $data);
		$this->load->view('admin\dashboard');
		$this->load->view('footer');
	}

  public function viewAddTeacher(){
    $data['schools'] = $this->Authentication_data->getSchools();;
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
    $data['schools'] = $this->Authentication_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');
    
    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\edit_teacher', $data);
		$this->load->view('footer');
  }

  public function viewInfoTeacher(){
    echo json_encode($this->Users_data->get_user($this->input->post('id'), $this->input->post('school')));
  }

  public function viewListTeacher($page = 1){
      $params['limit'] =  2;
      $params['offset'] = ($page - 1) * 2;
      $params['userType'] = "teacher";

      $config['base_url'] = base_url()."admin/view/teacher/";
      $config['total_rows'] = $this->Users_data->get_all_users_count();
      $config['num_links'] = $this->Users_data->get_all_users_count();
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
    $data['schools'] = $this->Authentication_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');
    
    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\add_librarian', $data);
    $this->load->view('footer');
  }

  public function viewEditLibrarian(){
    $params['userType'] = "librarian";
    $params['status'] = "deactivated";
    $data['librarian'] = $this->Users_data->get_all_users($params);
    $data['schools'] = $this->Authentication_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');
    
    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\edit_librarian', $data);
    $this->load->view('footer');
  }

  public function viewInfoLibrarian(){
    echo json_encode($this->Users_data->get_user($this->input->post('id'), $this->input->post('school')));
  }

  public function viewListLibrarian($page = 1){
      $params['limit'] =  2;
      $params['offset'] = ($page - 1) * 2;
      $params['userType'] = "librarian";

      $config['base_url'] = base_url()."admin/view/librarian/";
      $config['total_rows'] = $this->Users_data->get_all_users_count();
      $config['num_links'] = $this->Users_data->get_all_users_count();
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
            $id = $this->input->post('userID');
            $params = array(
    					'schoolId' => $this->input->post('schoolId'),
    					'email' => $this->input->post('email'),
    					'firstName' => $this->input->post('firstName'),
    					'middleName' => $this->input->post('middleName'),
    					'lastName' => $this->input->post('lastName'),
            );

            $result = $this->Users_data->updateUser($id,$params);

            if(isset($result["success_message"]))
              $this->session->set_flashdata('success_message', $result["success_message"]);
            else
              $this->session->set_flashdata('error_message', $result["success_message"]);

            $this->session->set_flashdata('user',  $this->input->post());
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
              $id = $this->input->post('userID');
              $params = array(
                'schoolId' => $this->input->post('schoolId'),
                'email' => $this->input->post('email'),
                'firstName' => $this->input->post('firstName'),
                'middleName' => $this->input->post('middleName'),
                'lastName' => $this->input->post('lastName'),
              );

              $result = $this->Users_data->updateUser($id,$params);

              if(isset($result["success_message"]))
                $this->session->set_flashdata('success_message', $result["success_message"]);
              else
                $this->session->set_flashdata('error_message', $result["success_message"]);

              $this->session->set_flashdata('user',  $this->input->post());
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

    $id = $this->input->post('id');
    $params = array(
      'status' => "deactivated",
    );
    $result = $this->Users_data->updateUser($id,$params);

    $params['userType'] = "teacher";
    $result['teachers'] = $this->Users_data->get_all_users($params);

    if(isset($result["success_message"]))
      echo json_encode($result);
    else
      echo json_encode(null);
  }

  public function resetPassword(){
    $id = $this->input->post('id');
    $params = array(
      'password' => "password1234",
    );
    $result = $this->Users_data->updateUser($id,$params);

    if(isset($result["success_message"]))
      echo json_encode($result);
    else
      echo json_encode(null);
  }

}
