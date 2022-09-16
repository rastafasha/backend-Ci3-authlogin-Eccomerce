<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_envio extends CI_Model 
{
	public function get_envios($featured, $recentpost)
	{
		$this->db->select('envio.*');
		$this->db->from('envios envio');

		if($recentpost){
			$this->db->order_by('envio.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_envio($id)
	{
		$this->db->select('envio.*');
		$this->db->from('envios envio');
		$this->db->where('envio.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	

	public function get_admin_envios()
	{
		$this->db->select('envio.*');
		$this->db->from('envios envio');
		$this->db->order_by('envio.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_envio($id)
	{
		$this->db->select('envio.*');
		$this->db->from('envios envio');
		$this->db->where('envio.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertEnvio($envioData)
	{
		$this->db->insert('envios', $envioData);
		return $this->db->insert_id();
	}

	public function updateEnvio($id, $envioData)
	{
		$this->db->where('id', $id);
		$this->db->update('envios', $envioData);
	}

	public function deleteEnvio($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('envios');
	}
}
