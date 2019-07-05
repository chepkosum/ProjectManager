<?php
class Developer_profile extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('developer/Profile');
         

	}

	public function index(){
        $id=$this->session->userdata('user_id');
        $data['developer']=$this->Profile->edit_developer($id);
		$this->load->view('developer/header.php');
        $this->load->view('developer/profile.php',$data);
		$this->load->view('developer/footer');
	}
    public function password(){
        $this->load->view('developer/header.php');
        $this->load->view('developer/change_password.php');
        $this->load->view('developer/footer');


    }
    public function change_password(){
        $id=$this->session->userdata('user_id');
        $this->form_validation->set_rules('old_password', 'Old password is Required', 'required|min_length[3]');
        $this->form_validation->set_rules('new_password', 'New password is Required', 'required|min_length[3]');
    
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'developer/password');
        } else {
            //if not get the input values
            $old_password = sha1($this->input->post('old_password'));
            $new_password = sha1($this->input->post('new_password'));
            $data = ['password' => $new_password];

            $query=$this->Profile->change_password($data,$id,$old_password);
            if($query){
                $this->session->set_flashdata('msg', 'Successfully changed password');
                redirect(base_url() . 'developer/dashboard');
            }
            else{
                $this->session->set_flashdata('msg', 'Wrong old password');
                redirect(base_url() . 'developer/Developer_profile/password');

            }

            }
        }
	public function update_developer(){
        $id=$this->session->userdata('user_id');
		$this->form_validation->set_rules('full_name', ' Developer Name is Required', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'developer/Developer_profile');
        } else {
            //if not get the input values
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
			$address= $this->input->post('address');
			$postal_code = $this->input->post('postal_code');
			$town = $this->input->post('town');
    


            $data = [
                'full_name' => $full_name, 'address' => $address, 'postal_code' => $postal_code, 'town' => $town,'email'=>$email];

	        $query=$this->Profile->update_developer($data,$id);
	        if($query){
	        	$this->session->set_flashdata('msg', 'Successfully updated record');
                redirect(base_url() . 'developer/Developer_profile');
	        }

	        }
	    }
	
	
}
?>