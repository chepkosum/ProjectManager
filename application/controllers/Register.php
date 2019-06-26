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
            $role='ari';
            $activation_key=sha1(rand(1,1000000).$date);
            $user_type='ari';
            $role='ari';

            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email
            ];
			$login=['username' => $username, 'email' => $email, 'password' => $password,'role'=>$role,'activation_key'=>$activation_key];

            //pass the input values to the register model
            $insert_data = $this->register->add_user($data,$login );

            //if data inserted then set the success message and redirect to login page
            if ($insert_data) {
               $this->load->library('email');

               $this->email->initialize(array('mailtype' => 'html','validate' => TRUE,));
                $mail_content="
                            <html>
                            <head>
                            <title>Account Activation</title>
                            </head>
                            <body>
                            <p>Thank you for signing up</p>
                            <p>Username::".$username."</p>
                        
                            <p>Click the link below to activate</p>
                            <p>".base_url()."login/activate/".$activation_key."</p>

                            </body>
                            </html>
                          ";

                            $this->email->from('codingcompany1@gmail.com', 'Acccount Activation');
                            $this->email->to($email);
                            $this->email->subject('Account Activation');
                            $this->email->message($mail_content);

                            if ($this->email->send()) {
                             $this->session->set_flashdata('message', 'We have sent you an email,click the link to activate so that you can log in');
                            }else{
                            echo($this->email->print_debugger()); //Display errors if any
                            }

                $this->session->set_flashdata('msg', 'Successfully Registered');
                redirect(base_url() . 'login');
            }
        }
    }

}
