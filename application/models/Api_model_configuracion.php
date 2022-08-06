<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_configuracion extends CI_Model 
{
	public function get_configuracions($featured, $recentpost)
	{
		$this->db->select('configuracion.*, u.first_name, u.last_name');
		$this->db->from('configuracions configuracion');
		$this->db->join('users u', 'u.id=configuracion.user_id');

		if($recentpost){
			$this->db->order_by('configuracion.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_configuracion($id)
	{
		$this->db->select('configuracion.*, u.first_name, u.last_name');
		$this->db->from('configuracions configuracion');
		$this->db->join('users u', 'u.id=configuracion.user_id');
		$this->db->where('configuracion.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	

	public function get_admin_configuracions()
	{
		$this->db->select('configuracion.*, u.first_name, u.last_name');
		$this->db->from('configuracions configuracion');
		$this->db->join('users u', 'u.id=configuracion.user_id');
		$this->db->order_by('configuracion.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_configuracion($id)
	{
		$this->db->select('configuracion.*, u.first_name, u.last_name');
		$this->db->from('configuracions configuracion');
		$this->db->join('users u', 'u.id=configuracion.user_id');
		$this->db->where('configuracion.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertConfiguracion($configuracionData)
	{
		$this->db->insert('configuracions', $configuracionData);
		return $this->db->insert_id();
	}

	public function updateConfiguracion($id, $configuracionData)
	{
		$this->db->where('id', $id);
		$this->db->update('configuracions', $configuracionData);
	}

	public function deleteConfiguracion($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('configuracions');
	}
}
