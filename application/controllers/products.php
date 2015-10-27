<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('cart');
		// $this->output->enable_profiler();
	}

	//displays the main store stage showing all products
	public function index()
	{
		$products = $this->product->get_all_products();
		// $this->session->sess_destroy();
		$this->load->view('main', array(
			"products" => $products
			));
	}

	//shows the users current cart
	public function cart()
	{
		$this->load->view("cart", array(
			"products" => $this->session->userdata('cart')
			));
	}

	//show a products info page
	public function show($id)
	{
		$product = $this->product->get_product_info($id);
		$this->load->view("product", array(
			'product_info' => $product));
	}

	//adds a product to the users cart
	//if the item is already in the cart just increment the id
	public function add_cart($id)
	{

		$product = $this->product->get_product_info($id);

		if (empty($this->session->userdata('cart')))
		{
			$data = array(
				array(
					'id' => $id,
					'name' => $product['name'],
					'price' => $product['price'],
					'quantity' => $this->input->post('quantity')
					));
		}
		else 
		{
			$data = $this->session->userdata('cart');
			array_push($data, array(
				'id' => $id,
				'name' => $product['name'],
				'price' => $product['price'],
				'quantity' => $this->input->post('quantity')
				));
		}

		$this->session->set_userdata('cart', $data);
		redirect("/cart");
	}


	//removes an item from the users current cart
	public function remove($id)
	{
		$cart = $this->session->userdata('cart');
		foreach($cart as $key=>$value)
		{
			if($value['id'] == $id)
			{
				unset($cart[$key]);
			}
			var_dump($cart);
		}
		$this->session->set_userdata('cart', $cart);
		redirect("/cart");
	}

	//--------------------ADMIN ONLY FUNCTIONS---------------------

	//adds a new product
	public function add()
	{
		//need to add validation here
		//if valid send to model
		$this->product->new_product($this->input->post());
		redirect("/admin");
	}

	//delete a product from the listings
	public function delete($id)
	{

	}

} ?>
