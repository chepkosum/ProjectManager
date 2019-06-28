<?php

class Manager_model extends CI_Model{
    public function add_manager($data,$login){
        $this->db->trans_start();

        $this->db->insert('users', $data);

        $user_id=$this->db->insert_id();
        $login1=array('user_id'=>$user_id);
        $login2=$login1+$login;


        $this->db->insert('user_login',$login2);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    public function all_managers(){
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
}
