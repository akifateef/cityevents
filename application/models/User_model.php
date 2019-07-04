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
      //my_var_dump($this->db->last_query());
      return $query;
   }
   public function get_user_type($id) {
     
      $query = $this->db->get_where('user_type',array('id'=>$id));
		return $query->num_rows() ? $query->row() : false; 
   }
   public function get_user_by_id($id) {
     
      $query = $this->db->get_where('users',array('id'=>$id));
		return $query->num_rows() ? $query->row() : false; 
   }
   public function update($user_id,$data)
	{ 
      $data['date_updated'] = date('Y-m-d H:i:s');
      //$data['updated_by'] = $_SESSION['id'];
		$this->db->where('id', $user_id);
     return $this->db->update('users',$data);
      //my_var_dump($this->db->last_query());
   }

   public function insert($data)
	{
		// $data['created_by'] = $_SESSION['id'];
      		if($this->db->insert('users', $data))
		{
			$id = $this->db->insert_id();
			
			
			return $id;
		}
		return false;
   }
   
   public function delete($id)
	{
		$entity = self::get_user_by_id($id);
		
		return $this->db->delete('users', array('id' => $id));
	}
}