<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		if ($this->session->userdata('admin'))
		{
			$orders = $this->order->get_all_orders();
			$products = $this->product->get_all_products();
			$this->load->view('admin_dashboard', array(
				"products" => $products,
				"orders" => $orders
				));
		}
		else
		{
			$this->load->view('admin_login');
		}
	}

	public function login()
	{
		$result = $this->admin->validate_login($this->input->post());
		if($result == "valid")
		{
			$this->session->set_userdata('admin', True);
		}
		else
		{
			$this->session->set_flashdata('login_errors', $result);
		}
		redirect('/admins');
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
	//allows admin to search through products display
	public function searches()
	{
		$results = $this->product->search($this->input->post());
		$products = $this->product->get_all_products();
		$this->load->view('admin_product_display', array(
			"results" => $results,
			"products" => $products
			));
	}

	public function orders()
	{
		$orders = $this->order->get_all_orders();
		$products = $this->product->get_all_products();
		// $this->session->sess_destroy();
		$this->load->view('admin_dashboard', array(
			"products" => $products,
			"orders" => $orders
			));
	}


	public function edit_product($id)
	{
		$product = $this->product->get_product_info($id);
		$categories = $this->product->get_product_categories($id);
		$all_categories = $this->product->get_categories();
		$this->load->view('edit_page', array(
			"product" => $product,
			"product_categories" => $categories,
			"all_categories" => $all_categories
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