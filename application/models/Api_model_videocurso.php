<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_videocurso extends CI_Model 
{
	public function get_videocursos($featured, $recentpost)
	{
		$this->db->select('videocurso.*');
		$this->db->from('videocursos videocurso');

		if($featured) {
			$this->db->where('videocurso.is_featured', 1);
		}
		if($recentpost){
			$this->db->order_by('videocurso.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_videocurso($id)
	{
		$this->db->select('videocurso.*');
		$this->db->from('videocursos videocurso');
		$this->db->join('cursos curso', 'curso.id=videocurso.curso_id', 'left');
		$this->db->where('videocurso.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	

	public function get_admin_videocursos()
	{
		$this->db->select('videocurso.*');
		$this->db->from('videocursos videocurso');
		$this->db->join('cursos curso', 'curso.id=videocurso.curso_id', 'left');
		$this->db->order_by('videocurso.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_videocurso($id)
	{
		$this->db->select('videocurso.*');
		$this->db->from('videocursos videocurso');
		$this->db->join('cursos c', 'c.id=videocurso.curso_id');
		$this->db->where('videocurso.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_admin_videosbycursos($curso_id)
	{
		$this->db->select('videocurso.*');
		$this->db->from('videocursos videocurso');
		$this->db->join('cursos c', 'c.id=videocurso.curso_id');
		// $this->db->where('videocurso.id', $id);
		$this->db->where('videocurso.curso_id', $curso_id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertVideocurso($videocursoData)
	{
		$this->db->insert('videocursos', $videocursoData);
		return $this->db->insert_id();
	}

	public function updateVideocurso($id, $videocursoData)
	{
		$this->db->where('id', $id);
		$this->db->update('videocursos', $videocursoData);
	}

	public function deleteVideocurso($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('videocursos');
	}
}
