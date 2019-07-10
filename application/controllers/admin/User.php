<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

   public function __construct() {
      parent::__construct();

      $this->load->model('user_model');
      $this->data = array();
   }

   public function index() {
      
      $this->load->view('admin/dashboard',$this->data);
   }
   public function list() {
     
      $this->data['users'] = $this->user_model->list();
      $this->load->view('admin/view_users',$this->data);
   }

   public function update() {

      $id = $this->input->get_post('id');
   
		$this->form_validation->set_error_delimiters('<div>', '</div>');
	
		$this->form_validation->set_rules('f_name', 'Name', 'required|trim');
		
		// If the validation worked
		if ($this->form_validation->run())
		{
				$password=$this->input->get_post('password');
				$data['f_name'] = $this->input->get_post('f_name');
				$data['email'] = $this->input->get_post('email');
            $data['l_name'] = $this->input->get_post('l_name');
			   $user_id = $this->input->get_post('id');
            if($password!='') {
					$data['password'] = md5($password);
				}
				
				$data['contact_no'] = $this->input->get_post('contact_no');
				
				if($this->user_model->update($user_id,$data))
				{
					
					$_SESSION['msg_success'][] = 'Profile Updated...';
					redirect('admin/user/list');	
				}
			
		
      }
		$this->data['id'] = $id;
		
		$this->data['update_data'] = $this->user_model->get_user_by_id($id);

		$this->load->view('admin/user_details', $this->data);
	}
	
      public function login() {

      # if user is already logged in, then redirect him to welcome page
      if(isset($_SESSION['user']['user_id']) )
      {
         redirect(base_url().'admin/user/index','refresh');
      }

         $login_detail['user_name'] = $this->input->get_post('user_name');
         $login_detail['password'] = $this->input->get_post('password');
         if($user_detail = $this->user_model->check_login($login_detail)) // if login suceess
         {
                  $this->load->library('session');
                 # Set session here and redirect user
                  $_SESSION['user'] = $user_detail;
                  $redirect_url = isset($_SESSION['redirect_to_last_url']) ? $_SESSION['redirect_to_last_url'] : base_url().'admin/event/list';
                  unset($_SESSION['redirect_to_last_url']);
                  redirect($redirect_url,'location');

         }
         else
         {
            $_SESSION['msg_error'][] = 'Either email or password is wrong';
         }


      $this->load->view('login',$this->data);
   }
   public function logout()
   {
      session_destroy();
      redirect(base_url().'event/login','refresh');

   }
   public function delete()
	{
		
		$delete_id = $this->uri->segment(4) ? $this->uri->segment(4) : $this->input->get_post('delete_id');
		
		$this->user_model->delete($delete_id);
		$_SESSION['msg_error'][] = 'User deleted successfully!';
		redirect('admin/user/list', 'refresh');
	}
   public function insert() {
  
      $this->form_validation->set_error_delimiters('<div>', '</div>');

      $this->form_validation->set_rules('email', 'Email', 'required|trim');
      
      // If the validation worked
      if ($this->form_validation->run())
      {    
         $data['password'] =$this->input->get_post('password');
         $data['f_name'] = $this->input->get_post('f_name');
         $data['email'] = $this->input->get_post('email');
         $data['l_name'] = $this->input->get_post('l_name');
         $data['user_name'] = $this->input->get_post('user_name');
         $data['user_type_id'] = '2';
                    if($this->user_model->insert($data))
            {               
                          redirect('event/login?register=success');	
            }
              
      }
   }
}
