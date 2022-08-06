<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model 
{
	
	public function get_users($recentpost)
	{
		$this->db->select('user.*');
		$this->db->from('users user');

		if($recentpost){
			$this->db->order_by('user.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_user($id)
	{
		$this->db->select('user.*');
		$this->db->from('users user');
		$this->db->where('user.user_id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_admin_user($id)
	{
		$this->db->select('user.*');
		$this->db->from('users user');
		$this->db->where('user.user_id', $id);
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
		$this->db->where('user_id', $id);
		$this->db->update('users', $userData);
	}


	public function deleteUser($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('users');
	}

}
