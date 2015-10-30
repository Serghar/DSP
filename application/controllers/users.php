<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
	}

	public function purchase_process()
	{
		// var_dump($this->input->post());
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
			echo $status;
			die();
		}	
	}

	//loads a confirmation page
	//Make it so this page reviews the order and would provide an order number
	public function confirm_order()
	{
		//display confirmation page
		$this->load->view("order_confirmation");
	}

	public function login_page()
	{
		$this->load->view('login_page');
	}

	public function login_process()
	{
		die("this need to be made still!");
		/*$status = $this->user->validate_user($this->input->post());
		if($status == "valid")
		{

		}
		else
		{
			//echo back the errors
			echo $status;
		}*/
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("login_page");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */