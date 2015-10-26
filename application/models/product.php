<?php 
class Product extends CI_Model {
     public function get_all_products()
     {
         $query = "SELECT * FROM products"; 
         return $this->db->query($query)->result_array();
     }

     //insert the new product into database
     public function new_product($post)
     {
     	$query = "INSERT INTO products (name, description, price, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
     	$values = array($post['name'], $post['description'], $post['price']);
     	$this->db->query($query, $values);
     }

     //Should be used for validation of post data for the product
     public function validate_product($post)
     {

     }
     
}
?>