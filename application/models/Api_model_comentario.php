<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_comentario extends CI_Model 
{
	public function get_comentarios($featured, $recentpost)
	{
		$this->db->select('comentario.*');
		$this->db->from('comentarios comentario');
		$this->db->where('comentario.is_active', 1);

		if($featured) {
			$this->db->where('comentario.is_featured', 1);
		}
		if($recentpost){
			$this->db->order_by('comentario.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_comentario($id)
	{
		$this->db->select('comentario.*');
		$this->db->from('comentarios comentario');
		$this->db->join('cursos curso', 'curso.id=comentario.curso_id', 'left');
		$this->db->join('productos producto', 'producto.id=comentario.producto_id', 'left');
		$this->db->join('users user', 'user.id=comentario.user_id', 'left');
		$this->db->where('comentario.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	

	public function get_admin_comentarios()
	{
		$this->db->select('comentario.*, u.first_name, u.last_name');
		$this->db->from('comentarios comentario');
		$this->db->join('cursos curso', 'curso.id=comentario.curso_id', 'left');
		$this->db->join('productos producto', 'producto.id=comentario.producto_id', 'left');
		$this->db->join('users user', 'user.id=comentario.user_id', 'left');
		$this->db->order_by('comentario.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_comentario($id)
	{
		$this->db->select('comentario.*, u.first_name, u.last_name');
		$this->db->from('comentarios comentario');
		$this->db->join('users u', 'u.id=comentario.user_id');
		$this->db->where('comentario.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertComentario($comentarioData)
	{
		$this->db->insert('comentarios', $comentarioData);
		return $this->db->insert_id();
	}

	public function updateComentario($id, $comentarioData)
	{
		$this->db->where('id', $id);
		$this->db->update('comentarios', $comentarioData);
	}

	public function deleteComentario($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('comentarios');
	}
}
