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
		$categories = $this->product->limited_categories();
		// $this->session->sess_destroy();
		$this->load->view('partials/header');
		$this->load->view('main', array(
			"products" => $products,
			"categories" => $categories
			));
	}

	//shows the users current cart
	public function cart()
	{
		//make this just part of a header partial that is loaded with all views
		$this->load->view('partials/header');

		$this->load->view("cart", array(
			"products" => $this->session->userdata('cart')
		));

		//dont load checkout partial if cart is empty
		if(!(empty($this->session->userdata('cart'))))
		{
			$this->load->view('partials/purchase_page');
		}
	}

	//show a products info page
	public function show($id)
	{
		$product = $this->product->get_product_info($id);
		$this->load->view('partials/header');
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
		}
		$this->session->set_userdata('cart', $cart);
		redirect("/cart");
	}

	//updates the quantity of a product in the users cart
	public function update_qty()
    {
    	$post = $this->input->post();
    	$cart = $this->session->userdata('cart');
    	foreach($cart as $key => $product)
    	{
    		if($product['id'] == $post['product_id'])
    		{
    			$cart[$key]['quantity'] = $post['quantity'];
    		}
    	}
    	$this->session->set_userdata("cart", $cart);
        redirect("/cart");
    }

	//--------------------ADMIN ONLY FUNCTIONS---------------------

	//brings up the admin add product page
	public function add()
	{
		if ($this->session->userdata('admin'))
		{
			//get categories
			$categories = $this->product->get_categories();
			$this->load->view("admin_product_add", array(
				"categories" => $categories
				));
		}
		else
		{
			redirect("/");
		}	
	}

	//adds a new product
	public function create()
	{
		if ($this->session->userdata('admin'))
		{
			$result = $this->product->validate_product($this->input->post());
			
			if($result == "valid")
			{
				$this->product->new_product($this->input->post());
				redirect("/admins");
			}
			else
			{
				$this->session->set_flashdata("add_errors", $result);
				redirect("/products/add");
			}
		}
		else
		{
			redirect("/");
		}
	}

	//updates the product information
	public function update()
	{
		if ($this->session->userdata('admin'))
		{
			$result = $this->product->validate_product($this->input->post());
			
			if($result == "valid")
			{
				$this->product->update_product($this->input->post());
				redirect("/admins/products");
			}
			else
			{
				$this->session->set_flashdata("add_errors", $result);
				redirect("/admins/edit_product/" . $this->input->post());
			}
		}
		else
		{
			redirect("/");
		}
	}

	//delete a product from the listings
	public function delete($id)
	{
		if ($this->session->userdata('admin'))
		{
			$this->product->delete_product($id);
			redirect("/admins/products");
		}
		else
		{
			redirect("/");
		}
	}

	//create a new category and returns current categories as JSON information
	public function new_category()
	{
		if ($this->session->userdata('admin'))
		{
			$this->product->new_category($this->input->post());
			redirect("/products/categories_json");
		}
		else
		{
			redirect("/");
		}
	}

	//add a new category to the product
	public function add_category()
	{
		
		if ($this->session->userdata('admin'))
		{
			$prod_id = $this->input->post('product_id');
			$cat_id = $this->input->post('category_id');
			$this->product->category_connection($prod_id, $cat_id);
		}
		else
		{
			redirect("/");
		}
	}

	//remove a category from the product
	public function remove_category()
	{
		
		if ($this->session->userdata('admin'))
		{
			$prod_id = $this->input->post('product_id');
			$cat_id = $this->input->post('category_id');
			$this->product->remove_category_connection($prod_id, $cat_id);
		}
		else
		{
			redirect("/");
		}
	}

	//return all categories as JSON information
	public function categories_json()
	{
		if ($this->session->userdata('admin'))
		{
			$categories = $this->product->get_categories();
			echo json_encode($categories);
		}
		else
		{
			redirect("/");
		}
	}

	//return categories as JSON from a single product
	public function product_categories_json($prod_id)
	{
		if ($this->session->userdata('admin'))
		{
			$categories = $this->product->get_product_categories($prod_id);
			echo json_encode($categories);
		}
		else
		{
			redirect("/");
		}
	}
	//lets user display all categories on main page
	public function show_cats_json()
	{
		echo json_encode($this->product->get_categories());
	}
} ?>
