<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		//Grabbing the users'info
		// $login_info = $this->user->login_process($this->input->post() );

		$this->load->view('purchase_page', array("login_info" => $login_info) );
	}

	public function purchase_process()
	{
		// var_dump($this->input->post() );
		// die();

		$this->user->user_process($this->input->post() );
	}

	public function login_page()
	{
		$this->load->view('login_page');
	}

	public function login_process()
	{
		$login_info = $this->user->login_process($this->input->post() );

		$this->load->view('purchase_page', array("login" => $login_info) );

		//redirect('purchase_page', array('login_info' => $login_info) );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */