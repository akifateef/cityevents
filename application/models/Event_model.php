<?php

class Event_model extends CI_Model {

   function __construct() {
      parent::__construct();
   }

   public function get($user_id='',$event_id='') {
    
    if($user_id != '')
    {
        $query = $this->db->get_where('view_event_details',array('user_id'=>$id));
    }
    if($event_id != '')
    {
        $query = $this->db->get_where('view_event_details',array('event_id'=>$id));
    }
    else{
      $query = $this->db->get('view_event_details');
    }
     
      //print_r($this->db->last_query());
      return $query;
   }
   public function insert($data,$image)
   {
      $data['date_created'] = date('Y-m-d H:i:s');
		$data['date_updated'] = date('Y-m-d H:i:s');
	
      if($this->db->insert('events', $data))
		{
			$id = $this->db->insert_id();
			
			if(isset($image) )
			{
            $image['event_id'] = $id;
            $this->db->insert('event_images', $image);
			}
			return $id;
		}
		return false;
   }

}