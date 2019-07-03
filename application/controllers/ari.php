<?php
class Ari extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('Ari_model');

		 if(!$this->session->userdata('level')){
            redirect(base_url().'login');
         }
         else{
            $level=$this->session->userdata('level');
            if($level!='ari'){      
            	redirect(base_url().'login');

            }
    
           }

	}

	public function index(){
		$this->load->view('ari/header.php');
        $this->load->view('ari/dashboard.php');
		$this->load->view('ari/footer');
	}
	public function all_companies(){
		$data['all_companies'] = $this->Ari_model->all_companies();
		$this->load->view('ari/header.php');
	    $this->load->view('ari/all_companies', $data);
	    $this->load->view('ari/footer');

	}
    public function company_count(){
        $data= $this->Ari_model->company_count();
        echo $data;
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
			$date = date('Y-m-d H:i:s');
			$activation_key=sha1(rand(1,1000000).$date);
			$country='kenya';
			$added_by=$this->session->userdata('username');


            $data = [
                'company_name' => $company_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email,'added_by'=>$added_by,'country'=>$country
            ];
            $login=['activation_key'=>$activation_key,'email'=>$email];

            //pass the input values to the register model
            $insert_data = $this->Ari_model->add_company($data,$login);

            //if data inserted then set the success message and redirect to login page
            if ($insert_data) {
            	$this->session->set_flashdata('msg', 'Successfully added company details');
            	$this->load->library('email');

               $this->email->initialize(array('mailtype' => 'html','validate' => TRUE,));
                $mail_content="
                            <html>
                            <head>
                            <title>Account Activation</title>
                            </head>
                            <body>
                            <p>Thank you for signing up</p>
                            <p>Company::".$company_name."</p>
                        
                            <p>Click the link below to activate</p>
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

                        redirect(base_url() . 'ari/all_companies');
                    }
                }
            }
        }
    


                
 
           

	?>