<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Producto extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api_model_producto');
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

	public function productos()
	{
		

		$productos = $this->api_model_producto->get_productos($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($productos)){
			foreach($productos as $producto){

				$posts[] = array(
					'id' => $producto->id,
					'name' => $producto->name,
					'price' => $producto->price,
					'cod_prod' => $producto->cod_prod,
					'description' => $producto->description,
					'video_review' => $producto->video_review,
					'info_short' => $producto->info_short,
					'category_id' => $producto->category_id,
                    'is_featured' => $producto->is_featured,
                    'is_active' => $producto->is_active,
					'imgUrl' => $producto->imgUrl,
					'img' => base_url('media/uploads/productos/'.$producto->img),
					'created_at' => $producto->created_at,
					'updated_at' => $producto->created_at

				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_productos()
	{
		

		$productos = $this->api_model_producto->get_productos($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($productos)){
			foreach($productos as $producto){
				

				$posts[] = array(
					'id' => $producto->id,
					'name' => $producto->name,
					'price' => $producto->price,
					'cod_prod' => $producto->cod_prod,
					'description' => $producto->description,
					'video_review' => $producto->video_review,
					'info_short' => $producto->info_short,
					'category_id' => $producto->category_id,
                    'is_featured' => $producto->is_featured,
                    'is_active' => $producto->is_active,
					'imgUrl' => $producto->imgUrl,
					'img' => base_url('media/uploads/productos/'.$producto->img),
					'created_at' => $producto->created_at,
					'updated_at' => $producto->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function producto($cod_prod)
	{
		$producto = $this->api_model_producto->get_producto($cod_prod);

			$post = array(
				'id' => $producto->id,
					'name' => $producto->name,
					'price' => $producto->price,
					'cod_prod' => $producto->cod_prod,
					'description' => $producto->description,
					'video_review' => $producto->video_review,
					'info_short' => $producto->info_short,
					'category_id' => $producto->category_id,
                    'is_featured' => $producto->is_featured,
                    'is_active' => $producto->is_active,
					'imgUrl' => $producto->imgUrl,
					'img' => base_url('media/uploads/productos/'.$producto->img),
					'created_at' => $producto->created_at,
					'updated_at' => $producto->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
	}

	public function recent_productos()
	{
		

		$productos = $this->api_model_producto->get_productos($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($productos)){
			foreach($productos as $producto){
				

				$posts[] = array(
					'id' => $producto->id,
					'name' => $producto->name,
					'price' => $producto->price,
					'cod_prod' => $producto->cod_prod,
					'description' => $producto->description,
					'video_review' => $producto->video_review,
					'info_short' => $producto->info_short,
					'category_id' => $producto->category_id,
                    'is_featured' => $producto->is_featured,
                    'is_active' => $producto->is_active,
					'imgUrl' => $producto->imgUrl,
					'img' => base_url('media/uploads/productos/'.$producto->img),
					'created_at' => $producto->created_at,
					'updated_at' => $producto->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminProductos()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$productos = $this->api_model_producto->get_admin_productos();
			foreach($productos as $producto) {
				$posts[] = array(
					'id' => $producto->id,
					'name' => $producto->name,
					'price' => $producto->price,
					'cod_prod' => $producto->cod_prod,
					'description' => $producto->description,
					'video_review' => $producto->video_review,
					'info_short' => $producto->info_short,
					'category_id' => $producto->category_id,
                    'is_featured' => $producto->is_featured,
                    'is_active' => $producto->is_active,
					'imgUrl' => $producto->imgUrl,
					'img' => base_url('media/uploads/productos/'.$producto->img),
					'created_at' => $producto->created_at,
					'updated_at' => $producto->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminProducto($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {
			$producto = $this->api_model_producto->get_admin_producto($id);
			$posts = array(
				'id' => $producto->id,
					'name' => $producto->name,
					'price' => $producto->price,
					'cod_prod' => $producto->cod_prod,
					'description' => $producto->description,
					'video_review' => $producto->video_review,
					'info_short' => $producto->info_short,
					'category_id' => $producto->category_id,
                    'is_featured' => $producto->is_featured,
                    'is_active' => $producto->is_active,
					'imgUrl' => $producto->imgUrl,
					'img' => base_url('media/uploads/productos/'.$producto->img),
					'created_at' => $producto->created_at,
					'updated_at' => $producto->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function createProducto()
	{
		// <!-- $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) { -->

			$name = $this->input->post('name');
			$user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');
			$price = $this->input->post('price');
			$cod_prod = $this->input->post('cod_prod');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$info_short = $this->input->post('info_short');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');
			$imgUrl = $this->input->post('imgUrl');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/productos/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('img')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$productoData = array(
					'name' => $name,
					'price' => $price,
					'cod_prod' => $cod_prod,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'info_short' => $info_short,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active,
					'imgUrl' => $imgUrl,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_producto->insertProducto($productoData);

				$response = array(
					'status' => 'success'
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		// }
	}

	public function updateProducto($id) 
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		
		// if($token) {

			$producto = $this->api_model_producto->get_admin_producto($id);
			$filename = $producto->img;

			$name = $this->input->post('name');
			$user_id = $this->input->post('user_id');
			$price = $this->input->post('price');
			$cod_prod = $this->input->post('cod_prod');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$info_short = $this->input->post('info_short');
			$category_id = $this->input->post('category_id');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');
			$imgUrl = $this->input->post('imgUrl');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/productos/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('img')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	   
					if($producto->img && file_exists(FCPATH.'media/uploads/productos/'.$producto->img))
					{
						unlink(FCPATH.'media/uploads/productos/'.$producto->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$productoData = array(
					'name' => $name,
					'price' => $price,
					'cod_prod' => $cod_prod,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'info_short' => $info_short,
					'img' => $filename,
					'is_featured' => $is_featured,
					'imgUrl' => $imgUrl,
					'is_active' => $is_active,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_producto->updateProducto($id, $productoData);

				$response = array(
					'status' => 'success'
				);
           	}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		// }
	}

	public function deleteProducto($id)
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) {

			$producto = $this->api_model_producto->get_admin_producto($id);

			if($producto->img && file_exists(FCPATH.'media/uploads/productos/'.$producto->img))
			{
				unlink(FCPATH.'media/uploads/productos/'.$producto->img);
			}

			$this->api_model_producto->deleteProducto($id);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		// }
	}

	public function productobyCategory($category_id)
	{
		
		$productos = $this->api_model_producto->getProductoCategory($category_id);


		foreach($productos as $producto){
				
			$posts[] = array(
				'id' => $producto->id,
					'name' => $producto->name,
					'price' => $producto->price,
					'cod_prod' => $producto->cod_prod,
					'description' => $producto->description,
					'video_review' => $producto->video_review,
					'info_short' => $producto->info_short,
					'category_id' => $producto->category_id,
                    'is_featured' => $producto->is_featured,
                    'is_active' => $producto->is_active,
					'imgUrl' => $producto->imgUrl,
					'img' => base_url('media/uploads/productos/'.$producto->img),
					'created_at' => $producto->created_at,
					'updated_at' => $producto->updated_at,
			);
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}
}