<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		// $this->output->enable_profiler();
	}
	public function index()
	{
		$this->load->view('admin_login');
	}
	public function login()
	{
		$result = $this->admin->validate_login($this->input->post());
		if($result == "valid")
		{
			$this->session->set_userdata('admin', True);
			$products = $this->product->get_all_products();
			$this->load->view('admin_dashboard', array(
				"products" => $products
				));
		}
		else
		{
			$this->session->set_flashdata('login_errors', $result);
			redirect('/admins');
		}
	}

} ?>