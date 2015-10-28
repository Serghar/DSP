<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function user_process($post)
	{
		//var_dump($post);
		//die(); 

		//If user clicked on 'Same as Shipping'
		if( $post['same_info'] == 'on') {
			$post['billing_first_name'] = $post['shipping_first_name'];
			$post['billing_last_name'] = $post['shipping_last_name'];
			$post['billing_address'] = $post['shipping_address'];
			$post['billing_address_2'] = $post['shipping_address_2'];
			$post['billing_city'] = $post['shipping_city'];
			$post['billing_state'] = $post['shipping_state'];
			$post['billing_zipcode'] = $post['shipping_zipcode'];
		}

		//Billing Info 
		$billing_query = "INSERT INTO addresses(street, address_2,  city, state, CREATED_AT, UPDATED_AT) VALUES(?, ?, ?, ?, NOW(), NOW() )";

		$billing_value = array($post['billing_address'], $post['billing_address_2'], $post['billing_city'], $post['billing_state'] );

		$this->db->query($billing_query, $billing_value);

		$billing_id = $this->db->insert_id();


	//Shipping Info
		$shipping_query = "INSERT INTO addresses(street, address_2, city, state, CREATED_AT, UPDATED_AT) VALUES(?, ?, ?, ?, NOW(), NOW() )";

		$shipping_value = array($post['shipping_address'], $post['shipping_address_2'], $post['shipping_city'], $post['shipping_state'] );	

		$this->db->query($shipping_query, $shipping_value);

		$shipping_id = $this->db->insert_id();

		//User Info
		$user_query = "INSERT INTO users(first_name, last_name, email, password, card_number, security_code, expiration_date, CREATED_AT, UPDATED_AT, billing_id, shipping_id) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?)";

		$user_value = array($post['shipping_first_name'], $post['shipping_last_name'], $post['email'], $post['password'], $post['card_number'], $post['security_code'], $post['expiration_date'], $billing_id, $shipping_id);

		$this->db->query($user_query, $user_value);

		$user_id = $this->db->insert_id();
	} 

	public function login_process($post)
	{

		//Email Validation
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");

		//Password Validation
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required");

		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata("errors", validation_errors() );
		} 
		else 
		{
			$login_query = "SELECT 

				first_name, last_name, email, password, card_number, security_code, expiration_date,

				billing_id, billing.street as b_street, billing.address_2 as b_address_2, billing.state as b_state, billing.city as b_city, billing.zipcode as b_zipcode,

				shipping_id, shipping.street as s_street, shipping.address_2 as s_address_2, shipping.state as s_state, shipping.city as s_city, shipping.zipcode as s_zipcode


			 FROM USERS JOIN addresses AS billing ON users.billing_id = billing.id JOIN addresses AS shipping ON users.shipping_id = shipping.id WHERE users.email = ? AND users.password = ?";

			$login_values = array($post['email'], $post['password']);

			return $this->db->query($login_query, $login_values)->row_array();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */