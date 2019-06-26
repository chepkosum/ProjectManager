<?php
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('company/Dashboard_model');
         

	}

	public function index(){
		$this->load->view('company/header.php');
        $this->load->view('company/dashboard.php');
        $this->load->view('company/footer');
	}
	
}
?>