<?php

class Project_model extends CI_Model{
    public function add_project($data,$deliverables){
        $this->db->trans_start();
		$this->db->insert('projects',$data);
        $project_id=$this->db->insert_id();
        foreach($deliverables as $key) {
            $data1=['project_id'=>$project_id,'deliverable_name'=>$key];
            $this->db->insert('deliverables',$data1);
       
        }
        $this->db->trans_complete();
         $this->db->trans_status();


    }
    public function all_projects(){
    	$this->db->select('projects.project_id,projects.project_name,projects.start_date,projects.end_date,users.full_name');
        $this->db->from('projects');
        $this->db->join('users','projects.manager_id=users.user_id');
        $query= $this->db->get();
        return $query->result();

    }
   
    public function edit_project($id){
    	$query=$this->db->get_where('projects',array('project_id'=>$id));
    	return $query->row_array();
    }
    public function update_project($project,$id){
    	$this->db->where('projects.project_id',$id);
    	return $this->db->update('projects',$project);
    }
    public function delete_project($id){
    	$this->db->where('projects.project_id',$id);
    	return $this->db->delete('projects');
    }

}
