<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Envio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_envio');
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

	public function envios()
	{

		$envios = $this->api_model_envio->get_envios($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($envios)){
			foreach($envios as $envio){

				$posts[] = array(
					'id' => $envio->id,
					'titulo' => $envio->titulo,
					'precio' => $envio->precio,
					'dias' => $envio->dias,
					'tiempo' => $envio->tiempo,
					'created_at' => $envio->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_envios()
	{

		$envios = $this->api_model_envio->get_envios($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($envios)){
			foreach($envios as $envio){
				
				$posts[] = array(
					'id' => $envio->id,
					'titulo' => $envio->titulo,
					'precio' => $envio->precio,
					'dias' => $envio->dias,
					'tiempo' => $envio->tiempo,
					'created_at' => $envio->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function envio($id)
	{
		
		$envio = $this->api_model_envio->get_envio($id);

		$post = array(
			'id' => $envio->id,
					'titulo' => $envio->titulo,
					'precio' => $envio->precio,
					'dias' => $envio->dias,
					'tiempo' => $envio->tiempo,
					'created_at' => $envio->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}



	public function recent_envios()
	{

		$envios = $this->api_model_envio->get_envios($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($envios)){
			foreach($envios as $envio){
				
				
				$posts[] = array(
					'id' => $envio->id,
					'titulo' => $envio->titulo,
					'precio' => $envio->precio,
					'dias' => $envio->dias,
					'tiempo' => $envio->tiempo,
					'created_at' => $envio->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminEnvios()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$envios = $this->api_model_envio->get_admin_envios();
			foreach($envios as $envio) {
				$posts[] = array(
					'id' => $envio->id,
					'titulo' => $envio->titulo,
					'precio' => $envio->precio,
					'dias' => $envio->dias,
					'tiempo' => $envio->tiempo,
					'created_at' => $envio->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminEnvio($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$envio = $this->api_model_envio->get_admin_envio($id);

			$post = array(
				'id' => $envio->id,
					'titulo' => $envio->titulo,
					'precio' => $envio->precio,
					'dias' => $envio->dias,
					'tiempo' => $envio->tiempo,
					'created_at' => $envio->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createEnvio()
	{
		

			$titulo = $this->input->post('titulo');
			$precio = $this->input->post('precio');
			$dias = $this->input->post('dias');
			$tiempo = $this->input->post('tiempo');

			$envioData = array(
				'titulo' => $titulo,
				'dias' => $dias,
				'precio' => $precio,
				'dias' => $dias,
				'tiempo' => $tiempo,
				'created_at' => date('Y-m-d H:i:s', time())
			);

			$id = $this->api_model_envio->insertEnvio($envioData);

			$response = array(
				'status' => 'success',
				'envio' => $envioData
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		
	}

	

	public function deleteEnvio($id)
	{
		

			$envio = $this->api_model_envio->get_admin_envio($id);

			$this->api_model_envio->deleteEnvio($id);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		
	}
}
