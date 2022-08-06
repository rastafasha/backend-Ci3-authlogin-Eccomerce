<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_contact extends CI_Model 
{
	
	public function get_admin_contacts()
	{
		$this->db->select('contact.*');
		$this->db->from('contacts contact');
		$this->db->join('users u', 'u.id=contact.user_id');
		$this->db->order_by('contact.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_contact($id)
	{
		$this->db->select('contact.*');
		$this->db->from('contacts contact');
		$this->db->where('contact.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insert_contact($contactData)
	{
		$this->db->insert('contacts', $contactData);
		return $this->db->insert_id();
	}

	
}
