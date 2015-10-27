<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function user_process($post)
	{
		//Billing Info 
		$billing_query = "INSERT INTO addresses(street, city, state, CREATED_AT, UPDATED_AT) VALUES(?, ?, ?, NOW(), NOW() )";

		$billing_value = array($post['billing_address'].$post['billing_address_2'], $post['billing_city'], $post['billing_state'] );

		$this->db->query($billing_query, $billing_value);

		$billing_id = $this->db->insert_id();


		//Shipping Info
		$shipping_query = "INSERT INTO addresses(street, city, state, CREATED_AT, UPDATED_AT) VALUES(?, ?, ?, NOW(), NOW() )";

		$shipping_value = array($post['shipping_address'].$post['shipping_address_2'], $post['shipping_city'], $post['shipping_state'] );	

		$this->db->query($shipping_query, $shipping_value);

		$shipping_id = $this->db->insert_id();

		//User Info
		$user_query = "INSERT INTO users(name, email, password, card_number, security_code, expiration_date, CREATED_AT, UPDATED_AT, billing_id, shipping_id) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?)";

		$user_value = array($post['shipping_first_name']." ".$post['shipping_last_name'], $post['email'], $post['password'], $post['card_number'], $post['security_code'], $post['expiration_date'], $billing_id, $shipping_id);

		$this->db->query($user_query, $user_value);

		$user_id = $this->db->insert_id();
	} 

	public function login_process($post)
	{
		$login_query = "SELECT * FROM USERS where email = ? AND password = ?";

		$login_values = array($post['email'], $post['password']);

		return $this->db->query($login_query, $login_values)->row_array();
		

		// 1. GRAB users'info such as: id, card_number, security_code, expiration_date, billing_id, and shipping_id 
		// 2. Have it all be sent to the ______ to be filled_out 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */