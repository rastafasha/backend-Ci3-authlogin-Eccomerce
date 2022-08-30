<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Carrito extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_carrito');
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

	public function carritos()
	{

		$carritos = $this->api_model_carrito->get_carritos($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($carritos)){
			foreach($carritos as $carrito){

				$posts[] = array(
					'id' => $carrito->id,
            'user_id' => $carrito->user_id,
            'productPrice' => $carrito->productPrice,
            'category' => $carrito->category,
            'productCode' => $carrito->productCode,
            'productId' => $carrito->productId,
            'productName' => $carrito->productName,
            'quantity' => $carrito->quantity,
            'description' => $carrito->description,
            'created_at' => $carrito->created_at,
            'updated_at' => $carrito->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	

	public function carrito($id)
	{
		
		$carrito = $this->api_model_carrito->get_carrito($id);

		$post = array(
			'id' => $carrito->id,
            'user_id' => $carrito->user_id,
            'productPrice' => $carrito->productPrice,
            'category' => $carrito->category,
            'productCode' => $carrito->productCode,
            'productId' => $carrito->productId,
            'productName' => $carrito->productName,
            'quantity' => $carrito->quantity,
            'description' => $carrito->description,
            'created_at' => $carrito->created_at,
            'updated_at' => $carrito->updated_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}



	public function recent_carritos()
	{

		$carritos = $this->api_model_carrito->get_carritos($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($carritos)){
			foreach($carritos as $carrito){
				
				
				$posts[] = array(
					'id' => $carrito->id,
            'user_id' => $carrito->user_id,
            'productPrice' => $carrito->productPrice,
            'category' => $carrito->category,
            'productCode' => $carrito->productCode,
            'productId' => $carrito->productId,
            'productName' => $carrito->productName,
            'quantity' => $carrito->quantity,
            'description' => $carrito->description,
            'created_at' => $carrito->created_at,
            'updated_at' => $carrito->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminCarritos()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$carritos = $this->api_model_carrito->get_admin_carritos();
			foreach($carritos as $carrito) {
				$posts[] = array(
					'id' => $carrito->id,
            'user_id' => $carrito->user_id,
            'productPrice' => $carrito->productPrice,
            'category' => $carrito->category,
            'productCode' => $carrito->productCode,
            'productId' => $carrito->productId,
            'productName' => $carrito->productName,
            'quantity' => $carrito->quantity,
            'description' => $carrito->description,
            'created_at' => $carrito->created_at,
            'updated_at' => $carrito->updated_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminCarrito($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$carrito = $this->api_model_carrito->get_admin_carrito($id);

			$post = array(
				'id' => $carrito->id,
            'user_id' => $carrito->user_id,
            'productPrice' => $carrito->productPrice,
            'category' => $carrito->category,
            'productCode' => $carrito->productCode,
            'productId' => $carrito->productId,
            'productName' => $carrito->productName,
            'quantity' => $carrito->quantity,
            'description' => $carrito->description,
            'created_at' => $carrito->created_at,
            'updated_at' => $carrito->updated_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createCarrito()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$category = $this->input->post('category');
			$user_id = $this->input->post('user_id');
			$productPrice = $this->input->post('productPrice');
			$productId = $this->input->post('productId');
			$productName = $this->input->post('productName');
			$productCode = $this->input->post('productCode');
			$quantity = $this->input->post('quantity');
			$description = $this->input->post('description');




			if( $token) {
	        	$carritoData = array(
					'category' => $category,
					'user_id' => $user_id,
					'productPrice' => $categproductPriceory_id,
					'productCode' => $productCode,
					'productId' => $productId,
					'quantity' => $quantity,
					'description' => $description,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_carrito->insertCarrito($carritoData);

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

	public function updateCarrito($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$carrito = $this->api_model_carrito->get_admin_carrito($id);

			$category = $this->input->post('category');
			$user_id = $this->input->post('user_id');
			$productPrice = $this->input->post('productPrice');
			$productId = $this->input->post('productId');
			$productName = $this->input->post('productName');
			$productCode = $this->input->post('productCode');
			$quantity = $this->input->post('quantity');
			$description = $this->input->post('description');



			if( $token) {
	        	$carritoData = array(
					'category' => $category,
					'user_id' => $user_id,
					'productPrice' => $categproductPriceory_id,
					'productCode' => $productCode,
					'productId' => $productId,
					'quantity' => $quantity,
					'description' => $description,
					'created_at' => date('Y-m-d H:i:s', time()),
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_carrito->updateCarrito($id, $carritoData);

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

	public function deleteCarrito($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$blog = $this->api_model_blog->get_admin_blog($id);

			if($blog->img && file_exists(FCPATH.'media/uploads/blogs/'.$blog->img))
			{
				unlink(FCPATH.'media/uploads/blogs/'.$blog->img);
			}

			$this->api_model_blog->deleteBlog($id);

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
