<?php 
class Order extends CI_Model {

    //return info on all orders for admin dashboard
     public function get_all_orders()
     {
         $query = "SELECT orders.id AS orders_id, total, status, orders.created_at, orders.updated_at, users.id, users.name, users.billing_id FROM orders LEFT JOIN users ON orders.user_id = users.id"; 
         return $this->db->query($query)->result_array();
     }
     
     public function get_selected_orders($post)
     {
     	$query = "SELECT * FROM orders where status = ?";
     	$values = $post;
     	return $this->db->query($query,$values)->result_array();
     }

     //this will need to be updated so row can be fetched by user name and/or billing address
     public function find_order($post)
     {
     	$query = "SELECT * FROM orders WHERE id = ?";
     	$values = $post;
     	return $this->db->query($query,$values)->row_array();
     }

     public function add_order($user_id)
     {
        $cart = $this->session->userdata('cart');
        $total = 0;

        //get total cost of items in the cart
        foreach($cart as $product)
        {   
            $total += $product['price'] * $product['quantity'];
        }
        
        //create a new order entry in Database
        $query = "INSERT INTO orders (total, status, user_id, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
        $values = array($total, "In Process", $user_id);
        $this->db->query($query, $values);
        $order_id = $this->db->insert_id();

        //connect orders to products
        $query = "INSERT INTO products_in_orders (quantity, product_id, order_id) VALUES (?,?,?)";
        foreach($cart as $product)
        {
            $values = array($product['quantity'], $product['id'], $order_id);
            $this->db->query($query, $values);
        }
     }
 } ?>