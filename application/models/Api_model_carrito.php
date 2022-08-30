<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_carrito extends CI_Model 
{
	public function get_carritos($featured, $recentpost)
	{
		$this->db->select('carrito.*');
		$this->db->from('carritos carrito');

		if($recentpost){
			$this->db->order_by('carrito.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_carrito($id)
	{
		$this->db->select('carrito.*');
		$this->db->from('carritos carrito');
        $this->db->join('users u', 'u.id=carrito.user_id');
		$this->db->where('carrito.id', $id);
		$query = $this->db->get();
		return $query->row();
	}


	

	public function get_admin_carritos()
	{
		$this->db->select('carrito.*');
		$this->db->from('carritos carrito');
		$this->db->join('users u', 'u.id=carrito.user_id');
		$this->db->order_by('carrito.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_carrito($id)
	{
		$this->db->select('carrito.*, u.first_name, u.last_name');
		$this->db->from('carritos carrito');
		$this->db->join('users u', 'u.id=carrito.user_id');
		$this->db->where('carrito.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertCarrito($carritoData)
	{
		$this->db->insert('carritos', $carritoData);
		return $this->db->insert_id();
	}

	public function updateCarrito($id, $carritoData)
	{
		$this->db->where('id', $id);
		$this->db->update('carritos', $carritoData);
	}

	public function deleteCarrito($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('carritos');
	}
}
