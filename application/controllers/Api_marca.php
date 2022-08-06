<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Marca extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_marca');
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

	public function marcas()
	{
		

		$marcas = $this->api_model_marca->get_marcas($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($marcas)){
			foreach($marcas as $marca){


				$posts[] = array(
					'id' => $marca->id,
					'marca_name' => $marca->title,
					'img' => base_url('media/uploads/marcas/'.$marca->img),
					'created_at' => $marca->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function marca($id)
	{
		
		
		$marca = $this->api_model_marca->get_marca($id);

		$post = array(
			'id' => $marca->id,
					'marca_name' => $marca->title,
					'img' => base_url('media/uploads/marcas/'.$marca->img),
					'created_at' => $marca->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_marcas()
	{
		

		$marcas = $this->api_model_marca->get_marcas($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($marcas)){
			foreach($marcas as $marca){

				$posts[] = array(
					'id' => $marca->id,
					'marca_name' => $marca->title,
					'img' => base_url('media/uploads/marcas/'.$marca->img),
					'created_at' => $marca->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminMarcas()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$marcas = $this->api_model_marca->get_admin_marcas();
			foreach($marcas as $marca) {
				$posts[] = array(
					'id' => $marca->id,
					'marca_name' => $marca->title,
					'img' => base_url('media/uploads/marcas/'.$marca->img),
					'created_at' => $marca->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminMarca($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$marca = $this->api_model_marca->get_admin_marca($id);

			$post = array(
				'id' => $marca->id,
					'marca_name' => $marca->title,
					'img' => base_url('media/uploads/marcas/'.$marca->img),
					'created_at' => $marca->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createMarca()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$marca_name = $this->input->post('marca_name');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/marcas/';
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
	        	$marcaData = array(
					'marca_name' => $marca_name,
					'user_id' => $user_id,
					'img' => $filename,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_marca->insertMarca($marcaData);

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

	public function updateMarca($id)
	{
		
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$marca = $this->api_model_marca->get_admin_marca($id);
			$filename = $marca->img;

			$marca_name = $this->input->post('marca_name');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/marcas/';
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
	   
					if($marca->img && file_exists(FCPATH.'media/uploads/marcas/'.$marca->img))
					{
						unlink(FCPATH.'media/uploads/marcas/'.$marca->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$marcaData = array(
					'marca_name' => $marca_name,
					'user_id' => $user_id,
					'img' => $filename,
				);

				$this->api_model_marca->updateMarca($id, $marcaData);

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

	public function deleteMarca($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$marca = $this->api_model_marca->get_admin_marca($id);

			if($marca->img && file_exists(FCPATH.'media/uploads/marcas/'.$marca->img))
			{
				unlink(FCPATH.'media/uploads/marcas/'.$marca->img);
			}

			$this->api_model_marca->deleteMarca($id);

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
