<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_curso extends CI_Model 
{
	public function get_cursos()
	{
		$this->db->select('curso.*');
		$this->db->from('cursos curso');
		$this->db->order_by('curso.created_at', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_cursosr($featured, $recentpost)
	{
		$this->db->select('curso.*');
		$this->db->from('cursos curso');
		$this->db->join('categories cat', 'cat.id=curso.category_id', 'left');
		$this->db->where('curso.is_active', 1);

		if($featured) {
			$this->db->where('curso.is_featured', 1);
		}
		if($recentpost){
			$this->db->order_by('curso.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_curso($cod_prod)
	{
		$this->db->select('curso.*, u.first_name, u.last_name');
		$this->db->from('cursos curso');
		$this->db->join('users u', 'u.id=curso.user_id');
		$this->db->join('categories cat', 'cat.id=curso.category_id', 'left');
		$this->db->where('curso.cod_prod', $cod_prod);
		$query = $this->db->get();
		return $query->row();
	}

	public function getCursoCategory($category_id){
		$this->db->select('curso.*');
		$this->db->from('cursos curso');
		$this->db->join('categories cat' ,  'cat.id=curso.category_id');
		$this->db->where('curso.category_id', $category_id);
		
		$query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result();
        }
	}



	public function get_admin_cursos()
	{
		$this->db->select('curso.*');
		$this->db->from('cursos curso');
		$this->db->order_by('curso.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_curso($id)
	{
		$this->db->select('curso.*, u.first_name, u.last_name');
		$this->db->from('cursos curso');
		$this->db->join('users u', 'u.id=curso.user_id');
		$this->db->where('curso.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function insertCurso($cursoData)
	{
		$this->db->insert('cursos', $cursoData);
		return $this->db->insert_id();
	}

	public function updateCurso($id, $cursoData)
	{
		$this->db->where('id', $id);
		$this->db->update('cursos', $cursoData);
	}

	public function deleteCurso($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cursos');
	}
}
