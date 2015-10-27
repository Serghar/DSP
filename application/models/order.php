<?php 
class Order extends CI_Model {

    //return info on all orders for admin dashboard
     public function get_all_orders()
     {
         $query = "SELECT orders.id AS orders_id, total, status, orders.created_at, orders.updated_at, users.id, users.name, users.billing_id FROM orders LEFT JOIN users ON orders.user_id = users.id"; 
         return $this->db->query($query)->result_array();
     }
 } ?>