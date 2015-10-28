<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		//Grabbing the users'info
		//$login_info = $this->user->login_process($this->input->post() );

		$this->load->view('purchase_page');
	}

	public function purchase_process()
	{
		//validate purchase form information here first!!

		//create the user, billing address, and shipping address as needed
		$user_id = $this->user->user_process($this->input->post());

		//using the ids from the previous 3 and the session cart create the order
		$this->order->add_order($user_id);

		//clear the old cart
		$this->session->unset_userdata("cart");

		//go to order confirmation page
		redirect("/users/confirm_order");
		
	}

	//loads a confirmation page
	//THIS COULD BE CHANGED TO A JAVASCRIPT MESSAGE THAT THEN LOADS HOME INSTEAD
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
		$login_info = $this->user->login_process($this->input->post() );

		$this->load->view('purchase_page', array("login" => $login_info) );

		//redirect('purchase_page', array('login_info' => $login_info) );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */