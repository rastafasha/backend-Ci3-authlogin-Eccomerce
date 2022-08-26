<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_promocion extends CI_Model 
{
	public function get_promocions($featured, $recentpost)
	{
		$this->db->select('promocion.*');
		$this->db->from('promocions promocion');
		$this->db->where('promocion.is_active', 1);

		if($recentpost){
			$this->db->order_by('promocion.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_promocion($id)
	{
		$this->db->select('promocion.*');
		$this->db->from('promocions promocion');
		$this->db->where('promocion.is_active', 1);
		$this->db->where('promocion.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_promocions()
	{
		$this->db->select('promocion.*');
		$this->db->from('promocions promocion');
		$this->db->join('users u', 'u.id=promocion.user_id');
		$this->db->order_by('promocion.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_promocion($id)
	{
		$this->db->select('promocion.*');
		$this->db->from('promocions promocion');
		$this->db->join('users u', 'u.id=promocion.user_id');
		$this->db->where('promocion.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertPromocion($promocionData)
	{
		$this->db->insert('promocions', $promocionData);
		return $this->db->insert_id();
	}

	public function updatePromocion($id, $promocionData)
	{
		$this->db->where('id', $id);
		$this->db->update('promocions', $promocionData);
	}

	public function deletePromocion($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('promocion');
	}
}
