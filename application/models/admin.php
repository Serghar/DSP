<?php 
class Admin extends CI_Model {
    public function get_password($email)
     {
     	$query = "SELECT password FROM admins WHERE email = ?";
     	$values = $email;
     	return $this->db->query($query,$values)->row_array();
     }
     public function validate_login($post)
     {
     	$this->form_validation->set_rules('email', "Email", "required|trim");
     	$this->form_validation->set_rules('password', "Password", "trim|required");
     	if($this->form_validation->run())
     	{
     		if ($this->get_password($post['email'])['password'] == $post['password'])
     		{
     			return "valid";
     		}
     		else
     		{
     			return "<p> Wrong password </p>";
     		}
     	}
     	else 
     	{
     		return validation_errors();
     	}
     }
}
?>