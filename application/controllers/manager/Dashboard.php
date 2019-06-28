<?php
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		//$this->load->model('company/Dashboard_model');
		 if(!$this->session->userdata('level')){
            redirect(base_url().'login');
         }
         else{
            $level=$this->session->userdata('level');
            if($level!='manager'){      
            	redirect(base_url().'login');

            }
    
           }
         

	}

	public function index(){
		$this->load->view('manager/header.php');
        $this->load->view('manager/dashboard.php');
        $this->load->view('manager/footer');
	}
	
}
?>