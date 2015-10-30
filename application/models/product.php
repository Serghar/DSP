<?php 
class Product extends CI_Model {

    //return info on all products for main page
    public function get_all_products()
    {
        $query = "SELECT products.id, products.name, products_in_orders.quantity, products.price FROM products LEFT JOIN products_in_orders ON products.id = products_in_orders.product_id GROUP BY products.id"; 
        return $this->db->query($query)->result_array();
    }

    //return info on a single product
    public function get_product_info($id)
    {
        $query = "SELECT id, name, description, price FROM products
                    WHERE id = '{$id}'";
        return $this->db->query($query)->row_array();
    }

    //Get all created categories
    public function get_categories()
    {
        $query = "SELECT id, name FROM categories";
        return $this->db->query($query)->result_array();
    }

    //get all the categories for the product
    public function get_product_categories($prod_id)
    {
        $query = "SELECT category_id, categories.name as category_name
                    FROM products_has_categories
                    JOIN categories ON products_has_categories.category_id=categories.id
                    WHERE product_id = '{$prod_id}'";
        return $this->db->query($query)->result_array();
    }

    //get all the products for a category
    public function get_category_products($cat_id)
    {
        $query = "SELECT category_id, products.name, products.id, products.description, products.price
        FROM products_has_categories 
        OIN products ON products_has_categories.product_id=products.id
        WHERE category_id = '{$cat_id}'";
        return $this->db->query($query)->result_array();
    }


    //create a new category for products
    public function new_category($post)
    {
        //check if the category already exists first
        $query = "SELECT id FROM categories WHERE name = '{$post['category']}'";
        if(empty($this->db->query($query)->row_array()))
        {
            $query = "INSERT INTO categories (name, created_at, updated_at) VALUES ('{$post['category']}', NOW(), NOW())";
            $this->db->query($query);
        }
    }

     //insert the new product into database
     public function new_product($post)
     {
     	$query = "INSERT INTO products (name, description, price, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
     	$values = array($post['name'], $post['description'], $post['price']);
     	$this->db->query($query, $values);
        $product_id = $this->db->insert_id();

        //connect this item to all relevant categories
        $this->category_connections($product_id, $post['categories']);
     }

     //update the products information
     public function update_product($post)
     {
        $query = "UPDATE products SET name='{$post['name']}', description='{$post['description']}', price='{$post['price']}'
                    WHERE id = '{$post['id']}'";
        $this->db->query($query);
     }

     //remove a connection of a category to a product
     public function remove_category_connection($prod_id, $cat_id)
     {
        $query = "DELETE FROM products_has_categories
                    WHERE product_id = '{$prod_id}' AND category_id = '{$cat_id}'";
        $this->db->query($query);
     }

     //add a single category connection
      public function category_connection($prod_id, $cat_id)
     {
        $query = "INSERT INTO products_has_categories (product_id, category_id)
                    VALUES ('{$prod_id}', '{$cat_id}')";
        $this->db->query($query);
     }

     //adds to the products_has_categories table so that products and categories are connected
     public function category_connections($prod_id, $cat_ids)
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

     //used to display appropriate results from admin product search
     public function search($post)
     {
        $query = "SELECT * FROM products WHERE name OR id = ?";
        $values = $post;
        return $this->db->query($query,$values)->result_array();
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
    public function limited_categories()
    {
        $query = "SELECT * FROM categories WHERE id != 19 ORDER BY id DESC";
        // $values = 5;
        return $this->db->query($query)->result_array();
    }
    public function prod_by_category()
    {
        $query = "SELECT products.id, products.name AS title, products.description, products.price, products_has_categories.product_id, categories.name FROM products LEFT JOIN products_has_categories ON products.id = products_has_categories.product_id LEFT JOIN categories ON products_has_categories.category_id = categories.id";
        return $this->db->query($query)->result_array();
    }
}
?>