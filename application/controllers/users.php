<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->output->enable_profiler();

	}
	public function index()
	{
		//Showing the Login Page
		$this->load->view('login_page');
		
		//Showing the Purchase Page
		$this->load->view('purchase_page');
	}

	public function purchase_process()
	{
		// var_dump($this->input->post() );
		// die();

		$this->user->user_process($this->input->post() );

		redirect('success_page');
	}

	public function login_page()
	{
		$this->load->view('login_page');
	}

	public function login_process()
	{

		$login_user = $this->user->login_process($this->input->post() );

		if( empty($login_user) )
		{
			$this->session->set_flashdata("errors", "Couldnt Find user. Please Re-enter Email and Password" );
			redirect('login_page');
		}
		else
		{
			$this->session->set_userdata($login_user);
			$this->load->view('login_purchase_page', array("login_user" => $login_user) );
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("login_page");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */