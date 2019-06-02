<?php

class User_model extends CI_Model {

   function __construct() {
      parent::__construct();
   }

   public function check_login($login) {
      $query = $this->db->get_where('user', array('email' => $login['email'], 'password' => $login['password']));
      return $query->num_rows() ? $query->row_array() : false;
   }

}