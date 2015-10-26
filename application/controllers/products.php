<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('cart');
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$products = $this->product->get_all_products();
		// $this->session->sess_destroy();
		$this->load->view('products', array(
			"products" => $products
			));
	}

	public function cart($id)
	{
		if (empty($this->session->userdata('cart')))
		{
			$data = array(
				array(
					'id' => $id,
					'quantity' => $this->input->post('quantity')
					));
		}
		else 
		{
			$data = $this->session->userdata('cart');
			array_push($data, array(
				'id' => $id,
				'quantity' => $this->input->post('quantity')));
		}

		$this->session->set_userdata('cart', $data);
	}
	public function add()
	{
		
	}
} ?>
