<?php
class Ari extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('Ari_model');

	}

	public function index(){
		$this->load->view('ari/header.php');
		$this->load->view('ari/footer');
	}
	public function all_companies(){
		$data['all_companies'] = $this->Ari_model->all_companies();
		$this->load->view('ari/header.php');
	    $this->load->view('ari/all_companies', $data);
	    $this->load->view('ari/footer');
	}
	public function edit_company($id){
		$data['company']=$this->Ari_model->edit_company($id);
		$this->load->view('ari/header.php');
	    $this->load->view('ari/edit_company', $data);
	    $this->load->view('ari/footer');
	}

	public function update_company($id){
		$this->form_validation->set_rules('company_name', ' Company Name is Required', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'ari/edit_company');
        } else {
            //if not get the input values
            $company_name = $this->input->post('company_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');

            $data = [
                'company_name' => $company_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email
            ];

	        $query=$this->Ari_model->update_company($data,$id);
	        if($query){
	        	$this->session->set_flashdata('msg', 'Successfully updated company record');
                redirect(base_url() . 'ari/all_companies');
	        }

	        }
	    }
	public function add_company(){
		$this->load->view('ari/header.php');
		$this->load->view('ari/ari_add_company_form');
		$this->load->view('ari/footer');

	}

	public function delete_company($id){
		$query=$this->Ari_model->delete_company($id);
	    if($query){
	    	$this->session->set_flashdata('msg', 'Deleted successfully');
	    	redirect(base_url() . 'ari/all_companies');
	    }
    }
	public function insert_company(){
		$this->form_validation->set_rules('company_name', ' Company Name is Required', 'required|min_length[3]');
        $this->form_validation->set_message('is_unique', 'Email already exists.');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'ari/add_company');
        } else {
            //if not get the input values
            $company_name = $this->input->post('company_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');

            $data = [
                'company_name' => $company_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email
            ];

            //pass the input values to the register model
            $insert_data = $this->Ari_model->add_company($data);

            //if data inserted then set the success message and redirect to login page
            if ($insert_data) {
            	$this->session->set_flashdata('msg', 'Company details added successfully');

                $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 587,
                'smtp_user' => '<a href="mailto:testsourcecodester@gmail.com" rel="nofollow">testsourcecodester@gmail.com</a>', // change it to yours
                'smtp_pass' => 'mysourcepass', // change it to yours
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );
 
            $message =  "
                        <html>
                        <head>
                            <title>Verification Code</title>
                        </head>
                        <body>
                            <h2>Thank you for Registering.</h2>
                            <p>Your Account:</p>
                            <p>Email: ".$email."</p>
                            <p>Please click the link below to activate your account.</p>
                            <h4><a href='".base_url()."user/activate/".$company_name."/".$email."'>Activate My Account</a></h4>
                        </body>
                        </html>
                        ";
 
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($config['smtp_user']);
            $this->email->to($email);
            $this->email->subject('Signup Verification Email');
            $this->email->message($message);
 
            //sending email
            if($this->email->send()){
                $this->session->set_flashdata('message','Activation code sent to email');
            }
            else{
                $this->session->set_flashdata('message', $this->email->print_debugger());
 
            }
                $this->session->set_flashdata('msg', 'Successfully updated');
                redirect(base_url() . 'ari/login');
            }
        }
	}
}
?>