<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_direccion extends CI_Model 
{
	public function get_direccions($featured, $recentpost)
	{
		$this->db->select('direccion.*, u.first_name, u.last_name');
		$this->db->from('direccions direccion');
        $this->db->join('users u', 'u.id=direccion.user_id');

		if($featured) {
			$this->db->where('direccion.is_featured', 1);
		}
		if($recentpost){
			$this->db->order_by('direccion.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_direccion($id)
	{
		$this->db->select('direccion.*');
		$this->db->from('direccions direccion');
		$this->db->join('users u', 'u.id=direccion.user_id');
		$this->db->where('direccion.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	

	public function get_admin_direccions()
	{
		$this->db->select('direccion.*, u.first_name, u.last_name');
		$this->db->from('direccions direccion');
		$this->db->join('users u', 'u.id=direccion.user_id');
		$this->db->order_by('direccion.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_direccion($id)
	{
		$this->db->select('direccion.*, u.first_name, u.last_name');
		$this->db->from('direccions direccion');
		$this->db->join('users u', 'u.id=direccion.user_id');
		$this->db->where('direccion.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertDireccion($direccionData)
	{
		$this->db->insert('direccions', $direccionData);
		return $this->db->insert_id();
	}

	public function updateDireccion($id, $direccionData)
	{
		$this->db->where('id', $id);
		$this->db->update('direccions', $direccionData);
	}

	public function deleteDireccion($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('direccions');
	}
}
