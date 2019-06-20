<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required helpers and libraries
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
        
        //load our Register model here
        $this->load->model('RegisterModel', 'register');
    }

    //registration form page
    public function index() {
        //check if the user is already logged in 
        //if yes redirect to the welcome page
        if ($this->session->userdata('logged_in')) {
            redirect(base_url() . 'welcome');
        }
        //load the register page views
        $this->load->view('header');
        $this->load->view('register_page');
        $this->load->view('footer');
    }

    //register validation and logic
    public function doRegister() {
        //set the form validation here
        $this->form_validation->set_rules('full_name', 'full_name', 'required|min_length[3]');
        $this->form_validation->set_message('is_unique', 'Email already exists.');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'register');
        } else {
            //if not get the input values
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');
			$username= $this->input->post('username');
            $password = sha1($this->input->post('password'));

            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town
            ];
			$login=['username' => $username, 'email' => $email, 'password' => $password];

            //pass the input values to the register model
            $insert_data = $this->register->add_user($data,$login);

            //if data inserted then set the success message and redirect to login page
            if ($insert_data) {
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
                            <p>Password: ".$password."</p>
                            <p>Please click the link below to activate your account.</p>
                            <h4><a href='".base_url()."user/activate/".$username."/".$email."'>Activate My Account</a></h4>
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
                $this->session->set_flashdata('msg', 'Successfully Register, Login now!');
                redirect(base_url() . 'login');
            }
        }
    }

}
