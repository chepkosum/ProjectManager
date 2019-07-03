<?php

class Project_model extends CI_Model{
    public function add_project($data,$deliverables,$developers){
        $this->db->trans_start();
		$this->db->insert('projects',$data);
        $project_id=$this->db->insert_id();
             for($i = 0; $i < count($deliverables); $i++){
                $name = $deliverables[$i];
                $id = $developers[$i];
                $data1=['project_id'=>$project_id,'deliverable_name'=>$name,'developer_id'=>$id];
            $this->db->insert('deliverables',$data1);

       
        }
        $this->db->trans_complete();
        return $this->db->trans_status();


    }
    public function all_projects(){
    	$this->db->select('*');
        $this->db->from('projects');
        $this->db->join('users','projects.manager_id=users.user_id');
        $query= $this->db->get();
        return $query->result();

    }
     public function all_deliverables(){
        $this->db->select('*');
        $this->db->from('deliverables');
         $this->db->join('users','deliverables.developer_id=users.user_id');
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
    public function update_deliverable($id,$data){
        $this->db->where('deliverables.deliverable_id',$id);
        return $this->db->update('deliverables',$data);
    }
  

}
