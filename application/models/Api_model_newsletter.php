<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_newsletter extends CI_Model 
{
	public function get_newsletters($featured, $recentpost)
	{
		$this->db->select('newsletter.*');
		$this->db->from('newsletters newsletter');

		if($recentpost){
			$this->db->order_by('newsletter.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_newsletter($id)
	{
		$this->db->select('newsletter.*');
		$this->db->from('newsletters newsletter');
		$this->db->where('newsletter.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	

	public function get_admin_newsletters()
	{
		$this->db->select('newsletter.*');
		$this->db->from('newsletters newsletter');
		$this->db->order_by('newsletter.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_newsletter($id)
	{
		$this->db->select('newsletter.*');
		$this->db->from('newsletters newsletter');
		$this->db->where('newsletter.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertNewsletter($newsletterData)
	{
		$this->db->insert('newsletters', $newsletterData);
		return $this->db->insert_id();
	}


	public function updateNewsletter($id, $newsletterData)
	{
		$this->db->where('id', $id);
		$this->db->update('newsletters', $newsletterData);
	}

	public function deleteNewsletter($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('newsletters');
	}
}
