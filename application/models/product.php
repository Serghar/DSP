<?php 
class Product extends CI_Model {

    //return info on all products for main page
     public function get_all_products()
     {
         $query = "SELECT id, name, description, price FROM products"; 
         return $this->db->query($query)->result_array();
     }

     //return info on a single product
     public function get_product_info($id)
     {
        $query = "SELECT * FROM products
                    WHERE id = '{$id}'";
        return $this->db->query($query)->row_array();
     }

    public function get_categories()
     {
        $query = "SELECT * FROM categories";
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