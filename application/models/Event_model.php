<?php

class Event_model extends CI_Model {

   function __construct() {
      parent::__construct();
   }

   public function get() {
   
      $this->db->order_by('id','DESC');
      $query = $this->db->get('view_event_details');
//my_var_dump($this->db->last_query());
      return $query;
   }
   public function search($name,$type) {
   
      if($type != '0')
      {
        $query1 = "SELECT * FROM `view_event_details` WHERE `name` like '%$name%' and `event_type` = '$type'";

      }
      else{
         $query1 = "SELECT * FROM `view_event_details` WHERE `name` like '%$name%'";
      }
     // my_var_dump($query);
     $query= $this->db->query($query1); 
        return $query;
     }
   public function update($event_id,$data,$address)
	{ 
      
      if($this->db->insert('location', $address))
      {
        if($location_id = $this->db->insert_id()){
        
         $data['location_id'] = $location_id;
         $this->db->where('id', $event_id);
         return $this->db->update('events',$data);
      }
      
   }//my_var_dump($this->db->last_query());
   }
   public function insert($data,$address)
   {
     // $data['date_created'] = date('Y-m-d H:i:s');
		//$data['date_updated'] = date('Y-m-d H:i:s');
   
      if($this->db->insert('location', $address))
      {
        if($location_id = $this->db->insert_id()){
        
         $data['location_id'] = $location_id;
         $this->db->insert('events', $data);
         $event_id = $this->db->insert_id();

         $user_event['event_id'] = $event_id;
         $user_event['user_id'] = $_SESSION['user']['id'];
         $this->db->insert('user_events', $user_event);
         $user_event_id = $this->db->insert_id();
   
         return $event_id;
      }

      }
     return false;
   }
   public function upload_image($image)
   {
   
      if($this->db->insert('event_images', $image))
      {
         $image_id = $this->db->insert_id();
        return $image_id;
      }

      return false;
   }
   
  
	public function get_events_type()
	{
		$this->db->order_by('name');
		$query = $this->db->get('event_type');
		
      return $query;
   }
   public function get_event_by_id($id) {
     
      $query = $this->db->get_where('view_event_details',array('id'=>$id));
		return $query->num_rows() ? $query->row() : false; 
   }
}