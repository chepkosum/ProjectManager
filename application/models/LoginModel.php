<?php

class LoginModel extends CI_Model {

    public function checkLogin($username, $password) {
        //query the table 'users' and get the result count
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('user_login',1);

        return $result;
    }

}
