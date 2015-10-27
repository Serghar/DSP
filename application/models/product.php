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

    //create a new category for products
    public function new_category($post)
    {
        $query = "INSERT INTO categories (name, created_at, updated_at) VALUES ('{$post['category']}', NOW(), NOW())";
        $this->db->query($query);
    }

     //insert the new product into database
     public function new_product($post)
     {
     	$query = "INSERT INTO products (name, description, price, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
     	$values = array($post['name'], $post['description'], $post['price']);
     	$this->db->query($query, $values);
        $product_id = $this->db->insert_id();

        //connect this item to all relevant categories
        $this->connect_categories($product_id, $post['categories']);
     }

     //adds to the products_has_categories table so that products and categories are connected
     public function connect_categories($prod_id, $cat_ids)
     {
        foreach ($cat_ids as $cat_id)
        {
            $query = "INSERT INTO products_has_categories (product_id, category_id)
                        VALUES ('{$prod_id}', '{$cat_id}')";
            $this->db->query($query);
        }
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
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("description", "Description", "trim|required");
        $this->form_validation->set_rules("price", "Price", "trim|required");
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
?>