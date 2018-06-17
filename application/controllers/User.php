<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  //consturctor
  	public function index()
	{
	   if(!$this->session->has_userdata('user_in') || 
	   		($this->session->userdata('user_in')['userType'] != "student" 
	   		&& $this->session->userdata('user_in')['userType'] != "teacher"))
	      redirect('login/'.$this->session->userdata('user_in')['userType']);

	    $data['user_in'] = $this->session->userdata('user_in');
		$this->load->view('head');
		$this->load->view('user\header', $data);
		$this->load->view('user\nav_main', $data);
		$this->load->view('user\dashboard');
		$this->load->view('footer');
	}

	public function circulation($page = 1){
      $params['limit'] =  2;
      $params['offset'] = ($page - 1) * 2;
      $params['school'] = $this->session->userdata('user_in')['school'];

      $config['base_url'] = base_url().$this->session->userdata('user_in')['userType']."/circulation/";
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
}

?>