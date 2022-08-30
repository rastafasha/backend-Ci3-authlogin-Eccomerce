<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_venta extends CI_Model 
{
	public function get_ventas($featured, $recentpost)
	{
		$this->db->select('venta.*');
		$this->db->from('ventas venta');
        $this->db->order_by('venta.created_at', 'desc');

		if($recentpost){
			$this->db->order_by('venta.created_at', 'desc');
			$this->db->limit($recentpost);
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function get_venta($id)
	{
		$this->db->select('venta.*');
		$this->db->from('ventas venta');
		$this->db->where('venta.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	

	public function get_admin_ventas()
	{
		$this->db->select('venta.*, u.first_name, u.last_name');
		$this->db->from('ventas venta');
		$this->db->join('users u', 'u.id=venta.user_id');
		$this->db->order_by('venta.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_venta($id)
	{
		$this->db->select('venta.*, u.first_name, u.last_name');
		$this->db->from('ventas venta');
		$this->db->join('users u', 'u.id=venta.user_id');
		$this->db->where('venta.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertVenta($ventaData)
	{
		$this->db->insert('ventas', $ventaData);
		return $this->db->insert_id();
	}

	public function updateVenta($id, $ventaData)
	{
		$this->db->where('id', $id);
		$this->db->update('ventas', $ventaData);
	}

	public function deleteVenta($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('ventas');
	}
}
