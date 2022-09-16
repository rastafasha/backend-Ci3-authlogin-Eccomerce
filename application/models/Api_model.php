<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model 
{
	
	public function get_users()
	{
		$this->db->select('user.*');
		$this->db->from('users user');

		$this->db->order_by('user.created_at', 'asc');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_user($id)
	{
		$this->db->select('user.*');
		$this->db->from('users user');
		$this->db->where('user.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_admin_user($id)
	{
		$this->db->select('user.*');
		$this->db->from('users user');
		$this->db->where('user.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertUser($userData)
	{
		$this->db->insert('users', $userData);
		return $this->db->insert_id();
	}

	public function updateUser($id, $userData)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $userData);
	}

	public function checkToken($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('users');

		if($query->num_rows() == 1) {
			return true;
		}
		return false;
	}


	public function deleteUser($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

}
