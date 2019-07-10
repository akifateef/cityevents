<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

   var $data;
   public function __construct() {
      
      parent::__construct();
      $this->load->helper(array('form', 'url'));
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
  
      $user_id = $this->input->get_post('user_id');
      
      if($user_id != '')
      {
         $this->data['events'] = $this->event_model->get($user_id);
           
      }
      else{
      $this->data['events'] = $this->event_model->get();
         }
      $this->load->view('admin/user_events',$this->data);
   }
   public function insert() {
  
      $this->form_validation->set_error_delimiters('<div>', '</div>');

      $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim');
      
     
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
					
               $image = $upload_detail['file_name'];
            }
      // If the validation worked
      if ($this->form_validation->run())
      {    
            $data['name'] = $this->input->get_post('event_name');
            
            $data['description'] = $this->input->get_post('description');
            $date = explode("-", $this->input->get_post('datetime'));
            $datetime_start = explode(" ",$date[0]);
            $datetime_end = explode(" ",$date[1]);
            $data['date_start'] = $datetime_start[0];
            $data['time_start'] = $datetime_start[1];
            $data['date_end'] = $datetime_end[1];
            $data['time_end'] = $datetime_end[2];
            $images['image_path'] = $image;
            $address['address'] = $this->input->get_post('event_address');
            $address['latitude'] = $this->input->get_post('latitude');
            $address['longitude'] = $this->input->get_post('longitude');
            $data['event_type_id'] = $this->input->get_post('event_type_id');
            if($id = $this->event_model->insert($data,$address))
            {              
               $images['event_id'] = $id;
               $this->event_model->upload_image($images);
               redirect('admin/event/list');	
            }
              
      }
   
   $this->load->view('admin/add_events');
 }
 public function update() {

   $id = $this->input->get_post('id');

   $this->form_validation->set_error_delimiters('<div>', '</div>');

   $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim');
   
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
      
      $image = $upload_detail['file_name'];
   }

   // If the validation worked
   if ($this->form_validation->run())
   {
      $data['name'] = $this->input->get_post('event_name');
      $event_id = $this->input->get_post('event_id');
      $data['description'] = $this->input->get_post('description');
      $date = explode("-", $this->input->get_post('datetime'));
      $datetime_start = explode(" ",$date[0]);
      $datetime_end = explode(" ",$date[1]);
      $data['date_start'] = $datetime_start[0];
      $data['time_start'] = $datetime_start[1];
      $data['date_end'] = $datetime_end[1];
      $data['time_end'] = $datetime_end[2];
     // $images['image_path'] = $image;
      $address['address'] = $this->input->get_post('event_address');
      $address['latitude'] = $this->input->get_post('latitude');
      $address['longitude'] = $this->input->get_post('longitude');
      $data['event_type_id'] = $this->input->get_post('event_type_id');
         
         if($this->event_model->update($event_id,$data,$address))
         {

           redirect('admin/event/list');	
         }
      
   
   }
   $this->data['id'] = $id;
   
   $this->data['update_data'] = $this->event_model->get_event_by_id($id);

   $this->load->view('admin/update_events', $this->data);
}
public function delete()
	{
		
		$delete_id = $this->uri->segment(4) ? $this->uri->segment(4) : $this->input->get_post('delete_id');
		
		$this->user_model->delete($delete_id);
		$_SESSION['msg_error'][] = 'Event deleted successfully!';
		redirect('admin/event/list', 'refresh');
	}
}
