<?php

class User_model extends CI_Model {

   function __construct() {
      parent::__construct();
   }

   public function check_login($login) {
     $query = $this->db->get_where('users', array('user_name' => $login['user_name'], 'password' => $login['password']));
      return $query->num_rows() ? $query->row_array() : false;
   }
   public function list() {
      $query = $this->db->get('users');
      //print_r($this->db->last_query());
      return $query;
   }
   public function get_user_type($id) {
     
      $query = $this->db->get_where('user_type',array('id'=>$id));
		return $query->num_rows() ? $query->row() : false; 
   }
}