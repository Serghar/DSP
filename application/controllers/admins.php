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
	public function logoff()
	{
		$this->session->sess_destroy();
		redirect('/admins');
	}
	public function products()
	{
		$products = $this->product->get_all_products();
		$this->load->view('admin_product_display', array(
				"products" => $products
			));
	}
	public function orders()
	{
		$products = $this->product->get_all_products();
		// $this->session->sess_destroy();
		$this->load->view('admin_dashboard', array(
			"products" => $products
			));
	}
	public function edit_product($id)
	{
		$product = $this->product->get_product_info($id);
		$categories = $this->product->get_categories();
		$this->load->view('edit_page', array(
			"product" => $product,
			"categories" => $categories
			));
	}
	public function create()
	{
		$categories = $this->product->get_categories();
		$this->load->view('create', array(
			"categories" => $categories
			));
	}

} ?>