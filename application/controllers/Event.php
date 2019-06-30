<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

   public function __construct() {
      parent::__construct();

      $this->load->model('user_model');
      $this->load->model('event_model');
      $this->data = array();
      // if(isset($_SESSION)){
      //    redirect(base_url().'admin/user/login','refresh');
      // }
      // else{
      //    redirect(base_url().'admin/user/index','refresh');
      // }
   
   }

   public function index() {
      $this->load->view('admin/dashboard',$this->data);
   }
   public function list() {
      
      $this->data['events'] = $this->event_model->get();
      $this->load->view('admin/user_events',$this->data);
   }


}
