<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_galleryproduct extends CI_Model 
{
	public function get_galeryproducts($featured, $recentpost)
	{
		$this->db->select('galeryproduct.*');
		$this->db->from('galeryproducts galeryproduct');
		$this->db->join('productos p', 'p.id=galeryproduct.producto_id', 'left');

		if($recentpost){
			$this->db->order_by('galeryproduct.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_galeryproduct($id)
	{
		$this->db->select('galeryproduct.*, p.name');
		$this->db->from('galeryproducts galeryproduct');
		$this->db->join('productos p', 'p.id=galeryproduct.producto_id', 'left');
		$this->db->where('galeryproduct.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_galeryproducts()
	{
		$this->db->select('galeryproduct.*, u.first_name, u.last_name');
		$this->db->from('galeryproducts galeryproduct');
		$this->db->join('users u', 'u.id=galeryproduct.user_id');
		$this->db->order_by('galeryproduct.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_galeryproduct($id)
	{
		$this->db->select('galeryproduct.*, u.first_name, u.last_name');
		$this->db->from('galeryproducts galeryproduct');
		$this->db->join('users u', 'u.id=galeryproduct.user_id');
		$this->db->where('galeryproduct.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertGalleryProduct($galeryproductData)
	{
		$this->db->insert('galeryproducts', $galeryproductData);
		return $this->db->insert_id();
	}

	public function updateGalleryProduct($id, $galeryproductData)
	{
		$this->db->where('id', $id);
		$this->db->update('galeryproducts', $galeryproductData);
	}

	public function deleteGalleryProduct($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('galeryproducts');
	}
}
