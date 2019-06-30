<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $data;
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
   public function insert() {
  
      
      $this->form_validation->set_error_delimiters('<div>', '</div>');

      $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim');
      
      // If the validation worked
      if ($this->form_validation->run())
      {
            $upload_path = './images/';
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['encrypt_name'] = true;
		
				$this->load->library('upload', $config);
				
				# Try to upload file now
				if ($this->upload->do_upload('image'))
				{
					# Get uploading detail here
					$upload_detail = $this->upload->data();
					
					$data['image_path'] = $upload_detail['file_name'];
					# Get width and height of uploaded file
					$image_path = $upload_path.$image;
					$width = get_width($image_path);
					$height = get_height($image_path);
					# Resize Image Now
					$width > 1024 ? resize_image2($image_path, 1024, '', 'W') : '';
					$height > 1024 ? resize_image2($image_path, '', 1024, 'H') : '';
				}
            $data['name'] = $this->input->get_post('event_name');
            $data['description'] = $this->input->get_post('description');
            $date = explode("-", $this->input->get_post('datetime'));
            $datetime_start = explode(" ",$date[0]);
            $datetime_end = explode(" ",$date[1]);
            $data['date_start'] = $datetime_start[0];
            $data['time_start'] = $datetime_start[1];
            $data['date_end'] = $datetime_end[1];
            $data['time_end'] = $datetime_end[2];
            my_var_dump($image_path);
            die();
            if($this->event_model->insert($data))
            {               
               $_SESSION['msg_success'][] = 'Event Added...';
               redirect('admin/event');	
            }
              
      }
   
   $this->load->view('admin/add_events');
 }

}
