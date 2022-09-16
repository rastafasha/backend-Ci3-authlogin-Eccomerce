<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Gallery extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_gallery');
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

	public function gallerys()
	{

		$gallerys = $this->api_model_gallery->get_gallerys($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($gallerys)){
			foreach($gallerys as $gallery){

				$posts[] = array(
					'id' => $gallery->id,
					'user_id' => $gallery->user_id,
					'category_id' => $gallery->category_id,
					'titulo' => $gallery->titulo,
					'imgUrl' => $gallery->imgUrl,
					'img' => base_url('media/uploads/gallerys/'.$gallery->img),
					'created_at' => $gallery->created_at,
					'updated_at' => $gallery->updated_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_gallerys()
	{

		$gallerys = $this->api_model_gallery->get_gallerys($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($gallerys)){
			foreach($gallerys as $gallery){
				
				$posts[] = array(
					'id' => $gallery->id,
					'user_id' => $gallery->user_id,
					'category_id' => $gallery->category_id,
					'titulo' => $gallery->titulo,
					'imgUrl' => $gallery->imgUrl,
					'img' => base_url('media/uploads/gallerys/'.$gallery->img),
					'created_at' => $gallery->created_at,
					'updated_at' => $gallery->updated_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function gallery($id)
	{
		
		$gallery = $this->api_model_gallery->get_gallery($id);

		// $short_desc = strip_tags(character_limiter($blog->description, 70));
		// $author = $blog->first_name.' '.$blog->last_name;

		$post = array(
			'id' => $gallery->id,
					'user_id' => $gallery->user_id,
					'category_id' => $gallery->category_id,
					'titulo' => $gallery->titulo,
					'imgUrl' => $gallery->imgUrl,
					'img' => base_url('media/uploads/gallerys/'.$gallery->img),
					'created_at' => $gallery->created_at,
					'updated_at' => $gallery->updated_at,
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	public function gallerybyCategory($id)
	{
		
		$gallery = $this->api_model_gallery->getGalleryCategory($id);


		$post = array(
			'id' => $gallery->id,
			'user_id' => $gallery->user_id,
			'category_id' => $gallery->category_id,
			'titulo' => $gallery->titulo,
			'imgUrl' => $gallery->imgUrl,
			'img' => base_url('media/uploads/gallerys/'.$gallery->img),
			'created_at' => $gallery->created_at,
			'updated_at' => $gallery->updated_at,
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_gallerys()
	{

		$gallerys = $this->api_model_gallery->get_gallerys($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($gallerys)){
			foreach($gallerys as $gallery){
				
				
				$posts[] = array(
					'id' => $gallery->id,
					'user_id' => $gallery->user_id,
					'category_id' => $gallery->category_id,
					'titulo' => $gallery->titulo,
					'imgUrl' => $gallery->imgUrl,
					'img' => base_url('media/uploads/gallerys/'.$gallery->img),
					'created_at' => $gallery->created_at,
					'updated_at' => $gallery->updated_at,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminGallerys()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$gallerys = $this->api_model_gallery->get_admin_gallerys();
			foreach($gallerys as $gallery) {
				$posts[] = array(
					'id' => $gallery->id,
					'user_id' => $gallery->user_id,
					'category_id' => $gallery->category_id,
					'titulo' => $gallery->titulo,
					'imgUrl' => $gallery->imgUrl,
					'img' => base_url('media/uploads/gallerys/'.$gallery->img),
					'created_at' => $gallery->created_at,
					'updated_at' => $gallery->updated_at,
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminGallery($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$gallery = $this->api_model_gallery->get_admin_gallery($id);

			$post = array(
				'id' => $gallery->id,
					'user_id' => $gallery->user_id,
					'category_id' => $gallery->category_id,
					'titulo' => $gallery->titulo,
					'imgUrl' => $gallery->imgUrl,
					'img' => base_url('media/uploads/gallerys/'.$gallery->img),
					'created_at' => $gallery->created_at,
					'updated_at' => $gallery->updated_at,
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createGallery()
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) {

			$titulo = $this->input->post('titulo');
			$user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/gallerys/';
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
	        	$galleryData = array(
					'titulo' => $titulo,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'img' => $filename,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_gallery->insertGallery($galleryData);

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

	public function updateGallery($id)
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];
		
		// if($token) {

			$gallery = $this->api_model_gallery->get_admin_gallery($id);

			$titulo = $this->input->post('titulo');
			$user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');
			$imgUrl = $this->input->post('imgUrl');

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$galleryData = array(
					'titulo' => $titulo,
					'user_id' => $user_id,
					'imgUrl' => $imgUrl,
					'category_id' => $category_id,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_gallery->updateGallery($id, $galleryData);

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



	public function updateGalleryPhoto($id)
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];
		
		// if($token) {

			$gallery = $this->api_model_gallery->get_admin_gallery($id);
			$titulo = $this->input->post('titulo');
			$user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');
			$imgUrl = $this->input->post('imgUrl');
			
			$filename = $gallery->img;


			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/gallerys/';
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
	   
					if($gallery->img && file_exists(FCPATH.'media/uploads/gallerys/'.$gallery->img))
					{
						unlink(FCPATH.'media/uploads/gallerys/'.$gallery->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$galleryData = array(
					'titulo' => $titulo,
					'user_id' => $user_id,
					'imgUrl' => $imgUrl,
					'category_id' => $category_id,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_gallery->updateGallery($id, $galleryData);

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

	public function deleteGallery($id)
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) {

			$blog = $this->api_model_gallery->get_admin_gallery($id);

			if($blog->img && file_exists(FCPATH.'media/uploads/gallerys/'.$gallery->img))
			{
				unlink(FCPATH.'media/uploads/gallerys/'.$gallery->img);
			}

			$this->api_model_gallery->deleteGallery($id);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		// }
	}
}
