<?php
class Manager extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('company/Manager_model');
         if(!$this->session->userdata('level')){
            redirect(base_url().'login');
         }
         else{
            $level=$this->session->userdata('level');
            if($level!='company'){      
                redirect(base_url().'login');

            }
    
           }
         

	}

	public function index(){
		$this->load->view('company/header.php');
		$this->load->view('company/footer');
	}
	public function all_managers(){
		$data['all_managers'] = $this->Manager_model->all_managers();
		$this->load->view('company/header.php');
	    $this->load->view('company/all_managers', $data);
	    $this->load->view('company/footer');
	}
	public function edit_manager($id){
		$data['manager']=$this->Manager_model->edit_manager($id);
		$this->load->view('company/header.php');
	    $this->load->view('company/edit_manager', $data);
	    $this->load->view('company/footer');
	}

	public function update_manager($id){
		$this->form_validation->set_rules('full_name', ' Manager Name is Required', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'company/manager/edit_manager');
        } else {
            //if not get the input values
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');
    


            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town];

	        $query=$this->Manager_model->update_manager($data,$id);
	        if($query){
	        	$this->session->set_flashdata('msg', 'Successfully updated project manager record');
                redirect(base_url() . 'company/manager/all_managers');
	        }

	        }
	    }
	public function add_manager(){
		$this->load->view('company/header.php');
		$this->load->view('company/add_manager_form');
		$this->load->view('company/footer');

	}

	public function delete_manager($id){
		$query=$this->Ari_model->delete_manager($id);
	    if($query){
	    	$this->session->set_flashdata('msg', 'Deleted successfully');
	    	redirect(base_url() . 'manager/all_managers');
	    }
    }
	public function insert_manager(){
		$this->form_validation->set_rules('full_name', 'Name is Required', 'required|min_length[3]');
        $this->form_validation->set_message('is_unique', 'Email already exists.');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'company/manager/add_manager');
        } else {
            //if not get the input values
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');
            $user_type='manager';
            $date=$date = date('Y/m/d H:i:s');
            $activation_key=sha1(rand(1,1000000).$date);
            $added_by=$this->session->userdata('username');
            $company_id=$this->session->userdata('company_id');


            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email,'user_type'=>$user_type,'company_id'=>$company_id,'user_type'=>$user_type,'added_by'=>$added_by,'company_id'=>$company_id
            ];
            $login=['active'=>0,'email'=>$email,'company_id'=>$company_id,'activation_key'=>$activation_key,'role'=>$user_type];

            $query=$this->Manager_model->add_manager($data,$login);
            if($query){
                $this->session->set_flashdata('msg', 'Successfully added project manager,');
                $this->load->library('email');

               $this->email->initialize(array('mailtype' => 'html','validate' => TRUE,));
                $mail_content="
                            <html>
                            <head>
                            <title>Account Activation</title>
                            </head>
                            <body>
                            <p>You have been added as a project manager</p>
                            <p>Name::".$full_name."</p>
                        
                            <p>Click the link below to activate your account</p>
                            <p>".base_url()."activate/index/".$activation_key."</p>

                            </body>
                            </html>
                          ";

                            $this->email->from('codingcompany1@gmail.com', 'Acccount Activation');
                            $this->email->to($email);
                            $this->email->subject('Account Activation');
                            $this->email->message($mail_content);

                            if ($this->email->send()) {
                             $this->session->set_flashdata('message', 'Message sent to email for verification');
                            }else{
                            echo($this->email->print_debugger()); //Display errors if any
                            }


                redirect(base_url() . 'company/manager/all_managers');
            }
        }
	}
}
?>