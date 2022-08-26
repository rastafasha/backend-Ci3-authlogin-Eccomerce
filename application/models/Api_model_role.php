<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_role extends CI_Model 
{
	public function get_roles()
	{
		$this->db->select('role.*');
		$this->db->from('roles role');
		$this->db->order_by('role.created_at', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_role($id)
	{
		$this->db->select('role.*');
		$this->db->from('roles role');
		$this->db->where('role.status', 1);
		$this->db->where('role.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_roles()
	{
		$this->db->select('role.*');
		$this->db->from('roles role');
		$this->db->order_by('role.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_role($id)
	{
		$this->db->select('role.*');
		$this->db->from('roles role');
		$this->db->where('role.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertRole($roleData)
	{
		$this->db->insert('roles', $roleData);
		return $this->db->insert_id();
	}

	public function updateRole($id, $roleData)
	{
		$this->db->where('id', $id);
		$this->db->update('roles', $roleData);
	}

	public function deleteRole($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('roles');
	}
}
