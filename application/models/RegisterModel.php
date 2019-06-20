<?php

class RegisterModel extends CI_Model{
    public function add_user($data,$login){
        //get the data from controller and insert into the table 'users'
         $this->db->insert('user_login', $login);
		return $this->db->insert('users',$data);
    }
}
