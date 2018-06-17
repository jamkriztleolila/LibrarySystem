<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Librarian extends CI_Controller {
  //consturctor
  public function index()
	{
    if(!$this->session->has_userdata('user_in') || $this->session->userdata('user_in')['userType'] != "librarian")
      redirect('login/'.$this->session->userdata('user_in')['userType']);

		$data['user_in'] = $this->session->userdata('user_in');
    $this->load->view('head');
    $this->load->view('librarian\header', $data);
    $this->load->view('librarian\nav_main', $data);
    $this->load->view('librarian\dashboard');
		$this->load->view('footer');
	}

  public function viewAddTeacher(){
    $data['schools'] = $this->Authentication_data->getSchools();

    $data['user_in'] = $this->session->userdata('user_in');
    $this->load->view('head');
    $this->load->view('librarian\header', $data);
    $this->load->view('librarian\nav_main', $data);
    $this->load->view('librarian\add_teacher', $data);
		$this->load->view('footer');
  }

  public function viewEditTeacher(){
    $params['userType'] = "teacher";
    $params['status'] = "deactivated";
    $data['teachers'] = $this->Users_data->get_all_users($params);
    $data['schools'] = $this->Authentication_data->getSchools();;

    $data['user_in'] = $this->session->userdata('user_in');
    $this->load->view('head');
    $this->load->view('librarian\header', $data);
    $this->load->view('librarian\nav_main', $data);
    $this->load->view('librarian\edit_teacher', $data);
		$this->load->view('footer');
  }

  public function viewInfoTeacher(){
    echo json_encode($this->Users_data->get_user($this->input->post('id'), $this->input->post('school')));
  }

  public function viewListTeacher($page = 1){
      $params['limit'] =  2;
      $params['offset'] = ($page - 1) * 2;
      $params['userType'] = "teacher";

      $config['base_url'] = base_url()."librarian/view/teacher/";
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
      $this->load->view('librarian\header', $data);
      $this->load->view('librarian\nav_main', $data);
      $this->load->view('librarian\view_teacher', $data);
  		$this->load->view('footer');
  }

  public function viewAddBook(){

    $data['user_in'] = $this->session->userdata('user_in');
    $this->load->view('head');
    $this->load->view('librarian\header', $data);
    $this->load->view('librarian\nav_main', $data);
    $this->load->view('librarian\add_book');
    $this->load->view('footer');
  }

  public function viewListBook($page = 1){
      $params['limit'] =  2;
      $params['offset'] = ($page - 1) * 2;
      $params['school'] = $this->session->userdata('user_in')['school'];

      $config['base_url'] = base_url()."librarian/acquisition/view/";
      $config['total_rows'] = $this->Books_data->getBookCount($params['school']);
      $config['num_links'] = $this->Books_data->getBookCount($params['school']);
      $config['per_page'] = 2;
      $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';
      $config['last_link'] = FALSE;
      $config['first_link'] = FALSE;
      $this->pagination->initialize($config);
      $data['books'] = $this->Books_data->getAllBookData($params);

      $data['user_in'] = $this->session->userdata('user_in');
      $this->load->view('head');
      $this->load->view('librarian\header', $data);
      $this->load->view('librarian\nav_main', $data);
      $this->load->view('librarian\view_books', $data);
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

            $result = $this->Users_data->addTeacher($params);
            $this->session->set_flashdata('result', $result);
            redirect('librarian/add/teacher');
        }
        else
        {
            $data['error_message'] = validation_errors();
            $data['error_message'] = explode("</p>", $data['error_message']);
            $this->session->set_flashdata('error_message',  $data['error_message'][0]);
            redirect('librarian/add/teacher');
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
              redirect('librarian/edit/teacher');
          }
          else
          {
            $data['error_message'] = validation_errors();
            $data['error_message'] = explode("</p>", $data['error_message']);
            $this->session->set_flashdata('error_message',  $data['error_message'][0]);
            $this->session->set_flashdata('user',  $this->input->post());
            redirect('librarian/edit/teacher');
          }
    }

    public function addBook()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('language','Language','required');
        $this->form_validation->set_rules('category','Category','required');
        $this->form_validation->set_rules('section','Section','required');
        $this->form_validation->set_rules('price','Price','required');
        $this->form_validation->set_rules('author','Author','required');
        $this->form_validation->set_rules('editor','Editor','required');
        $this->form_validation->set_rules('ISBN','ISBN','required');
        
        if($this->form_validation->run())     
        {   
            $params = array(
              'language' => $this->input->post('language'),
              'category' => $this->input->post('category'),
              'section' => $this->input->post('section'),
              'title' => $this->input->post('title'),
              'price' => $this->input->post('price'),
              'author' => $this->input->post('author'),
              'editor' => $this->input->post('editor'),
              'ISBN' => $this->input->post('ISBN'),
              'schoolId' => $this->session->userdata('user_in')['school'],
            );
            
            $result = $this->Books_data->addBookData($params);
            if(isset($result['error_message']))
              $this->session->set_flashdata('error_message', $result);
            else
              $this->session->set_flashdata('bookID', $result);
            
            redirect('librarian/acquisition/new');
        }
        else
        {            
            $data['error_message'] = validation_errors();
            $data['error_message'] = explode("</p>", $data['error_message']);
            $this->session->set_flashdata('error_message',  $data['error_message'][0]);
            redirect('librarian/acquisition/new');
        }
    }  

    /*
     * Editing a book_datum
     */
    function edit($id)
    {   
        // check if the book_datum exists before trying to edit it
        $data['book_datum'] = $this->Bookdata_model->get_book_datum($id);
        
        if(isset($data['book_datum']['id']))
        {
            $this->load->library('form_validation');

      $this->form_validation->set_rules('title','Title','required');
      $this->form_validation->set_rules('language','Language','required');
      $this->form_validation->set_rules('category','Category','required');
      $this->form_validation->set_rules('section','Section','required');
      $this->form_validation->set_rules('price','Price','required');
      $this->form_validation->set_rules('author','Author','required');
      $this->form_validation->set_rules('editor','Editor','required');
    
      if($this->form_validation->run())     
            {   
                $params = array(
          'language' => $this->input->post('language'),
          'category' => $this->input->post('category'),
          'section' => $this->input->post('section'),
          'title' => $this->input->post('title'),
          'stocks' => $this->input->post('stocks'),
          'price' => $this->input->post('price'),
          'author' => $this->input->post('author'),
          'editor' => $this->input->post('editor'),
                );

                $this->Bookdata_model->update_book_datum($id,$params);            
                redirect('bookdata/index');
            }
            else
            {
                $data['_view'] = 'bookdata/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The book_datum you are trying to edit does not exist.');
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
