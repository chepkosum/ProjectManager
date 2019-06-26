<?php
class Activate extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('Activation_model');
	}
	public function index($key){
		$data['user']=$this->Activation_model->activation($key);
		$this->load->view('activation_header');
		$this->load->view('activate',$data);
		return $key;
	}
	public function credentials($key){
		$role=$this->Activation_model->get_role($key);


		$this->form_validation->set_rules('username','Username', 'required|min_length[3]');
		$this->form_validation->set_message('is_unique', 'Userneme already exists .');
		$this->form_validation->set_rules('username', 'Userneme', 'required|is_unique[user_login.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'activate');
        } else {
			$username= $this->input->post('username');
            $password = sha1($this->input->post('password'));
			$login=['username' => $username, 'password' => $password,'active'=>1,'role'=>$role];


            $insert_data = $this->Activation_model->insert_credentials($login,$key);
            if($insert_data){
            	$this->session->set_flashdata('msg', 'Successfully activated your account');
            	redirect(base_url().'login');

            }
	}
}
}


?>