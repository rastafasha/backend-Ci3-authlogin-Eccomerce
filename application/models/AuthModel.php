<?php

class AuthModel extends CI_Model{

    function check_login($email, $password){

        $this->db->select();
        $this->db->from('users user');
        $this->db->where('user.email', $email);
        $this->db->where('user.password', $password);
        // $this->db->where('user.user_id', $id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row();
            // return $query->result_array();
        }else{
            return 'User not Found';
        }

    }

    function renewToken($id){
        // var_dump($id);
        $this->db->select();
		$this->db->from('users user');
        $this->db->where('user.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    // token

	public function checkToken($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('users');

		if($query->num_rows() == 1) {
			return true;
		}
		return false;
	}

    public function get_user($id)
	{
		$this->db->select('user.*');
		$this->db->from('users user');
		$this->db->where('user.user_id', $id);
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