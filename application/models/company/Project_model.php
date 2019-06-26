<?php

class Project_model extends CI_Model{
    public function add_manager($data){
        //get the data from controller and insert into the table 'users'
         
		return $this->db->insert('users',$data);
    }
    public function all_projects(){
    	$query=$this->db->get_where('users' ,array('user_type'=>'manager'));
    	return $query->result();
    }
    public function edit_manager($id){
    	$query=$this->db->get_where('users',array('user_id'=>$id));
    	return $query->row_array();
    }
    public function update_manager($manager,$id){
    	$this->db->where('users.user_id',$id);
    	return $this->db->update('users',$manager);
    }
    public function delete_manager($id){
    	$this->db->where('users.user_id',$id);
    	return $this->db->delete('users');
    }
     public function get_manager_names(){
        $query=$this->db->get_where('users' ,array('user_type'=>'manager'));
        return $query->result();
    }

}
