<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Comentario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_comentario');
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

	public function comentarios()
	{

		$comentarios = $this->api_model_comentario->get_comentarios($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($comentarios)){
			foreach($comentarios as $comentario){


				$posts[] = array(
					'id' => $comentario->id,
					'user_id' => $comentario->user_id,
					'producto_id' => $comentario->producto_id,
					'curso_id' => $comentario->curso_id,
					'comentario' => $comentario->comentario,
					'pros' => $comentario->pros,
					'cons' => $comentario->cons,
					'estrellas' => $comentario->estrellas,
					'created_at' => $comentario->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_comentarios()
	{

		$comentarios = $this->api_model_comentario->get_comentarios($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($comentarios)){
			foreach($comentarios as $comentario){
				
				$posts[] = array(
					'id' => $comentario->id,
					'user_id' => $comentario->user_id,
					'producto_id' => $comentario->producto_id,
					'curso_id' => $comentario->curso_id,
					'comentario' => $comentario->comentario,
					'pros' => $comentario->pros,
					'cons' => $comentario->cons,
					'estrellas' => $comentario->estrellas,
					'created_at' => $comentario->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function comentario($id)
	{
		
		$comentario = $this->api_model_comentario->get_comentario($id);


		$post = array(
			'id' => $comentario->id,
					'user_id' => $comentario->user_id,
					'producto_id' => $comentario->producto_id,
					'curso_id' => $comentario->curso_id,
					'comentario' => $comentario->comentario,
					'pros' => $comentario->pros,
					'cons' => $comentario->cons,
					'estrellas' => $comentario->estrellas,
					'created_at' => $comentario->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	public function recent_comentarios()
	{

		$comentarios = $this->api_model_comentario->get_comentarios($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($comentarios)){
			foreach($comentarios as $comentario){
				
				
				$posts[] = array(
					'id' => $comentario->id,
					'user_id' => $comentario->user_id,
					'producto_id' => $comentario->producto_id,
					'curso_id' => $comentario->curso_id,
					'comentario' => $comentario->comentario,
					'pros' => $comentario->pros,
					'cons' => $comentario->cons,
					'estrellas' => $comentario->estrellas,
					'created_at' => $comentario->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminComentarios()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$comentarios = $this->api_model_comentario->get_admin_comentarios();
			foreach($comentarios as $comentario) {
				$posts[] = array(
					'id' => $comentario->id,
					'user_id' => $comentario->user_id,
					'producto_id' => $comentario->producto_id,
					'curso_id' => $comentario->curso_id,
					'comentario' => $comentario->comentario,
					'pros' => $comentario->pros,
					'cons' => $comentario->cons,
					'estrellas' => $comentario->estrellas,
					'created_at' => $comentario->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminComentario($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$comentario = $this->api_model_blog->get_admin_comentario($id);

			$post = array(
				'id' => $comentario->id,
					'user_id' => $comentario->user_id,
					'producto_id' => $comentario->producto_id,
					'curso_id' => $comentario->curso_id,
					'comentario' => $comentario->comentario,
					'pros' => $comentario->pros,
					'cons' => $comentario->cons,
					'estrellas' => $comentario->estrellas,
					'created_at' => $comentario->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createComentario()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

            $user_id = $this->input->post('user_id');
			$producto_id = $this->input->post('producto_id');
			$curso_id = $this->input->post('curso_id');
			$comentario = $this->input->post('comentario');
			$pros = $this->input->post('pros');
			$cons = $this->input->post('cons');
			$estrellas = $this->input->post('estrellas');

			$filename = NULL;

			$isUploadError = FALSE;

			if( ! $isUploadError) {
	        	$comentarioData = array(
					'title' => $title,
					'user_id' => $user_id,
					'producto_id' => $producto_id,
					'curso_id' => $curso_id,
					'comentario' => $comentario,
					'pros' => $pros,
					'cons' => $cons,
					'estrellas' => $estrellas,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_comentario->insertBlog($comentarioData);

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

	public function updateComentario($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$comentario = $this->api_model_comentario->get_admin_comentario($id);

			$user_id = $this->input->post('user_id');
			$producto_id = $this->input->post('producto_id');
			$curso_id = $this->input->post('curso_id');
			$comentario = $this->input->post('comentario');
			$pros = $this->input->post('pros');
			$cons = $this->input->post('cons');
			$estrellas = $this->input->post('estrellas');

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$comentarioData = array(
					'title' => $title,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active
				);

				$this->api_model_comentario->updateComentario($id, $comentarioData);

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

	public function deleteComentario($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$comentario = $this->api_model_comentario->get_admin_comentario($id);

			$this->api_model_comentario->deleteComentario($id);

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
