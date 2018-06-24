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

  public function viewEditTeacher($id = "", $school = ""){
    $data['schools'] = $this->Users_data->getSchools();
    $data['user_in'] = $this->session->userdata('user_in');

    if(isset($this->session->userdata['user'])){
      $data['user'] = $this->session->userdata['user'];
    }

    if(isset($this->session->userdata['teachers']))
      $data['teachers'] = $this->session->userdata('teachers');
    else{
      $params['userType'] = "teacher";
      $params['status'] = "deactivated";
      $data['teachers'] = $this->Users_data->get_all_users($params);
    }

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
      $params['limit'] =  5;
      $params['offset'] = ($page - 1) * 5;
      $params['userType'] = "teacher";

      $view["userType"] = "teacher";

      $config['base_url'] = base_url()."admin/view/teacher/";
      $config['total_rows'] = $this->Users_data->get_all_users_count($view);
      $config['num_links'] = $this->Users_data->get_all_users_count($view);
      $config['per_page'] = 5;
      $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';
      $config['last_link'] = FALSE;
      $config['first_link'] = FALSE;
      $this->pagination->initialize($config);
      $data['users'] = $this->Users_data->get_all_users($params);
      $data['schools'] = $this->Users_data->getSchools();
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
    $data['schools'] = $this->Users_data->getSchools();
    $data['user_in'] = $this->session->userdata('user_in');

    if(isset($this->session->userdata['librarians']))
      $data['librarians'] = $this->session->userdata('librarians');
    else{
      $params['userType'] = "librarian";
      $params['status'] = "deactivated";
      $data['librarians'] = $this->Users_data->get_all_users($params);
    }

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
      $params['limit'] =  5;
      $params['offset'] = ($page - 1) * 5;
      $params['userType'] = "librarian";

      $view["userType"] = "librarian";

      $config['base_url'] = base_url()."admin/view/librarian/";
      $config['total_rows'] = $this->Users_data->get_all_users_count($view);
      $config['num_links'] = $this->Users_data->get_all_users_count($view);
      $config['per_page'] = 5;
      $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';
      $config['last_link'] = FALSE;
      $config['first_link'] = FALSE;
      $this->pagination->initialize($config);
      $data['users'] = $this->Users_data->get_all_users($params);
      $data['schools'] = $this->Users_data->getSchools();
      $data['user_in'] = $this->session->userdata('user_in');

      $this->load->view('head');
      $this->load->view('admin\header', $data);
      $this->load->view('admin\nav_main', $data);
      $this->load->view('admin\view_librarian', $data);
      $this->load->view('footer');
  }

  public function viewAddStudent(){
    $data['schools'] = $this->Users_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\add_student', $data);
		$this->load->view('footer');
  }

  public function viewEditStudent(){
    $data['schools'] = $this->Users_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');

    if(isset($this->session->userdata['students']))
      $data['students'] = $this->session->userdata('students');
    else{
      $params['userType'] = "student";
      $params['status'] = "deactivated";
      $data['student'] = $this->Users_data->get_all_users($params);
    }

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\edit_student', $data);
		$this->load->view('footer');
  }

  public function viewAvailStudent(){
    $params['school'] = $this->input->post('school');
    $params['userType'] = "student";
    $params['status'] = "deactivated";
    echo  json_encode($this->Users_data->get_all_users($params));
  }

  public function viewInfoStudent(){
    echo json_encode($this->Users_data->get_user($this->input->post('schoolId'), $this->input->post('school')));
  }

  public function viewListStudent($page = 1){
      $params['limit'] =  5;
      $params['offset'] = ($page - 1) * 5;
      $params['userType'] = "student";

      $view["userType"] = "student";

      $config['base_url'] = base_url()."admin/view/student/";
      $config['total_rows'] = $this->Users_data->get_all_users_count($view);
      $config['num_links'] = $this->Users_data->get_all_users_count($view);
      $config['per_page'] = 5;
      $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';
      $config['last_link'] = FALSE;
      $config['first_link'] = FALSE;
      $this->pagination->initialize($config);
      $data['users'] = $this->Users_data->get_all_users($params);
      $data['schools'] = $this->Users_data->getSchools();
      $data['user_in'] = $this->session->userdata('user_in');

      $this->load->view('head');
      $this->load->view('admin\header', $data);
      $this->load->view('admin\nav_main', $data);
      $this->load->view('admin\view_student', $data);
  		$this->load->view('footer');
  }

  public function viewAddSchool(){
    $data['user_in'] = $this->session->userdata('user_in');

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\add_school', $data);
    $this->load->view('footer');
  }

  public function viewEdiSchool(){
    $data['schools'] = $this->Users_data->getSchools();;
    $data['user_in'] = $this->session->userdata('user_in');

    if(isset($this->session->userdata['students']))
      $data['students'] = $this->session->userdata('students');
    else{
      $params['userType'] = "student";
      $params['status'] = "deactivated";
      $data['student'] = $this->Users_data->get_all_users($params);
    }

    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\edit_student', $data);
    $this->load->view('footer');
  }

  public function viewAvailSchool(){
    $params['school'] = $this->input->post('school');
    $params['status'] = "deactivated";
    echo  json_encode($this->Users_data->get_all_users($params));
  }

  public function viewInfoSchool(){
    echo json_encode($this->Users_data->get_user($this->input->post('schoolId'), $this->input->post('school')));
  }

  public function viewListSchool($page = 1){
      $params['limit'] =  5;
      $params['offset'] = ($page - 1) * 5;
      $params['userType'] = "student";

      $view["userType"] = "student";

      $config['base_url'] = base_url()."admin/view/student/";
      $config['total_rows'] = $this->Users_data->get_all_users_count($view);
      $config['num_links'] = $this->Users_data->get_all_users_count($view);
      $config['per_page'] = 5;
      $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';
      $config['last_link'] = FALSE;
      $config['first_link'] = FALSE;
      $this->pagination->initialize($config);
      $data['users'] = $this->Users_data->get_all_users($params);
      $data['schools'] = $this->Users_data->getSchools();
      $data['user_in'] = $this->session->userdata('user_in');

      $this->load->view('head');
      $this->load->view('admin\header', $data);
      $this->load->view('admin\nav_main', $data);
      $this->load->view('admin\view_student', $data);
      $this->load->view('footer');
  }

  public function viewDefaultSettings(){
    $data['user_in'] = $this->session->userdata('user_in');
    if(isset($this->session->userdata['school'])){
      $data["setting"] = $this->Schools_data->getSchoolSetting($this->session->userdata['school']["id"]);
      $data['school'] = $this->Schools_data->getSchool($this->session->userdata['school']["schoolID"]);
    }
    else if(isset($this->session->userdata['setting'])){
      $data["setting"] = $this->session->userdata['setting'];
      $data['school'] = $this->Schools_data->getSchool($this->session->userdata['setting']["school"]);
    }
    echo "asn". floatval(0.00);
    echo "asn". intval(0);
    $this->load->view('head');
    $this->load->view('admin\header', $data);
    $this->load->view('admin\nav_main', $data);
    $this->load->view('admin\add_setting', $data);
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

            $this->session->set_flashdata('librarians',  $this->Users_data->get_all_users($params));

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

  public function addStudent()
  {
        $this->form_validation->set_rules('schoolId','SchoolId','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('firstName','FirstName','required');
        $this->form_validation->set_rules('lastName','LastName','required');
        $this->form_validation->set_rules('school','School','required');

        if($this->form_validation->run())
        {
            $params = array(
              'userType' => 'student',
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
        redirect('admin/add/student');
      }
      else
      {
          $data['error_message'] = validation_errors();
          $data['error_message'] = explode("</p>", $data['error_message']);
          $this->session->set_flashdata('error_message',  $data['error_message'][0]);
          redirect('admin/add/student');
      }
	}

	public function editStudent()
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
              'userType' => "student",
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
            $params['userType'] = "student";
            $params['status'] = "deactivated";

            $this->session->set_flashdata('students',  $this->Users_data->get_all_users($params));
            redirect('admin/edit/student');
        }
        else
        {
          $data['error_message'] = validation_errors();
          $data['error_message'] = explode("</p>", $data['error_message']);
          $this->session->set_flashdata('error_message',  $data['error_message'][0]);
          $this->session->set_flashdata('user',  $this->input->post());
          redirect('admin/edit/student');
        }
	}

  public function addSchool()
  {
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('address','Address','required');
        $this->form_validation->set_rules('id','ID','required');

        $params = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'contact' => $this->input->post('contact'),
        );

        if($this->form_validation->run())
        {
          if($this->Schools_data->checkID($this->input->post("id"))){
            $data['error_message'] = "ID ( " . $this->input->post("id") . " ) Already Exists";
            $this->session->set_flashdata('error_message',  $data['error_message']);
            $this->session->set_flashdata('school', $params);
            redirect('admin/add/school');
          }

          if(empty($this->input->post["contact"])) $params["contact"] = null;

          $result = $this->Schools_data->addSchool($params);

          if(isset($result["error_message"])){
            $this->session->set_flashdata('error_message',  $result["error_message"]);
            $this->session->set_flashdata('school', $params);
            redirect('admin/add/school');
          }
          else{
            $this->session->set_flashdata('school', $result);
            redirect('admin/add/school/settings');
          }
		}
		else
		{
			$data['error_message'] = validation_errors();
			$data['error_message'] = explode("</p>", $data['error_message']);
			$this->session->set_flashdata('error_message',  $data['error_message'][0]);
			redirect('admin/add/school');
		}
	}

	public function addSettings()
  {
		$this->form_validation->set_rules('school','School ID','required');
		$this->form_validation->set_rules('days_teacher','Allowable Borrowing Period for Teacher','required|integer');
		$this->form_validation->set_rules('days_student','Allowable Borrowing Period for Student','required|integer');
		$this->form_validation->set_rules('days_outsider','Allowable Borrowing Period for Outsider','required|integer');
		$this->form_validation->set_rules('num_teacher','Borrowing Limit of Teacher','required|integer');
		$this->form_validation->set_rules('num_student','Borrowing Limit of Student','required|integer');
		$this->form_validation->set_rules('num_outsider','Borrowing Limit of Outsider','required|integer');
		$this->form_validation->set_rules('lost_teacher','Penalty for Lost Book of Teacher','required');
		$this->form_validation->set_rules('lost_student','Penalty for Lost Book of Student','required');
		$this->form_validation->set_rules('lost_outsider','Penalty for Lost Book of Outsider','required');
		$this->form_validation->set_rules('fines_teacher','Penalty for Overdue Books of Teacher','required');
		$this->form_validation->set_rules('fines_student','Penalty for Overdue Books of Student','required');
		$this->form_validation->set_rules('fines_outsider','Penalty for Overdue Books of Outsider','required');
		$this->form_validation->set_rules('broken_teacher','Penalty for damaged book of Teacher','required');
		$this->form_validation->set_rules('broken_student','Penalty for damaged book of Student','required');
		$this->form_validation->set_rules('broken_outsider','Penalty for damaged book of Outsider','required');

    $params = array(
      'id' => $this->input->post('id'),
      'school' => $this->input->post('school'),
      'days_teacher' => $this->input->post('days_teacher'),
      'days_student' => $this->input->post('days_student'),
      'days_outsider' => $this->input->post('days_outsider'),
      'num_teacher' => $this->input->post('num_teacher'),
      'num_student' => $this->input->post('num_student'),
      'num_outsider' => $this->input->post('num_outsider'),
      'lost_teacher' => $this->input->post('lost_teacher'),
      'lost_student' => $this->input->post('lost_student'),
      'lost_outsider' => $this->input->post('lost_outsider'),
      'fines_teacher' => $this->input->post('fines_teacher'),
      'fines_student' => $this->input->post('fines_student'),
      'fines_outsider' => $this->input->post('fines_outsider'),
      'broken_teacher' => $this->input->post('broken_teacher'),
      'broken_student' => $this->input->post('broken_student'),
      'broken_outsider' => $this->input->post('broken_outsider'),
    );
    $checkSettingValue = $this->_checkSettingValue($params);

    if($checkSettingValue){
      $this->session->set_flashdata('setting', $params);
  		$this->session->set_flashdata('error_message',  $checkSettingValue);
      redirect('admin/add/school/settings');
    }
		else if($this->form_validation->run())
    {
    		$result = $this->Schools_data->updateSetting($params);

        if(isset($result["error_message"])){
          $this->session->set_flashdata('setting', $params);
    			$this->session->set_flashdata('error_message',  $result["error_message"]);
    			redirect('admin/add/school/settings');
    		}
    		else{
    				$this->session->set_flashdata('result', $result);
    				redirect('admin/add/settings');
    			}
    }
    else
    {
      $this->session->set_flashdata('setting', $params);
      $data['error_message'] = validation_errors();
  		$data['error_message'] = explode("</p>", $data['error_message']);
  		$this->session->set_flashdata('error_message',  $data['error_message'][0]);
  		redirect('admin/add/school/settings');
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
    else if (strpos($result["error_message"], 'has no changes') !== false){
      $result["error_message"] = str_replace("has no changes", "has reset password already", $result["error_message"]);
      echo json_encode($result);
    }
    else
      echo json_encode(null);
  }

  private function _checkSettingValue($params){
    if(!floatval($params["lost_teacher"]) && !intval($params["lost_teacher"]) && $params["lost_teacher"] != "0"){
      return "Penalty for Lost Books of Teacher must be numeric / decimal";
    }
    else if(!floatval($params["lost_student"]) && !intval($params["lost_student"]) && $params["lost_student"] != "0"){
      return "Penalty for Lost Books of Student must be numeric / decimal";
    }
    else if(!floatval($params["lost_outsider"]) && !intval($params["lost_outsider"]) && $params["lost_outsider"] != "0"){
      return "Penalty for Lost Books of Outsider must be numeric / decimal";
    }
    else if(!floatval($params["fines_teacher"]) && !intval($params["fines_teacher"]) && $params["fines_teacher"] != "0"){
      return "Penalty for Overdue Books of Teacher must be numeric / decimal";
    }
    else if(!floatval($params["fines_student"]) && !intval($params["fines_student"]) && $params["fines_student"] != "0"){
      return "Penalty for Overdue Books of Student must be numeric / decimal";
    }
    else if(!floatval($params["fines_outsider"]) && !intval($params["fines_outsider"]) && $params["fines_outsider"] != "0"){
      return "Penalty for Overdue Books of Outsider must be numeric / decimal";
    }
    else if(!floatval($params["broken_teacher"]) && !intval($params["broken_teacher"]) && $params["broken_teacher"] != "0"){
      return "Penalty for damaged Books of Teacher must be numeric / decimal";
    }
    else if(!floatval($params["broken_student"]) && !intval($params["broken_student"]) && $params["broken_student"] != "0"){
      return "Penalty for damaged Books of Student must be numeric / decimal";
    }
    else if(!floatval($params["broken_outsider"]) && !intval($params["broken_outsider"]) && $params["broken_outsider"] != "0"){
      return "Penalty for damaged Books of Outsider must be numeric / decimal";
    }
    else{
      return false;
    }
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
