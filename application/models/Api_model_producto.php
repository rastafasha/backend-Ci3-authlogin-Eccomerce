<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_producto extends CI_Model 
{
	public function get_productos($featured, $recentpost)
	{
		$this->db->select('producto.*');
		$this->db->from('productos producto');
		$this->db->join('categories cat', 'cat.id=producto.category_id', 'left');
		$this->db->where('producto.is_active', 1);

		if($featured) {
			$this->db->where('producto.is_featured', 1);
		}
		if($recentpost){
			$this->db->order_by('producto.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_producto($id)
	{
		$this->db->select('producto.*, cat.category_name');
		$this->db->from('productos producto');
		$this->db->join('categories cat', 'cat.id=producto.category_id', 'left');
		$this->db->where('producto.is_active', 1);
		$this->db->where('producto.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_productos()
	{
		$this->db->select('producto.*, u.first_name, u.last_name');
		$this->db->from('productos producto');
		$this->db->join('users u', 'u.id=producto.user_id');
		$this->db->order_by('producto.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_producto($id)
	{
		$this->db->select('producto.*, u.first_name, u.last_name');
		$this->db->from('productos producto');
		$this->db->join('users u', 'u.id=producto.user_id');
		$this->db->where('producto.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertProducto($productoData)
	{
		$this->db->insert('productos', $productoData);
		return $this->db->insert_id();
	}

	public function updateProducto($id, $productoData)
	{
		$this->db->where('id', $id);
		$this->db->update('productos', $productoData);
	}

	public function deleteProducto($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('productos');
	}
}
