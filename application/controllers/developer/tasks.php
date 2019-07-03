<?php
class Tasks extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('developer/Tasks_model');

	}

	public function index(){
        $data['tasks']=$this->Tasks_model->all_tasks();
		$this->load->view('developer/header.php');
        $this->load->view('developer/tasks.php',$data);
		$this->load->view('developer/footer');
	}
    public function mark($id){
        $data=['developer_mark'=>'yes'];
        $result=$this->Tasks_model->update_deliverable($id,$data);
        if($result){
            redirect(base_url().'developer/tasks');
        }
        else{

        }
    }
	
}
?>