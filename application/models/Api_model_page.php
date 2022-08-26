<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_page extends CI_Model 
{
	public function get_pages($featured, $recentpost)
	{
		$this->db->select('page.*');
		$this->db->from('pages page');
		$this->db->join('categories cat', 'cat.id=page.category_id', 'left');
		$this->db->where('page.is_active', 1);

		if($featured) {
			$this->db->where('page.is_featured', 1);
		}
		if($recentpost){
			$this->db->order_by('page.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_page($id)
	{
		$this->db->select('page.*, cat.category_name');
		$this->db->from('pages page');
		$this->db->join('users u', 'u.id=page.user_id');
		$this->db->join('categories cat', 'cat.id=page.category_id', 'left');
		$this->db->where('page.is_active', 1);
		$this->db->where('page.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_categories()
	{
		$query = $this->db->get('categories');
		return $query->result();
	}

	

	public function get_admin_pages()
	{
		$this->db->select('page.*, u.first_name, u.last_name');
		$this->db->from('pages page');
		$this->db->join('users u', 'u.id=page.user_id');
		$this->db->order_by('page.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_page($id)
	{
		$this->db->select('page.*, u.first_name, u.last_name');
		$this->db->from('pages page');
		$this->db->join('users u', 'u.id=page.user_id');
		$this->db->where('page.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertPage($pageData)
	{
		$this->db->insert('pages', $pageData);
		return $this->db->insert_id();
	}

	public function updatePage($id, $pageData)
	{
		$this->db->where('id', $id);
		$this->db->update('pages', $pageData);
	}

	public function deletePage($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pages');
	}
}
