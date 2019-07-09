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
      $this->load->view('index');
   }
   public function login() {
      $this->load->view('login');
   }
   public function register() {
      $this->load->view('register');
   }
   public function list() {
      
		$order_by = $this->input->get_post('order_by') ? $this->input->get_post('order_by') : 'id';
		$direction = $this->input->get_post('direction') ? $this->input->get_post('direction') : 'DESC';
		$status = $this->input->get_post('status');
		$keyword = $this->input->get_post('keyword');
		# Pagination Code
		$offset	=	$this->input->get_post('per_page');
		if($offset < 1)
		{
			$offset = 0;
		}

		if ($this->uri->segment(4)) { $limit = $this->uri->segment(4); }else{ $limit = 1; }
		
		if($status != '') $query_params['status'] = $status;
		if($keyword != '') $query_params['keyword'] = $keyword;
		$query_params['limit'] = $limit;
		$query_params['offset'] = $offset;
		$query_params['order_by'] = $order_by;
		$query_params['direction'] = $direction;
		
		$total_rows = $this->event_model->get($query_params);
		$events = $this->event_model->get($query_params);
		
		# array for pagination query string
		$qstr['order_by'] = $order_by;
		$qstr['direction'] = $direction;
		
		$page_query_string = '?'.http_build_query($qstr);
		$config['base_url'] = base_url('event/list/'.$page_query_string);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);
		$this->data['pagination_links'] = $this->pagination->create_links();
		// Paination code end
		$this->data['order_by'] = $order_by;
		$this->data['direction'] = $direction;
		$this->data['total_rows'] = $total_rows;
		$this->data['events'] = $events;
      $this->load->view('list',$this->data);
   }
   public function search() {

      $name = $this->input->get_post('event_name');
      $type = $this->input->get_post('event_type');
      $this->data['events'] = $this->event_model->search($name,$type);
      $this->load->view('list',$this->data);
   }

   public function details() {

      
      $id = $this->input->get_post('id');
      $this->data['event'] = $this->event_model->get_event_by_id($id);
      $this->load->view('event_details',$this->data);
   }
   
}
