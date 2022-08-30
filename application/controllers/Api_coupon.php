<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Coupon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_coupon');
		$this->load->helper('url');
		$this->load->helper('text');
		
		$this->load->model('AuthModel');
		$this->load->helper('verifyAuthToken');
		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	}

	public function coupons()
	{

		$coupons = $this->api_model_coupon->get_coupons($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($coupons)){
			foreach($coupons as $coupon){


				$posts[] = array(
					'id' => $coupon->id,
					'user_id' => $coupon->user_id,
					'category_id' => $coupon->category_id,
					'tipo' => $coupon->tipo,
					'descuento' => $coupon->descuento,
					'codigo' => $coupon->codigo,
					'created_at' => $coupon->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_coupons()
	{

		$coupons = $this->api_model_coupon->get_coupons($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($coupons)){
			foreach($coupons as $coupon){
				
				$posts[] = array(
					'id' => $coupon->id,
					'user_id' => $coupon->user_id,
					'category_id' => $coupon->category_id,
					'tipo' => $coupon->tipo,
					'descuento' => $coupon->descuento,
					'codigo' => $coupon->codigo,
					'created_at' => $coupon->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function coupon($id)
	{
		
		$coupon = $this->api_model_coupon->get_coupon($id);

		$post = array(
			'id' => $coupon->id,
					'user_id' => $coupon->user_id,
					'category_id' => $coupon->category_id,
					'tipo' => $coupon->tipo,
					'descuento' => $coupon->descuento,
					'codigo' => $coupon->codigo,
					'created_at' => $coupon->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}



	public function recent_coupons()
	{

		$coupons = $this->api_model_coupon->get_coupons($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($coupons)){
			foreach($coupons as $coupon){
				
				
				$posts[] = array(
					'id' => $coupon->id,
					'user_id' => $coupon->user_id,
					'category_id' => $coupon->category_id,
					'tipo' => $coupon->tipo,
					'descuento' => $coupon->descuento,
					'codigo' => $coupon->codigo,
					'created_at' => $coupon->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminCoupons()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$coupons = $this->api_model_coupon->get_admin_coupons();
			foreach($coupons as $coupon) {
				$posts[] = array(
					'id' => $coupon->id,
					'user_id' => $coupon->user_id,
					'category_id' => $coupon->category_id,
					'tipo' => $coupon->tipo,
					'descuento' => $coupon->descuento,
					'codigo' => $coupon->codigo,
					'created_at' => $coupon->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminCoupon($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$coupon = $this->api_model_coupon->get_admin_coupon($id);

			$post = array(
				'id' => $coupon->id,
					'user_id' => $coupon->user_id,
					'category_id' => $coupon->category_id,
					'tipo' => $coupon->tipo,
					'descuento' => $coupon->descuento,
					'codigo' => $coupon->codigo,
					'created_at' => $coupon->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createCoupon()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

            $user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');
			$tipo = $this->input->post('tipo');
			$descuento = $this->input->post('descuento');
			$codigo = $this->input->post('codigo');

			$filename = NULL;

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$couponData = array(
					'user_id' => $user_id,
					'category_id' => $category_id,
					'tipo' => $tipo,
					'descuento' => $descuento,
					'codigo' => $codigo,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_coupon->insertCoupon($couponData);

				$response = array(
					'status' => 'success'
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}

	public function updateCoupon($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$coupon = $this->api_model_coupon->get_admin_coupon($id);

			$user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');
			$tipo = $this->input->post('tipo');
			$descuento = $this->input->post('descuento');
			$codigo = $this->input->post('codigo');

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$couponData = array(
					'title' => $title,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active
				);

				$this->api_model_coupon->updateCoupon($id, $couponData);

				$response = array(
					'status' => 'success'
				);
           	}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}

	public function deleteCoupon($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$coupon = $this->api_model_coupon->get_admin_coupon($id);

			$this->api_model_coupon->deleteCoupon($id);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}
}
