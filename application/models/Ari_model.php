<?php

class Ari_model extends CI_Model{
    public function add_company($data,$login){
        //get the data from controller and insert into the table 'users'
         
		$this->db->trans_start();

    	$this->db->insert('company', $data);

    	$user_id=$this->db->insert_id();
    	$login1=array('user_id'=>$user_id);
    	$login2=$login1+$login;


		$this->db->insert('user_login',$login2);

		$this->db->trans_complete();

		return $this->db->trans_status();
    }
    public function all_companies(){
    	$query=$this->db->get('company');
    	return $query->result();
    }
    public function edit_company($id){
    	$query=$this->db->get_where('company',array('company_id'=>$id));
    	return $query->row_array();
    }
    public function update_company($company,$id){
    	$this->db->where('company.company_id',$id);
    	return $this->db->update('company',$company);
    }
    public function delete_company($id){
    	$this->db->where('company.company_id',$id);
    	return $this->db->delete('company');
    }
}
