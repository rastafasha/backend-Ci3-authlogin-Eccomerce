<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Direccion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_direccion');
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

	public function direccions()
	{

		$direccions = $this->api_model_direccion->get_direccions($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($direccions)){
			foreach($direccions as $direccion){


				$posts[] = array(
					'id' => $direccion->id,
					'user_id' => $direccion->user_id,
					'first_name' => $direccion->first_name,
					'last_name' => $direccion->last_name,
					'direccion' => $direccion->direccion,
					'referencia' => $direccion->referencia,
					'telefono' => $direccion->telefono,
					'pais' => $direccion->pais,
					'ciudad' => $direccion->ciudad,
					'zip' => $direccion->zip,
					'map' => $direccion->map,
					'created_at' => $direccion->created_at,
					'updated_at' => $direccion->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_direccions()
	{

		$direccions = $this->api_model_direccion->get_direccions($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($direccions)){
			foreach($direccions as $direccion){
				
				$posts[] = array(
					'id' => $direccion->id,
					'user_id' => $direccion->user_id,
					'first_name' => $direccion->first_name,
					'last_name' => $direccion->last_name,
					'direccion' => $direccion->direccion,
					'referencia' => $direccion->referencia,
					'telefono' => $direccion->telefono,
					'pais' => $direccion->pais,
					'ciudad' => $direccion->ciudad,
					'zip' => $direccion->zip,
					'map' => $direccion->map,
					'created_at' => $direccion->created_at,
					'updated_at' => $direccion->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function direccion($id)
	{
		
		$direccion = $this->api_model_direccion->get_direccion($id);

		$post = array(
			'id' => $direccion->id,
					'user_id' => $direccion->user_id,
					'first_name' => $direccion->first_name,
					'last_name' => $direccion->last_name,
					'direccion' => $direccion->direccion,
					'referencia' => $direccion->referencia,
					'telefono' => $direccion->telefono,
					'pais' => $direccion->pais,
					'ciudad' => $direccion->ciudad,
					'zip' => $direccion->zip,
					'map' => $direccion->map,
					'created_at' => $direccion->created_at,
					'updated_at' => $direccion->updated_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}



	public function recent_direccions()
	{

		$direccions = $this->api_model_direccion->get_direccions($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($direccions)){
			foreach($direccions as $direccion){
				
				
				$posts[] = array(
					'id' => $direccion->id,
					'user_id' => $direccion->user_id,
					'first_name' => $direccion->first_name,
					'last_name' => $direccion->last_name,
					'direccion' => $direccion->direccion,
					'referencia' => $direccion->referencia,
					'telefono' => $direccion->telefono,
					'pais' => $direccion->pais,
					'ciudad' => $direccion->ciudad,
					'zip' => $direccion->zip,
					'map' => $direccion->map,
					'created_at' => $direccion->created_at,
					'updated_at' => $direccion->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminDireccions()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$direccions = $this->api_model_direccion->get_admin_direccions();
			foreach($direccions as $direccion) {
				$posts[] = array(
					'id' => $direccion->id,
					'user_id' => $direccion->user_id,
					'first_name' => $direccion->first_name,
					'last_name' => $direccion->last_name,
					'direccion' => $direccion->direccion,
					'referencia' => $direccion->referencia,
					'telefono' => $direccion->telefono,
					'pais' => $direccion->pais,
					'ciudad' => $direccion->ciudad,
					'zip' => $direccion->zip,
					'map' => $direccion->map,
					'created_at' => $direccion->created_at,
					'updated_at' => $direccion->updated_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminDireccion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$direccion = $this->api_model_direccion->get_admin_direccion($id);

			$post = array(
				'id' => $direccion->id,
					'user_id' => $direccion->user_id,
					'first_name' => $direccion->first_name,
					'last_name' => $direccion->last_name,
					'direccion' => $direccion->direccion,
					'referencia' => $direccion->referencia,
					'telefono' => $direccion->telefono,
					'pais' => $direccion->pais,
					'ciudad' => $direccion->ciudad,
					'zip' => $direccion->zip,
					'map' => $direccion->map,
					'created_at' => $direccion->created_at,
					'updated_at' => $direccion->updated_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createDireccion()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

            $user_id = $this->input->post('user_id');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$direccion = $this->input->post('direccion');
			$referencia = $this->input->post('referencia');
			$telefono = $this->input->post('telefono');
			$pais = $this->input->post('pais');
			$zip = $this->input->post('zip');
			$map = $this->input->post('map');
            
			$isUploadError = FALSE;

			if( ! $isUploadError) {
	        	$direccionData = array(
					'user_id' => $user_id,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'direccion' => $direccion,
					'referencia' => $referencia,
					'telefono' => $telefono,
					'pais' => $pais,
					'zip' => $zip,
					'map' => $map,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_direccion->insertDireccion($direccionData);

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

	public function updateDireccion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$direccion = $this->api_model_direccion->get_admin_direccion($id);

			$user_id = $this->input->post('user_id');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$direccion = $this->input->post('direccion');
			$referencia = $this->input->post('referencia');
			$telefono = $this->input->post('telefono');
			$pais = $this->input->post('pais');
			$zip = $this->input->post('zip');
			$map = $this->input->post('map');

			$isUploadError = FALSE;


			if( ! $isUploadError) {
	        	$direccionData = array(
					'user_id' => $user_id,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'direccion' => $direccion,
					'referencia' => $referencia,
					'telefono' => $telefono,
					'pais' => $pais,
					'zip' => $zip,
					'map' => $map,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_direccion->updateDireccion($id, $direccionData);

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

	public function deleteDireccion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$direccion = $this->api_model_direccion->get_admin_direccion($id);

			$this->api_model_direccion->deleteDireccion($id);

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
