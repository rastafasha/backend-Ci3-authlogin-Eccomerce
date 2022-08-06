<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_marca extends CI_Model 
{
	public function get_marcas($featured, $recentpost)
	{
		$this->db->select('marca.*');
		$this->db->from('marcas marca');
		$this->db->join('productos p', 'p.id=category.producto_id');
		$this->db->join('categories cat', 'cat.id=cat.category_id', 'left');
		// $this->db->where('marca.is_active', 1);

		if($recentpost){
			$this->db->order_by('marca.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_marca($id)
	{
		$this->db->select('marca.*');
		$this->db->from('marcas marca');
		$this->db->join('productos p', 'p.id=cat.marca_id', 'left');
		// $this->db->where('marca.is_active', 1);
		$this->db->where('marca.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_marcas()
	{
		$this->db->select('marca.*, u.first_name, u.last_name');
		$this->db->from('marcas marca');
		$this->db->join('users u', 'u.id=marca.user_id');
		$this->db->order_by('marca.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_marca($id)
	{
		$this->db->select('marca.*, u.first_name, u.last_name');
		$this->db->from('marcas marca');
		$this->db->join('users u', 'u.id=marca.user_id');
		$this->db->where('marca.id', $id);
		$query = $this->db->get();
		return $query->row();
	}


	public function insertMarca($marcaData)
	{
		$this->db->insert('marcas', $marcaData);
		return $this->db->insert_id();
	}

	public function updateMarca($id, $marcaData)
	{
		$this->db->where('id', $id);
		$this->db->update('marcas', $marcaData);
	}

	public function deleteMarca($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('marcas');
	}
}
