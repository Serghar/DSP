<?php 
class model extends CI_Model {
     function get_all_courses()
     {
         return $this->db->query("SELECT * FROM courses")->result_array();
     }
}
?>