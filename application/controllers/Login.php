<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        //load the Login Model
        $this->load->model('LoginModel', 'login');
    }

    public function index() {
        //check if the user is already logged in 
        $level= $this->session->userdata('level');
        if($level==='ari'){
                redirect(base_url().'ari');
            }
        if($level==='company'){
                $this->load->view('company_dashboard');
            }
        if($level==='manager'){
                $this->load->view('manager_dashboard');
            }
        if($level==='developer'){
                redirect(base_url().'developer_dashboard');

            }
        
        //if not load the login page
        $this->load->view('header');
        $this->load->view('login_page');
        $this->load->view('footer');
    }

    public function doLogin() {
        //get the input fields from login form
        $username= $this->input->post('username');
        $password = sha1($this->input->post('password'));
        
        //send the email pass to query if the user is present or not
        $check_login = $this->login->checkLogin($username, $password);

        //if the result is query result is 1 then valid user
        if ($check_login->num_rows()>0) {
            $data=$check_login->row_array();
            $name=$data['username'];
            $email=$data['email'];
            $level=$data['role'];
            $sesdata=array(
                'username'=>$name,
                'email'=>$email,
                'level'=>$level,
                'logged_in'=>TRUE

            );
            $this->session->set_userdata($sesdata);
            if($level==='ari'){
                redirect(base_url().'ari');
            }
            elseif($level==='company'){
                $this->load->view('company_dashboard');
            }
            elseif($level==='manager'){
                $this->load->view('manager_dashboard');
            }
            else{
                redirect(base_url().'developer_dashboard');

            }
            //if yes then set the session 'loggin_in' as true
            
        } else {
            //if no then set the session 'logged_in' as false
            $this->session->set_userdata('logged_in', false);
            
            //and redirect to login page with flashdata invalid msg
            $this->session->set_flashdata('msg', 'Username / Password Invalid');
            redirect(base_url().'login');            
        }
    }

    public function logout() {
        //unset the logged_in session and redirect to login page
        $this->session->unset_userdata('level');
        redirect(base_url().'login');
    }

}
