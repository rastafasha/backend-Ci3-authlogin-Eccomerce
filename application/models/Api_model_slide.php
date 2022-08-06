<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_slide extends CI_Model 
{
	public function get_sliders($featured, $recentpost)
	{
		$this->db->select('slider.*');
		$this->db->from('sliders slider');
		$this->db->where('slider.is_active', 1);

		if($recentpost){
			$this->db->order_by('slider.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_slider($id)
	{
		$this->db->select('slider.*');
		$this->db->from('sliders slider');
		$this->db->where('slider.is_active', 1);
		$this->db->where('slider.id', $id);
		$query = $this->db->get();
		return $query->row();
	}



	public function get_admin_sliders()
	{
		$this->db->select('slider.*, u.first_name, u.last_name');
		$this->db->from('sliders slider');
		$this->db->join('users u', 'u.id=slider.user_id');
		$this->db->order_by('slider.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_slider($id)
	{
		$this->db->select('slider.*, u.first_name, u.last_name');
		$this->db->from('sliders slider');
		$this->db->join('users u', 'u.id=slider.user_id');
		$this->db->where('slider.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertSlider($sliderData)
	{
		$this->db->insert('sliders', $sliderData);
		return $this->db->insert_id();
	}

	public function updateSlider($id, $sliderData)
	{
		$this->db->where('id', $id);
		$this->db->update('sliders', $sliderData);
	}

	public function deleteSlider($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('sliders');
	}
}
