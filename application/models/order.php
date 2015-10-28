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
     public function change_status($post)
     {
        $query = "UPDATE orders SET status = ?";
        $values = $post;
        $this->db->query($query,$values);
     }
 } ?>