<?php

class Profile extends CI_Model{
   
  
    public function edit_developer($id){
    	$query=$this->db->get_where('users',array('user_id'=>$id));
    	return $query->row_array();
    }
    public function update_developer($data,$id){
    	$this->db->where('users.user_id',$id);
    	return $this->db->update('users',$data);
    }
     public function change_password($data,$id,$old_password){
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where('user_id',$id);
        $this->db->where('password',$old_password);
        $query= $this->db->get();
        if($query->num_rows()>0){
            $this->db->where('user_login.user_id',$id);
            return $this->db->update('user_login',$data);

        }

    }

}
