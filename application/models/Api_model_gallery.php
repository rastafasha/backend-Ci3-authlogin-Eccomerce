<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_gallery extends CI_Model 
{
	public function get_galerias($featured, $recentpost)
	{
		$this->db->select('galeria.*');
		$this->db->from('galerias galeria');

		if($recentpost){
			$this->db->order_by('galeria.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_galeria($id)
	{
		$this->db->select('galeria.*');
		$this->db->from('galerias galeria');
		$this->db->where('galeria.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_galerias()
	{
		$this->db->select('galeria.*, u.first_name, u.last_name');
		$this->db->from('galerias galeria');
		$this->db->join('users u', 'u.id=galeria.user_id');
		$this->db->order_by('galeria.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_galeria($id)
	{
		$this->db->select('galeria.*, u.first_name, u.last_name');
		$this->db->from('galerias galeria');
		$this->db->join('users u', 'u.id=galeria.user_id');
		$this->db->where('galeria.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertGallery($galeriaData)
	{
		$this->db->insert('galerias', $galeriaData);
		return $this->db->insert_id();
	}

	public function updateGallery($id, $galeriaData)
	{
		$this->db->where('id', $id);
		$this->db->update('galerias', $galeriaData);
	}

	public function deleteGallery($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('galerias');
	}
}
