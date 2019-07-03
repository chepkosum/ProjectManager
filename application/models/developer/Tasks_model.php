<?php

class Tasks_model extends CI_Model{
   
    public function all_tasks(){
        $this->db->select('*');
        $this->db->from('deliverables');
        $this->db->join('projects','deliverables.project_id=projects.project_id');
        $query= $this->db->get();
        return $query->result();
    }
    public function delete_manager($id){
        $this->db->where('users.user_id',$id);
        return $this->db->delete('users');
    }
    public function update_deliverable($id,$data){
        $this->db->where('deliverables.deliverable_id',$id);
        return $this->db->update('deliverables',$data);
    }
  
}
