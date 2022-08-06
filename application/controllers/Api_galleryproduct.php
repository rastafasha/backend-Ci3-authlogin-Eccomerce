<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Galleryproduct extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_galleryproduct');
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

	public function galleryproducts()
	{
		

		$galleryproducts = $this->api_model_galleryproduct->get_galleryproducts($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($galleryproduct)){
			foreach($galleryproducts as $galleryproduct){

				$posts[] = array(
					'id' => $galleryproduct->id,
					'product_id' => $galleryproduct->product_id,
					'img' => base_url('media/images/uploads/galleryproducts/'.$galleryproduct->img),
					'created_at' => $galleryproduct->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function galleryproduct($id)
	{
		
		
		$galleryproduct = $this->api_model_galleryproduct->get_galleryproduct($id);

		$post = array(
			'id' => $galleryproduct->id,
					'product_id' => $galleryproduct->product_id,
					'img' => base_url('media/images/uploads/galleryproducts/'.$galleryproduct->img),
					'created_at' => $galleryproduct->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_galleryproducts()
	{
		

		$galleryproduct = $this->api_model_galleryproduct->get_galleryproducts($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($galleryproducts)){
			foreach($galleryproducts as $galleryproduct){
				

				$posts[] = array(
					'id' => $galleryproduct->id,
					'product_id' => $galleryproduct->product_id,
					'img' => base_url('media/images/uploads/galleryproducts/'.$galleryproduct->img),
					'created_at' => $galleryproduct->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminGalleryproducts()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$galleryproducts = $this->api_model_galleryproduct->get_admin_galleryproducts();
			foreach($galleryproducts as $galleryproduct) {
				$posts[] = array(
					'id' => $galleryproduct->id,
					'product_id' => $galleryproduct->product_id,
					'img' => base_url('media/images/uploads/galleryproducts/'.$galleryproduct->img),
					'created_at' => $galleryproduct->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminGalleryproduct($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$galleryproduct = $this->api_model_galleryproduct->get_admin_galleryproduct($id);

			$post = array(
				'id' => $galleryproduct->id,
					'product_id' => $galleryproduct->product_id,
					'img' => base_url('media/images/uploads/galleryproducts/'.$galleryproduct->img),
					'created_at' => $galleryproduct->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createGalleryproduct()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$product_id = $this->input->post('product_id');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/galleryproducts/';
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
	        	$galleryproductData = array(
					'product_id' => $product_id,
					'user_id' => $user_id,
					'img' => $filename,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_galleryproduct->insertGalleryProduct($galleryproductData);

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

	public function updateGalleryproduct($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$galleryproduct = $this->api_model_galleryproduct->get_admin_galleryproduct($id);
			$filename = $galleryproduct->img;

			$product_id = $this->input->post('product_id');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/galleryproducts/';
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
	   
					if($galleryproduct->img && file_exists(FCPATH.'media/uploads/galleryproducts/'.$galleryproduct->img))
					{
						unlink(FCPATH.'media/uploads/galleryproducts/'.$galleryproduct->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$galleryproductData = array(
					'product_id' => $product_id,
					'user_id' => $user_id,
					'img' => $filename,
				);

				$this->api_model_galleryproduct->updateGalleryProduct($id, $galleryproductData);

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

	public function deleteGalleryproduct($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$galleryproduct = $this->api_model_producto->get_admin_producto($id);

			if($galleryproduct->img && file_exists(FCPATH.'media/uploads/galleryproducts/'.$galleryproduct->img))
			{
				unlink(FCPATH.'media/uploads/galleryproducts/'.$galleryproduct->img);
			}

			$this->api_model_galleryproduct->deleteGalleryProducto($id);

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
