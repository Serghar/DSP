<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
	}

	public function purchase_process()
	{
		//validate purchase form information here first!!
		$status = $this->user->validate_information($this->input->post());
		if ($status == "valid")
		{
			//create the user, billing address, and shipping address as needed
			$user_id = $this->user->user_process($this->input->post());

			//using the ids from the previous 3 and the session cart create the order
			$this->order->add_order($user_id);

			//clear the old cart
			$this->session->set_userdata("cart", array());

			//go to order confirmation page
			redirect("/users/confirm_order");

			//for JSON later
			//echo "order confirmation";
		}
		else
		{	
			//needs to be fixed to actually send back errors
			$this->session->set_flashdata($status);
			redirect("/cart");
		}	
	}

	//loads a confirmation page
	//Make it so this page reviews the order and would provide an order number
	public function confirm_order()
	{
		//display confirmation page
		$this->load->view("order_confirmation");
	}

	public function login_modal_page()
	{
		echo $this->load->view("/partials/login-modal");
	}

	//confirms if the user exists then logs them in
	public function login()
	{
		//check if username and password exist
		$result = $this->user->validate_login($this->input->post());
		if(is_int($result))
		{
			//sign the user in
			$this->session->set_userdata("user_id", $result);
		}
		//either going to return 'success' or errors
			echo $result;
	}

	//registers a new user
	public function register()
	{
		//see if the email and password field are valid entries
		$result = $this->user->validate_register($this->input->post());
		if($result == "success")
		{
			//if so create the user and make sure to connect if they have made past orders under that email
			//Connecting just requires updating that password to the new one they entered
			$user_id = $this->user->register_user_account($this->input->post());
			//log the user in
			$this->session->set_userdata("user_id", $user_id);
		}
		//either going to return 'success' or errors
			echo $result;
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		redirect("/");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */