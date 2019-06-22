<?php

class Event_model extends CI_Model {

   function __construct() {
      parent::__construct();
   }

   public function list($user_id='',$event_id='') {
    
    if($user_id != '')
    {
        $query = $this->db->get_where('view_events',array('user_id'=>$id));
    }
    if($event_id != '')
    {
        $query = $this->db->get_where('view_events',array('event_id'=>$id));
    }
      $query = $this->db->get('events');
      //print_r($this->db->last_query());
      return $query;
   }

}