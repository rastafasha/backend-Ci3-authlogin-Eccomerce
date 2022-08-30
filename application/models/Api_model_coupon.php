<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model_coupon extends CI_Model 
{
	public function get_coupons($featured, $recentpost)
	{
		$this->db->select('coupon.*');
		$this->db->from('coupons blog');
		$this->db->where('coupon.is_active', 1);

		if($featured) {
			$this->db->where('coupon.is_featured', 1);
		}
		if($recentpost){
			$this->db->order_by('coupon.created_at', 'desc');
			$this->db->limit($recentpost);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_coupon($id)
	{
		$this->db->select('coupon.*');
		$this->db->from('coupons coupon');
		$this->db->join('categories category', 'category.id=blog.category_id', 'left');
		$this->db->where('coupon.is_active', 1);
		$this->db->where('coupon.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	

	public function get_admin_coupons()
	{
		$this->db->select('coupon.*, u.first_name, u.last_name');
		$this->db->from('coupons coupon');
		$this->db->join('users u', 'u.id=coupon.user_id');
		$this->db->order_by('coupon.created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_admin_coupon($id)
	{
		$this->db->select('coupon.*, u.first_name, u.last_name');
		$this->db->from('coupons coupon');
		$this->db->join('users u', 'u.id=coupon.user_id');
		$this->db->where('coupon.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertCoupon($couponData)
	{
		$this->db->insert('coupons', $couponData);
		return $this->db->insert_id();
	}

	public function updateCoupon($id, $couponData)
	{
		$this->db->where('id', $id);
		$this->db->update('coupons', $couponData);
	}

	public function deleteCoupon($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('coupons');
	}
}
