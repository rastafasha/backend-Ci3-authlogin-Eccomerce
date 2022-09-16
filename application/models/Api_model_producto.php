<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_producto extends CI_Model 
{
	public function get_productos()
	{
		$this->db->select('producto.*');
		$this->db->from('productos producto');
		$this->db->order_by('producto.created_at', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_productosr($featured, $recentpost)
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

	public function get_producto($cod_prod)
	{
		$this->db->select('producto.*, u.first_name, u.last_name');
		$this->db->from('productos producto');
		$this->db->join('users u', 'u.id=producto.user_id');
		$this->db->join('categories cat', 'cat.id=producto.category_id', 'left');
		$this->db->where('producto.cod_prod', $cod_prod);
		$query = $this->db->get();
		return $query->row();
	}

	public function getProductoCategory($category_id){
		$this->db->select('producto.*');
		$this->db->from('productos producto');
		$this->db->join('categories cat' ,  'cat.id=producto.category_id');
		$this->db->where('producto.category_id', $category_id);
		
		$query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result();
        }
	}



	public function get_admin_productos()
	{
		$this->db->select('producto.*');
		$this->db->from('productos producto');
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
