<?php

class AuthModel extends CI_Model{

    function check_login($email, $password, $id){

        $this->db->select('*');
        $this->db->from('users user');
        $this->db->where('email', $email);
        $this->db->where('user.user_id', $id);
        $this->db->where('password', $password);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return 'User not Found';
        }

    }

    function renewToken(){
        $this->db->select('user.*');
		$this->db->from('users user');
        $query = $this->db->get();

        return $query->row();
    }

    

    function getRoles(){
        $this->db->select('*');
        $this->db->from('roles');
        $query = $this->db->get();

        return $query->result_array();
    }

   

    function getUsers(){
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();

        return $query->result_array();
    }

    function signup($userData){
        $this->db->insert('users', $userData);
        return $this->db->insert_id();

    }

    


}