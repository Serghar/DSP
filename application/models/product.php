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

     //remove the product from the database
     //also removes all connections to that product
     public function delete_product($id)
     {
        //remove all category connections from the order
        $query = "DELETE FROM products_has_categories
                    WHERE product_id = '{$id}'";
        $this->db->query($query);

        //remove the item from all order connections
        //SOMETHING HAS TO HAPPEN HERE DIFFERENTLY
        $query = "DELETE FROM products_in_orders
                    WHERE product_id = '{$id}'";
        $this->db->query($query);

        //Remove the item itself
        $query = "DELETE FROM products WHERE id = '{$id}'";
        $this->db->query($query);
     }

     //Should be used for validation of post data for the product
     public function validate_product($post)
     {

     }
}
?>