<?php
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
         if(!$this->session->userdata('level')){
            redirect(base_url().'login');
         }
         else{
            $level=$this->session->userdata('level');
            if($level!='company'){      
                redirect(base_url().'login');

            }
    
           }
		//$this->load->model('company/Dashboard_model');
         

	}

	public function index(){
		$this->load->view('company/header.php');
        $this->load->view('company/dashboard.php');
        $this->load->view('company/footer');
	}
	
}
?>