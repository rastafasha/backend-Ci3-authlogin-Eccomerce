<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Videocurso extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_videocurso');
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

	public function videocursos()
	{

		$videocursos = $this->api_model_videocurso->get_videocursos($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($videocursos)){
			foreach($videocursos as $videocurso){


				$posts[] = array(
					'id' => $videocurso->id,
					'user_id' => $videocurso->user_id,
					'curso_id' => $videocurso->curso_id,
					'url' => $videocurso->url,
					'estado' => $videocurso->estado,
					'created_at' => $videocurso->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_videocursos()
	{

		$videocursos = $this->api_model_videocurso->get_videocursos($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($videocursos)){
			foreach($videocursos as $videocurso){
				
				$posts[] = array(
					'id' => $videocurso->id,
					'user_id' => $videocurso->user_id,
					'curso_id' => $videocurso->curso_id,
					'url' => $videocurso->url,
					'estado' => $videocurso->estado,
					'created_at' => $videocurso->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function videocurso($id)
	{
		
		$videocurso = $this->api_model_videocurso->get_videocurso($id);


		$post = array(
			'id' => $videocurso->id,
					'user_id' => $videocurso->user_id,
					'curso_id' => $videocurso->curso_id,
					'url' => $videocurso->url,
					'estado' => $videocurso->estado,
					'created_at' => $videocurso->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	public function recent_videocursos()
	{

		$videocursos = $this->api_model_videocurso->get_videocursos($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($videocursos)){
			foreach($videocursos as $videocurso){
				
				
				$posts[] = array(
					'id' => $videocurso->id,
					'user_id' => $videocurso->user_id,
					'curso_id' => $videocurso->curso_id,
					'url' => $videocurso->url,
					'estado' => $videocurso->estado,
					'created_at' => $videocurso->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminVideocursos()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$videocursos = $this->api_model_videocurso->get_admin_videocursos();
			foreach($videocursos as $videocurso) {
				$posts[] = array(
					'id' => $videocurso->id,
					'user_id' => $videocurso->user_id,
					'curso_id' => $videocurso->curso_id,
					'url' => $videocurso->url,
					'estado' => $videocurso->estado,
					'created_at' => $videocurso->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminVideocurso($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$videocurso = $this->api_model_videocurso->get_admin_videocurso($id);

			$post = array(
				'id' => $videocurso->id,
					'user_id' => $videocurso->user_id,
					'curso_id' => $videocurso->curso_id,
					'url' => $videocurso->url,
					'estado' => $videocurso->estado,
					'created_at' => $videocurso->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createVideocurso()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$curso_id = $this->input->post('curso_id');
			$user_id = $this->input->post('user_id');
			$url = $this->input->post('url');
			$estado = $this->input->post('estado');

			$filename = NULL;

			$isUploadError = FALSE;

			if( ! $isUploadError) {
	        	$videocursoData = array(
					'curso_id' => $curso_id,
					'user_id' => $user_id,
					'url' => $url,
					'estado' => $estado,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_videocurso->insertVideocurso($videocursoData);

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

	public function updateVideocurso($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$videocurso = $this->api_model_videocurso->get_admin_videocurso($id);

			$curso_id = $this->input->post('curso_id');
			$user_id = $this->input->post('user_id');
			$url = $this->input->post('url');
			$estado = $this->input->post('estado');

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$videocursoData = array(
					'curso_id' => $curso_id,
					'user_id' => $user_id,
					'url' => $url,
					'estado' => $estado,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_videocurso->updateVideocurso($id, $videocursoData);

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

	public function deleteVideocurso($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$videocurso = $this->api_model_videocurso->get_admin_videocurso($id);

			$this->api_model_videocurso->deleteVideocurso($id);

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
