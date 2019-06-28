<?php
class Project extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(['form_validation','session']);
		$this->load->database();
		$this->load->model('manager/Project_model');
         if(!$this->session->userdata('level')){
            redirect(base_url().'login');
         }
         else{
            $level=$this->session->userdata('level');
            if($level!='manager'){      
                redirect(base_url().'login');

            }
    
           }

	}

	public function index(){
		$this->load->view('manager/header.php');
		$this->load->view('manager/footer');
	}
	public function all_projects(){
		$data['projects'] = $this->Project_model->all_projects();

		$this->load->view('manager/header.php');
	    $this->load->view('manager/all_projects', $data);
	    $this->load->view('manager/footer');
	}
	public function edit_project($id){
		$data['project']=$this->Project_model->edit_project($id);
		$this->load->view('manager/header.php');
	    $this->load->view('manager/edit_project', $data);
	    $this->load->view('manager/footer');
	}

	public function update_project($id){
		$this->form_validation->set_rules('company_name', ' Company Name is Required', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email[users.email]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors  flashdata (one time session)
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
	public function add_project(){
		$this->load->view('manager/header.php');
		$this->load->view('manager/add_project_form');
		$this->load->view('manager/footer');

	}

	public function delete_company($id){
		$query=$this->Ari_model->delete_company($id);
	    if($query){
	    	$this->session->set_flashdata('msg', 'Deleted successfully');
	    	redirect(base_url() . 'ari/all_companies');
	    }
    }
	public function insert_project(){
		$this->form_validation->set_rules('project_name', ' Project Name is Required', 'required|min_length[3]');

        //if the above validation fails, redirect to register page
        //with vaildation_errors();
        if ($this->form_validation->run() == FALSE) {
            //set the validation errors in flashdata (one time session)
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url() . 'manager/project/add_project');
        } else {
            //if not get the input values
            $project_name = $this->input->post('project_name');
            $start_date = $this->input->post('start_date');
			$end_date= $this->input->post('end_date');
			$manager_id=$this->session->userdata('user_id');
            $deliverables= $this->input->post('deliverables');
            $company_id=$this->session->userdata('company_id');

            $data = [
                'project_name' => $project_name, 'start_date' => $start_date, 'end_date' => $end_date, 'manager_id' => $manager_id,'company_id'=>$company_id
            ];

            //pass the input values to the register model
            $insert_data = $this->Project_model->add_project($data,$deliverables);

            //if data inserted then set the success message and redirect to login page
            if ($insert_data==true) {
                $this->session->set_flashdata('msg', 'Successfully added project');
                redirect(base_url() . 'manager/project/all_projects');
            }
        }
	}
}
?>