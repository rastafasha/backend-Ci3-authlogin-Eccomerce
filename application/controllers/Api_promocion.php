<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Promocion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_promocion');
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

	public function promocions()
	{
		

		$promocions = $this->api_model_promocion->get_promocions($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($promocions)){
			foreach($promocions as $promocion){


				$posts[] = array(
					'id' => $promocion->id,
					'first_title' => $promocion->first_title,
					'producto_title' => $promocion->producto_title,
					'description' => $promocion->description,
					'is_activeText' => $promocion->is_activeText,
					'is_activeBot' => $promocion->is_activeBot,
					'boton' => $promocion->boton,
					'enlace' => $promocion->enlace,
                    'target' => $promocion->target,
                    'is_active' => $promocion->is_active,
					'img' => base_url('media/images/uploads/promocions/'.$promocion->img)
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function promocion($id)
	{
		
		
		$promocion = $this->api_model_promocion->get_promocion($id);

		$post = array(
			'id' => $promocion->id,
					'first_title' => $promocion->first_title,
					'producto_title' => $promocion->producto_title,
					'description' => $promocion->description,
					'is_activeText' => $promocion->is_activeText,
					'is_activeBot' => $promocion->is_activeBot,
					'boton' => $promocion->boton,
					'enlace' => $promocion->enlace,
                    'target' => $promocion->target,
                    'is_active' => $promocion->is_active,
					'img' => base_url('media/images/uploads/promocions/'.$promocion->img)
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_promocions()
	{
		

		$promocions = $this->api_model_promocion->get_promocions($featured=false, $recentpost=1);

		$posts = array();
		if(!empty($promocion)){
			foreach($promocions as $promocion){

				$posts[] = array(
					'id' => $promocion->id,
					'first_title' => $promocion->first_title,
					'producto_title' => $promocion->producto_title,
					'description' => $promocion->description,
					'is_activeText' => $promocion->is_activeText,
					'is_activeBot' => $promocion->is_activeBot,
					'boton' => $promocion->boton,
					'enlace' => $promocion->enlace,
                    'target' => $promocion->target,
                    'is_active' => $promocion->is_active,
					'img' => base_url('media/images/uploads/promocions/'.$promocion->img)
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	//


	//CRUD 

	public function adminPromocions()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$promocions = $this->api_model_promocion->get_admin_promocions();
			foreach($promocions as $promocion) {
				$posts[] = array(
					'id' => $promocion->id,
					'first_title' => $promocion->first_title,
					'producto_title' => $promocion->producto_title,
					'description' => $promocion->description,
					'is_activeText' => $promocion->is_activeText,
					'is_activeBot' => $promocion->is_activeBot,
					'boton' => $promocion->boton,
					'enlace' => $promocion->enlace,
                    'target' => $promocion->target,
                    'is_active' => $promocion->is_active,
					'img' => base_url('media/images/uploads/promocions/'.$promocion->img)
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminPromocion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$promocion = $this->api_model_promocion->get_admin_promocion($id);

			$post = array(
				'id' => $promocion->id,
					'first_title' => $promocion->first_title,
					'producto_title' => $promocion->producto_title,
					'description' => $promocion->description,
					'is_activeText' => $promocion->is_activeText,
					'is_activeBot' => $promocion->is_activeBot,
					'boton' => $promocion->boton,
					'enlace' => $promocion->enlace,
                    'target' => $promocion->target,
                    'is_active' => $promocion->is_active,
					'img' => base_url('media/images/uploads/promocions/'.$promocion->img)
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createPromocion()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$first_title = $this->input->post('first_title');
			$producto_title = $this->input->post('producto_title');
			$description = $this->input->post('description');
			$is_activeText = $this->input->post('is_activeText');
			$is_activeBot = $this->input->post('is_activeBot');
			$boton = $this->input->post('boton');
			$enlace = $this->input->post('enlace');
			$target = $this->input->post('target');
			$is_active = $this->input->post('is_active');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/images/uploads/promocions/';
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
	        	$promocionData = array(
					'first_title' => $first_title,
					'producto_title' => $producto_title,
					'user_id' => $user_id,
					'description' => $description,
					'img' => $filename,
					'is_activeText' => $is_activeText,
					'is_activeBot' => $is_activeBot,
					'boton' => $boton,
					'enlace' => $enlace,
					'target' => $target,
					'is_active' => $is_active,
				);

				$id = $this->api_model_promocion->insertPromocion($promocionData);

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

	public function updatePromocion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$promocion = $this->api_model_promocion->get_admin_promocion($id);
			$filename = $promocion->img;

			$first_title = $this->input->post('first_title');
			$producto_title = $this->input->post('producto_title');
			$description = $this->input->post('description');
			$is_activeText = $this->input->post('is_activeText');
			$is_activeBot = $this->input->post('is_activeBot');
			$boton = $this->input->post('boton');
			$enlace = $this->input->post('enlace');
			$target = $this->input->post('target');
			$is_active = $this->input->post('is_active');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/images/uploads/promocions/';
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
	   
					if($promocion->img && file_exists(FCPATH.'media/images/uploads/promocions/'.$promocion->img))
					{
						unlink(FCPATH.'media/images/uploads/promocions/'.$promocion->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$promocionData = array(
					'first_title' => $first_title,
					'producto_title' => $producto_title,
					'user_id' => $user_id,
					'description' => $description,
					'img' => $filename,
					'is_activeText' => $is_activeText,
					'is_activeBot' => $is_activeBot,
					'boton' => $boton,
					'enlace' => $enlace,
					'target' => $target,
					'is_active' => $is_active,
				);

				$this->api_model_promocion->updatePromocion($id, $promocionData);

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

	public function deletePromocion($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$promocion = $this->api_model_promocion->get_admin_promocion($id);

			if($promocion->img && file_exists(FCPATH.'media/images/uploads/promocions/'.$promocion->img))
			{
				unlink(FCPATH.'media/images/uploads/promocions/'.$promocion->img);
			}

			$this->api_model_promocion->deletePromocion($id);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}
	//


	
	
}
