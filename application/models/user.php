<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function user_process($post)
	{
		//Billing info
		$billing_id = $this->get_address_id($post['billing_first_name'], $post['billing_last_name'], $post['billing_address'], $post['billing_address_2'], $post['billing_city'], $post['billing_state'], $post['billing_zipcode']);
        
        //Shipping Info
		$shipping_id = $this->get_address_id($post['shipping_first_name'], $post['shipping_last_name'], $post['shipping_address'], $post['shipping_address_2'], $post['shipping_city'], $post['shipping_state'], $post['shipping_zipcode']);
        
        //User Info
        $user_id = $this->user_update($post['email'], $post['password'], $post['card_number'], $post['security_code'], $post['expiration_date'], $billing_id, $shipping_id);
        return $user_id;
    }

    public function user_update($email, $password, $card_number, $security_code, $expiration_date, $billing_id, $shipping_id)
    {
    	//check if the user already exists on file
    	$user_id = $this->db->query("SELECT id FROM users WHERE email = '{$email}'")->row_array();
    	if(empty($user_id))
    	{
    		$query = "INSERT INTO users(email, password, card_number, security_code, expiration_date, CREATED_AT, UPDATED_AT, billing_id, shipping_id) VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?, ?)";
        	$values = array($email, $password, $card_number, $security_code, $expiration_date, $billing_id, $shipping_id);
       		$this->db->query($query, $values);
       		return $this->db->insert_id();
    	}
    	else
    	{
    		//need to edit this to update the user info with info passed
    		return $user_id['id'];
    	}
    }

    //gets the id for the address
    //if the address is new it creates it then returns the new id
    public function get_address_id($first_name, $last_name, $street, $address_2, $city, $state, $zipcode)
    {
        $check_query = "SELECT id FROM addresses
							WHERE first_name = '{$first_name}'
							AND last_name = '{$last_name}'
							AND street = '{$street}'
							AND address_2 = '{$address_2}'
							AND city = '{$city}'
							AND state = '{$state}'
							AND zipcode = '{$zipcode}'";
		$id = $this->db->query($check_query)->row_array();
		if (empty($id))
		{
			$query = "INSERT INTO addresses(first_name, last_name, street, address_2, city, state, zipcode, CREATED_AT, UPDATED_AT) VALUES(?, ?, ?, ?, ?, ?, ?, NOW(), NOW() )";
        	$values = array($first_name, $last_name, $street, $address_2, $city, $state, $zipcode);
        	$this->db->query($query, $values);
        	return $this->db->insert_id();
		}
		else
		{
			return $id['id'];
		}
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