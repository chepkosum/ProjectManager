<?php
class Manager extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('company/Manager_model');
         

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
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email
            ];

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

            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email,'user_type'=>$user_type,'activation_key'=>$activation_key
            ];

            //pass the input values to the register model
            $insert_data = $this->Manager_model->add_manager($data);

            //if data inserted then set the success message and redirect to login page
            if ($insert_data) {
            	$this->session->set_flashdata('msg', 'Project Manager details added successfully');
                $to = $email;
                $subject = "Account Activation";

                 $message = "
                <html>
                <head>
                <title>Thank you</title>
                </head>
                <body>
                <p>Click on the link below to activation your account</p>
                <p>http://localhost:8080/codeigniter-reg-login-master/index.php/activate/index/".$activation_key."</p>

                 </body>
                 </html>
                 ";

                 // Always set content-type when sending HTML email
                 $headers = "MIME-Version: 1.0" . "\r\n";
                 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                 // More headers
                 $headers .= 'From: <codecompany1@gmail.com>' . "\r\n";
                //$headers .= 'Cc: myboss@example.com' . "\r\n";

                mail($to,$subject,$message,$headers);


                redirect(base_url() . 'company/manager/all_managers');
            }
        }
	}
}
?>