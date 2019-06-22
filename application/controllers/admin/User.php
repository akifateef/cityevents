<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

   public function __construct() {
      parent::__construct();

      $this->load->model('user_model');
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
      
      $this->data['users'] = $this->user_model->list();
      $this->load->view('admin/view_users',$this->data);
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
                  $redirect_url = isset($_SESSION['redirect_to_last_url']) ? $_SESSION['redirect_to_last_url'] : base_url().'admin/user/index';
                  unset($_SESSION['redirect_to_last_url']);
                  redirect($redirect_url,'location');

         }
         else
         {
            $_SESSION['msg_error'][] = 'Either email or password is wrong';
         }


      $this->load->view('admin/login',$this->data);
   }
   public function logout()
   {
      session_destroy();
      redirect(base_url().'admin/user/login','refresh');

   }

}
