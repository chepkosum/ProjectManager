<?php

class RegisterModel extends CI_Model{
    public function add_user($data,$login){
    	$this->db->trans_start();

    	$this->db->insert('users', $data);

    	$user_id=$this->db->insert_id();
    	$login1=array('user_id'=>$user_id);
    	$login2=$login1+$login;


		$this->db->insert('user_login',$login2);

		$this->db->trans_complete();

		return $this->db->trans_status();

    }


}
