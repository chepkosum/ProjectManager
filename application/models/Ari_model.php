<?php

class Ari_model extends CI_Model{
    public function add_company($data){
        //get the data from controller and insert into the table 'users'
         
		return $this->db->insert('company',$data);
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
