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
			$orders = $this->order->display_orders();
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
		// $orders = $this->order->get_all_orders();
		$products = $this->product->get_all_products();
		$orders = $this->order->display_orders();
		// $orders = $this->order->get_all_orders();
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
	//this allows the admin to change the orders dashboard view by 'show all', 'shipped', 'in process'
	public function order_display()
	{
		echo json_encode($this->order->display_orders());
		// $orders = $this->order->get_selected_orders($this->input->post());
		// $this->load->view('admin_dashboard', array(
			// "orders" => $orders
			// ));
	}
	//this allows the admin to search through the orders on the dashboard
	public function order_search()
	{
		$order = $this->order->find_order($this->input->post());
		$orders = $this->order->display_orders();
		$this->load->view('admin_dashboard', array(
			'order' => $order,
			'orders'=> $orders
			));
	}
	//send json data to product display page
	public function products_json()
	{
		echo json_encode($this->product->get_all_products());
	}
	//allows admin to click order ID and take him/her to specific order page
	public function show($id)
	{
		$this->load->view('order_show', array(
			"id" => $id
			));
	}
	//allows admin to update order status
	public function update_order()
	{
		$this->order->change_status($this->input->post());
	}


} ?>