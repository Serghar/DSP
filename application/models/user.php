<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function user_process($post)
	{
		//Billing info
		$billing_id = $this->get_address_id($post['billing_first_name'], $post['billing_last_name'], $post['billing_address'], $post['billing_address_2'], $post['billing_city'], $post['billing_state'], $post['billing_zipcode']);
        
        //Shipping Info
		$shipping_id = $this->get_address_id($post['shipping_first_name'], $post['shipping_last_name'], $post['shipping_address'], $post['shipping_address_2'], $post['shipping_city'], $post['shipping_state'], $post['shipping_zipcode']);
        
        //User Info
        $expiration_date = $post["expiration_month"] . "-" . $post["expiration_year"];
        $user_id = $this->user_update($post['email'], $post['card_number'], $post['security_code'], $expiration_date, $billing_id, $shipping_id);
        return $user_id;
    }

    public function user_update($email, $card_number, $security_code, $expiration_date, $billing_id, $shipping_id)
    {
    	//check if the user already exists on file
    	$user_id = $this->db->query("SELECT id FROM users WHERE email = '{$email}'")->row_array();
    	if(empty($user_id))
    	{
    		//Create the default guest password
    		$password = "27!27d8qq7s9As82jAs9812jN";
    		$query = "INSERT INTO users(email, password, card_number, security_code, expiration_date, CREATED_AT, UPDATED_AT, billing_id, shipping_id) VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?, ?)";
        	$values = array($email, $password, $card_number, $security_code, $expiration_date, $billing_id, $shipping_id);
       		$this->db->query($query, $values);
       		return $this->db->insert_id();
    	}
    	else
    	{
    		//updates user info if it has changed and then returns user id
    		$query = "UPDATE users
				SET card_number = '{$card_number}',
				security_code = '{$security_code}',
				expiration_date = '{$expiration_date}',
				billing_id = '{$billing_id}',
				shipping_id = '{$shipping_id}',
				updated_at = NOW()
				WHERE id = '{$user_id['id']}'";
			$this->db->query($query);
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

	public function validate_information($post)
	{
		$this->form_validation->set_rules("billing_first_name", "Billing First Name", "trim|required|alpha_dash");
		$this->form_validation->set_rules("billing_last_name", "Billing Last Name", "trim|required|alpha_dash");
		$this->form_validation->set_rules("billing_address", "Billing Address", "trim|required");
		$this->form_validation->set_rules("billing_city", "Billing City", "trim|required");
		$this->form_validation->set_rules("billing_state", "Billing State", "trim|required|min_length[2]|max_length[2]|alpha");
		$this->form_validation->set_rules("billing_zipcode", "Billing Zipcode", "trim|required|min_length[5]|max_length[5]|integer");
		$this->form_validation->set_rules("shipping_first_name", "Shipping First Name", "trim|required|alpha_dash");
		$this->form_validation->set_rules("shipping_last_name", "Shipping Last Name", "trim|required|alpha_dash");
		$this->form_validation->set_rules("shipping_address", "Shipping Address", "trim|required");
		$this->form_validation->set_rules("shipping_city", "Shipping City", "trim|required");
		$this->form_validation->set_rules("shipping_state", "Shipping State", "trim|required|min_length[2]|max_length[2]|alpha");
		$this->form_validation->set_rules("shipping_zipcode", "Shipping Zipcode", "trim|required|min_length[5]|max_length[5]|integer");
		$this->form_validation->set_rules("card_number", "Credit Card Number", "trim|required|min_length[13]|max_length[19]|alpha_dash");
		$this->form_validation->set_rules("security_code", "Security Code", "trim|required|min_length[3]|max_length[4]|integer");
		$this->form_validation->set_rules("expiration_month", "Expiration Month", "trim|required|min_length[1]|max_length[2]|integer");
		$this->form_validation->set_rules("expiration_year", "Expiration Year", "trim|required|min_length[4]|max_length[4]|integer");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        if($this->form_validation->run())
        {
            return "valid";
        }
        else
        {
            return validation_errors();
        }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */