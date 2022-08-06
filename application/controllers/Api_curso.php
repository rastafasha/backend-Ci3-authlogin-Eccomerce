<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Curso extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_curso');
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

	public function cursos()
	{
		

		$cursos = $this->api_model_curso->get_cursos($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($cursos)){
			foreach($cursos as $curso){

				$short_desc = strip_tags(character_limiter($curso->description, 70));

				$posts[] = array(
					'id' => $curso->id,
					'name' => $curso->name,
					'price' => $curso->price,
					'description' => $curso->description,
					'video_review' => $curso->video_review,
					'info_short' => $curso->info_short,
					'subcategory' => $curso->subcategory,
					'category_id' => $curso->category_id,
                    'is_featured' => $curso->is_featured,
                    'is_active' => $curso->is_active,
                    'short_desc' => html_entity_decode($short_desc),
					'img' => base_url('media/images/uploads/cursos/'.$curso->img),
					'created_at' => $curso->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_cursos()
	{
		

		$cursos = $this->api_model_curso->get_cursos($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($cursos)){
			foreach($cursos as $curso){
				
				$short_desc = strip_tags(character_limiter($curso->description, 70));

				$posts[] = array(
					'id' => $curso->id,
					'name' => $curso->name,
					'price' => $curso->price,
					'description' => $curso->description,
					'video_review' => $curso->video_review,
					'info_short' => $curso->info_short,
					'subcategory' => $curso->subcategory,
					'category_id' => $curso->category_id,
                    'is_featured' => $curso->is_featured,
                    'is_active' => $curso->is_active,
                    'short_desc' => html_entity_decode($short_desc),
					'img' => base_url('media/images/uploads/cursos/'.$curso->img),
					'created_at' => $curso->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function curso($id)
	{
		
		
		$curso = $this->api_model_curso->get_curso($id);

		$post = array(
			'id' => $curso->id,
					'name' => $curso->name,
					'price' => $curso->price,
					'description' => $curso->description,
					'video_review' => $curso->video_review,
					'info_short' => $curso->info_short,
					'subcategory' => $curso->subcategory,
					'category_id' => $curso->category_id,
                    'is_featured' => $curso->is_featured,
                    'is_active' => $curso->is_active,
                    'short_desc' => html_entity_decode($short_desc),
					'img' => base_url('media/images/uploads/cursos/'.$curso->img),
					'created_at' => $curso->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_cursos()
	{
		

		$cursos = $this->api_model_curso->get_cursos($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($cursos)){
			foreach($cursos as $curso){
				
				$short_desc = strip_tags(character_limiter($curso->description, 70));

				$posts[] = array(
					'id' => $curso->id,
					'name' => $curso->name,
					'price' => $curso->price,
					'description' => $curso->description,
					'video_review' => $curso->video_review,
					'info_short' => $curso->info_short,
					'subcategory' => $curso->subcategory,
					'category_id' => $curso->category_id,
                    'is_featured' => $curso->is_featured,
                    'is_active' => $curso->is_active,
                    'short_desc' => html_entity_decode($short_desc),
					'img' => base_url('media/images/uploads/cursos/'.$curso->img),
					'created_at' => $curso->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminCursos()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$cursos = $this->api_model_curso->get_admin_cursos();
			foreach($cursos as $curso) {
				$posts[] = array(
					'id' => $curso->id,
					'name' => $curso->name,
					'price' => $curso->price,
					'description' => $curso->description,
					'video_review' => $curso->video_review,
					'info_short' => $curso->info_short,
					'subcategory' => $curso->subcategory,
					'category_id' => $curso->category_id,
                    'is_featured' => $curso->is_featured,
                    'is_active' => $curso->is_active,
                    'short_desc' => html_entity_decode($short_desc),
					'img' => base_url('media/images/uploads/cursos/'.$curso->img),
					'created_at' => $curso->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminCurso($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$curso = $this->api_model_curso->get_admin_curso($id);

			$post = array(
				'id' => $curso->id,
					'name' => $curso->name,
					'price' => $curso->price,
					'description' => $curso->description,
					'video_review' => $curso->video_review,
					'info_short' => $curso->info_short,
					'subcategory' => $curso->subcategory,
					'category_id' => $curso->category_id,
                    'is_featured' => $curso->is_featured,
                    'is_active' => $curso->is_active,
                    'short_desc' => html_entity_decode($short_desc),
					'img' => base_url('media/images/uploads/cursos/'.$curso->img),
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createCurso()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$name = $this->input->post('name');
			$price = $this->input->post('price');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$info_short = $this->input->post('info_short');
			$subcategory = $this->input->post('subcategory');
			$category_id = $this->input->post('category_id');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/cursos/';
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
	        	$cursoData = array(
					'name' => $name,
					'price' => $price,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'subcategory' => $subcategory,
					'description' => $description,
					'video_review' => $video_review,
					'info_short' => $info_short,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_curso->insertCurso($cursoData);

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

	public function updateCurso($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$curso = $this->api_model_curso->get_admin_curso($id);
			$filename = $curso->img;

			$name = $this->input->post('name');
			$price = $this->input->post('price');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$info_short = $this->input->post('info_short');
			$subcategory = $this->input->post('subcategory');
			$category_id = $this->input->post('category_id');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/cursos/';
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
	   
					if($curso->img && file_exists(FCPATH.'media/uploads/cursos/'.$curso->img))
					{
						unlink(FCPATH.'media/uploads/cursos/'.$curso->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$cursoData = array(
					'name' => $name,
					'price' => $price,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'subcategory' => $subcategory,
					'description' => $description,
					'video_review' => $video_review,
					'info_short' => $info_short,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active,
				);

				$this->api_model_curso->updateCurso($id, $cursoData);

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

	public function deleteCurso($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$curso = $this->api_model_curso->get_admin_curso($id);

			if($curso->img && file_exists(FCPATH.'media/uploads/cursos/'.$curso->img))
			{
				unlink(FCPATH.'media/uploads/cursos/'.$curso->img);
			}

			$this->api_model_curso->deleteCurso($id);

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
