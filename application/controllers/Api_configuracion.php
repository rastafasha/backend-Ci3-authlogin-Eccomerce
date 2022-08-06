<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Configuracion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->model('api_model_configuracion');
		$this->load->helper('verifyAuthToken');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
	
	}

	public function configuracions()
	{

		$configuracions = $this->api_model_configuracion->get_configuracions( $recentpost=false);

		$posts = array();
		if(!empty($configuracions)){
			foreach($configuracions as $configuracion){


				$posts[] = array(
					'id' => $configuracion->id,
					'titulo' => $configuracion->titulo,
					'direccion' => $configuracion->direccion,
					'telefono_uno' => $configuracion->telefono_uno,
					'telefono_dos' => $configuracion->telefono_dos,
					'email_uno' => $configuracion->email_uno,
					'email_dos' => $configuracion->email_dos,
					'horarios' => $configuracion->horarios,
					'iframe_mapa' => $configuracion->iframe_mapa,
					'facebook' => $configuracion->facebook,
					'instagram' => $configuracion->instagram,
					'youtube' => $configuracion->youtube,
					'twitter' => $configuracion->twitter,
					'language' => $configuracion->language,
					'logo' => base_url('media/uploads/configuracions/'.$configuracion->logo),
					'favicon' => base_url('media/uploads/configuracions/'.$configuracion->favicon),
					'created_at' => $configuracion->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function configuracion($id)
	{
		
		
		$configuracion = $this->api_model_configuracion->get_configuracion($id);

		$post = array(
			'id' => $configuracion->id,
					'titulo' => $configuracion->titulo,
					'direccion' => $configuracion->direccion,
					'telefono_uno' => $configuracion->telefono_uno,
					'telefono_dos' => $configuracion->telefono_dos,
					'email_uno' => $configuracion->email_uno,
					'email_dos' => $configuracion->email_dos,
					'horarios' => $configuracion->horarios,
					'iframe_mapa' => $configuracion->iframe_mapa,
					'facebook' => $configuracion->facebook,
					'instagram' => $configuracion->instagram,
					'youtube' => $configuracion->youtube,
					'twitter' => $configuracion->twitter,
					'language' => $configuracion->language,
					'logo' => base_url('media/uploads/configuracions/'.$configuracion->logo),
					'favicon' => base_url('media/uploads/configuracions/'.$configuracion->favicon),
					'created_at' => $configuracion->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}



	public function adminConfiguracions()
	{
		
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$configuracions = $this->api_model_configuracion->get_admin_blogs();
			foreach($blogs as $blog) {
				$posts[] = array(
					'id' => $configuracion->id,
					'titulo' => $configuracion->titulo,
					'direccion' => $configuracion->direccion,
					'telefono_uno' => $configuracion->telefono_uno,
					'telefono_dos' => $configuracion->telefono_dos,
					'email_uno' => $configuracion->email_uno,
					'email_dos' => $configuracion->email_dos,
					'horarios' => $configuracion->horarios,
					'iframe_mapa' => $configuracion->iframe_mapa,
					'facebook' => $configuracion->facebook,
					'instagram' => $configuracion->instagram,
					'youtube' => $configuracion->youtube,
					'twitter' => $configuracion->twitter,
					'language' => $configuracion->language,
					'logo' => base_url('media/uploads/configuracions/'.$configuracion->logo),
					'favicon' => base_url('media/uploads/configuracions/'.$configuracion->favicon),
					'created_at' => $configuracion->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminConfiguracion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$configuracion = $this->api_model_configuracion->get_admin_configuracion($id);

			$post = array(
				'id' => $configuracion->id,
					'titulo' => $configuracion->titulo,
					'direccion' => $configuracion->direccion,
					'telefono_uno' => $configuracion->telefono_uno,
					'telefono_dos' => $configuracion->telefono_dos,
					'email_uno' => $configuracion->email_uno,
					'email_dos' => $configuracion->email_dos,
					'horarios' => $configuracion->horarios,
					'iframe_mapa' => $configuracion->iframe_mapa,
					'facebook' => $configuracion->facebook,
					'instagram' => $configuracion->instagram,
					'youtube' => $configuracion->youtube,
					'twitter' => $configuracion->twitter,
					'language' => $configuracion->language,
					'logo' => base_url('media/uploads/configuracions/'.$configuracion->logo),
					'favicon' => base_url('media/uploads/configuracions/'.$configuracion->favicon),
					'created_at' => $configuracion->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createConfiguracion()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$titulo = $this->input->post('titulo');
			$direccion = $this->input->post('direccion');
			$telefono_uno = $this->input->post('telefono_uno');
			$telefono_dos = $this->input->post('telefono_dos');
			$email_uno = $this->input->post('email_uno');
			$email_dos = $this->input->post('email_dos');
			$horarios = $this->input->post('horarios');
			$iframe_mapa = $this->input->post('iframe_mapa');
			$facebook = $this->input->post('facebook');
			$instagram = $this->input->post('instagram');
			$youtube = $this->input->post('youtube');
			$twitter = $this->input->post('twitter');
			$language = $this->input->post('language');

			$filename = NULL;
			$filename2 = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['logo']['name']) {

				$config['upload_path']          = './media/uploads/configuracions/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('logo')) {

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
            if ($_FILES && $_FILES['favicon']['name']) {

				$config['upload_path']          = './media/uploads/configuracions/';
	            $config['allowed_types']        = 'ico|png';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('favicon')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	            	$uploadData = $this->upload->data();
            		$filename2 = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$configuracionData = array(
					'titulo' => $titulo,
					'user_id' => $user_id,
					'direccion' => $direccion,
					'telefono_uno' => $telefono_uno,
					'telefono_dos' => $telefono_dos,
					'email_uno' => $email_uno,
					'email_dos' => $email_dos,
					'horarios' => $horarios,
					'iframe_mapa' => $iframe_mapa,
					'facebook' => $facebook,
					'instagram' => $instagram,
					'youtube' => $youtube,
					'twitter' => $twitter,
					'language' => $language,
					'logo' => $filename,
					'favicon' => $filename2,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_configuracion->insertConfiguracion($configuracionData);

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

	public function updateConfiguracion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$configuracion = $this->api_model_configuracion->get_admin_configuracion($id);
			$filename = $configuracion->logo;
			$filename2 = $configuracion->favicon;

			$titulo = $this->input->post('titulo');
			$direccion = $this->input->post('direccion');
			$telefono_uno = $this->input->post('telefono_uno');
			$telefono_dos = $this->input->post('telefono_dos');
			$email_uno = $this->input->post('email_uno');
			$email_dos = $this->input->post('email_dos');
			$horarios = $this->input->post('horarios');
			$iframe_mapa = $this->input->post('iframe_mapa');
			$facebook = $this->input->post('facebook');
			$instagram = $this->input->post('instagram');
			$youtube = $this->input->post('youtube');
			$twitter = $this->input->post('twitter');
			$language = $this->input->post('language');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['logo']['name']) {

				$config['upload_path']          = './media/uploads/configuracions/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('logo')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	   
					if($configuracion->logo && file_exists(FCPATH.'media/uploads/configuracions/'.$configuracion->logo))
					{
						unlink(FCPATH.'media/uploads/configuracions/'.$configuracion->logo);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

            if ($_FILES && $_FILES['favicon']['name']) {

				$config['upload_path']          = './media/uploads/configuracions/';
	            $config['allowed_types']        = 'ico|png';
	            $config['max_size']             = 500;

	            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('favicon')) {

	            	$isUploadError = TRUE;

					$response = array(
						'status' => 'error',
						'message' => $this->upload->display_errors()
					);
	            }
	            else {
	   
					if($configuracion->favicon && file_exists(FCPATH.'media/uploads/configuracions/'.$configuracion->favicon))
					{
						unlink(FCPATH.'media/uploads/configuracions/'.$configuracion->favicon);
					}

	            	$uploadData = $this->upload->data();
            		$filename2 = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$configuracionData = array(
					'titulo' => $titulo,
					'user_id' => $user_id,
					'direccion' => $direccion,
					'telefono_uno' => $telefono_uno,
					'telefono_dos' => $telefono_dos,
					'email_uno' => $email_uno,
					'email_dos' => $email_dos,
					'horarios' => $horarios,
					'iframe_mapa' => $iframe_mapa,
					'facebook' => $facebook,
					'instagram' => $instagram,
					'youtube' => $youtube,
					'twitter' => $twitter,
					'language' => $language,
					'logo' => $filename,
					'favicon' => $filename2,
				);

				$this->api_model_configuracion->updateConfiguracion($id, $configuracionData);

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

	public function deleteConfiguracion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$configuracion = $this->api_model_configuracion->get_admin_configuracion($id);

			if($configuracion->logo && file_exists(FCPATH.'media/uploads/configuracions/'.$configuracion->logo))
			{
				unlink(FCPATH.'media/uploads/configuracions/'.$configuracion->logo);
			}
			if($configuracion->favicon && file_exists(FCPATH.'media/uploads/configuracions/'.$configuracion->favicon))
			{
				unlink(FCPATH.'media/uploads/configuracions/'.$configuracion->favicon);
			}

			$this->api_model_configuracion->deleteConfiguracion($id);

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
