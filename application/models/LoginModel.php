<?php

class LoginModel extends CI_Model {

    public function checkLogin($username, $password) {
        //query the table 'users' and get the result count
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('user_login',1);

        return $result;
    }
    public function account($key){
    	$query=$this->db->get_where('user_login',array('activation_key'=>$key));
    	if($query->num_rows()>=1){
    		$this->db->where('user_login.activation_key',$key);
    		$infor=['active'=>1];
    		$this->db->update('user_login',$infor);
    		return true;
    }

}
}
