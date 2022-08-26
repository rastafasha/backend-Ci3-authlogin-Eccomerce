<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_category extends CI_Model 
{
	public function get_categories($featured, $recentpost)
	{
		$this->db->select('category.*');
		$this->db->from('categories category');

		if($recentpost){
			$this->db->order_by('category.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_category($id)
	{
		$this->db->select('category.*');
		$this->db->from('categories category');
		$this->db->where('category.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_categorys()
	{
		$this->db->select('category.*');
		$this->db->from('categories category');
		$this->db->order_by('category.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_category($id)
	{
		$this->db->select('category.*');
		$this->db->from('categories category');
		$this->db->where('category.id', $id);
		$query = $this->db->get();
		return $query->row();
	}


	public function insertCategory($categoryData)
	{
		$this->db->insert('categories', $categoryData);
		return $this->db->insert_id();
	}

	public function updateCategory($id, $categoryData)
	{
		$this->db->where('id', $id);
		$this->db->update('categories', $categoryData);
	}

	public function deleteCategory($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('categories');
	}
}
