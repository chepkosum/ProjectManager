<?php
class Developer extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('manager/Developer_model');
         

	}

	public function index(){
		$this->load->view('manager/header.php');
        $this->load->view('manager/dashboard.php');
		$this->load->view('manager/footer');
	}
	public function all_developers(){
		$data['all_developers'] = $this->Developer_model->all_developers();
		$this->load->view('manager/header.php');
	    $this->load->view('manager/all_developers', $data);
	    $this->load->view('manager/footer');
	}
	public function edit_developer($id){
		$data['developer']=$this->Developer_model->edit_developer($id);
		$this->load->view('manager/header.php');
	    $this->load->view('manager/edit_developer', $data);
	    $this->load->view('manager/footer');
	}

	public function update_developer($id){
		$this->form_validation->set_rules('full_name', ' Developer Name is Required', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'manager/developer/edit_developer');
        } else {
            //if not get the input values
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');
    


            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town];

	        $query=$this->Developer_model->update_developer($data,$id);
	        if($query){
	        	$this->session->set_flashdata('msg', 'Successfully updated developer record');
                redirect(base_url() . 'manager/developer/all_developers');
	        }

	        }
	    }
	public function add_developer(){
		$this->load->view('manager/header.php');
		$this->load->view('manager/add_developer_form');
		$this->load->view('manager/footer');

	}

	public function delete_developer($id){
		$query=$this->Developer_model->delete_developer($id);
	    if($query){
	    	$this->session->set_flashdata('msg', 'Deleted successfully');
	    	redirect(base_url() . 'manager/developer/all_developers');
	    }
    }
	public function insert_developer(){
		$this->form_validation->set_rules('full_name', 'Name is Required', 'required|min_length[3]');
        $this->form_validation->set_message('is_unique', 'Email already exists.');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'manager/developer/add_developer');
        } else {
            //if not get the input values
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');
            $user_type='developer';
            $date=$date = date('Y/m/d H:i:s');
            $activation_key=sha1(rand(1,1000000).$date);
            $added_by=$this->session->userdata('username');
            $company_id=$this->session->userdata('company_id');


            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email,'user_type'=>$user_type,'company_id'=>$company_id,'user_type'=>$user_type,'added_by'=>$added_by,'company_id'=>$company_id
            ];
            $login=['active'=>0,'email'=>$email,'company_id'=>$company_id,'activation_key'=>$activation_key,'role'=>$user_type];

            $query=$this->Developer_model->add_developer($data,$login);
            if($query){
                $this->session->set_flashdata('msg', 'Successfully added developer,');
                $this->load->library('email');

               $this->email->initialize(array('mailtype' => 'html','validate' => TRUE,));
                $mail_content="
                            <html>
                            <head>
                            <title>Account Activation</title>
                            </head>
                            <body>
                            <p>You have been added as a developer</p>
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


                redirect(base_url() . 'manager/developer/all_developers');
            }
        }
	}
}
?>