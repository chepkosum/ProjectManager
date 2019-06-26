<?php

class Activation_model extends CI_Model{
    public function activation($key){
    	$query=$this->db->get_where('user_login' ,array('activation_key'=>$key));
    	return $query->row_array();
    }
    public function insert_credentials($login,$key){
        $query=$this->db->get_where('user_login',array('activation_key'=>$key));
        if($query->num_rows()==1){
            $this->db->where('user_login.activation_key',$key);
            $this->db->update('user_login',$login);
            return true;
    }
  
}
    public function get_role($key){
         $this->db->select("*");
         $this->db->from('user_login');
         $this->db->where('activation_key',$key);
         $query = $this->db->get();
         $row  = $query->row();
         $email=$row->email;

         $this->db->select("*");
         $this->db->from('users');
         $this->db->where('email',$email);
         $query = $this->db->get();
         if($query->num_rows()>0){
            $row  = $query->row();
            return $row->user_type;
         }
         else{
         $this->db->select("*");
         $this->db->from('company');
         $this->db->where('email',$email);
         $query = $this->db->get();
         if($query->num_rows()>0){
            return 'company';
         }

         }
         


    }
}
