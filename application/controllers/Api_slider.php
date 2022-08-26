<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Slider extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('api_model_slider');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
	}

	public function sliders()
	{
		

		$sliders = $this->api_model_slider->get_sliders($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($sliders)){
			foreach($sliders as $slider){


				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'is_activeText' => $slider->is_activeText,
					'is_activeBot' => $slider->is_activeBot,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
                    'is_active' => $slider->is_active,
					'img' => base_url('media/uploads/sliders/'.$slider->img)
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_sliders()
	{

		$sliders = $this->api_model_slider->get_sliders($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($sliders)){
			foreach($sliders as $slider){
				

				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'is_activeText' => $slider->is_activeText,
					'is_activeBot' => $slider->is_activeBot,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
                    'is_active' => $slider->is_active,
					'img' => base_url('media/uploads/sliders/'.$slider->img)
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function slider($id)
	{
		
		
		$slider = $this->api_model_slider->get_slider($id);

		$post = array(
			'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'is_activeText' => $slider->is_activeText,
					'is_activeBot' => $slider->is_activeBot,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
                    'is_active' => $slider->is_active,
					'img' => base_url('media/uploads/sliders/'.$slider->img)
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_sliders()
	{
		
		$sliders = $this->api_model_slider->get_sliders($featured=false, $recentpost=1);

		$posts = array();
		if(!empty($sliders)){
			foreach($sliders as $slider){

				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'is_activeText' => $slider->is_activeText,
					'is_activeBot' => $slider->is_activeBot,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
                    'is_active' => $slider->is_active,
					'img' => base_url('media/uploads/sliders/'.$slider->img)
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	//


	//CRUD slider

	public function adminSliders()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$sliders = $this->api_model_slider->get_admin_sliders();
			foreach($sliders as $slider) {
				$posts[] = array(
					'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'is_activeText' => $slider->is_activeText,
					'is_activeBot' => $slider->is_activeBot,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
                    'is_active' => $slider->is_active,
					'img' => base_url('media/uploads/sliders/'.$slider->img)
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminSlider($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$slider = $this->api_model_slider->get_admin_slider($id);

			$post = array(
				'id' => $slider->id,
					'title' => $slider->title,
					'description' => $slider->description,
					'is_activeText' => $slider->is_activeText,
					'is_activeBot' => $slider->is_activeBot,
					'boton' => $slider->boton,
					'enlace' => $slider->enlace,
                    'target' => $slider->target,
                    'is_active' => $slider->is_active,
					'img' => base_url('media/uploads/sliders/'.$slider->img)
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createSlider()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$title = $this->input->post('title');
			$user_id = $this->input->post('user_id');
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

				$config['upload_path']          = './media/uploads/sliders/';
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
	        	$sliderData = array(
					'title' => $title,
					'user_id' => $user_id,
					'description' => $description,
					'img' => $filename,
					'is_activeText' => $is_activeText,
					'is_activeBot' => $is_activeBot,
					'boton' => $boton,
					'enlace' => $enlace,
					'target' => $target,
					'is_active' => $is_active,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_slider->insertSlider($sliderData);

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

	public function updateSlider($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$slider = $this->api_model_slider->get_admin_slider($id);
			$filename = $slider->img;

			$title = $this->input->post('title');
			$user_id = $this->input->post('user_id');
			$description = $this->input->post('description');
			$is_activeText = $this->input->post('is_activeText');
			$is_activeBot = $this->input->post('is_activeBot');
			$boton = $this->input->post('boton');
			$enlace = $this->input->post('enlace');
			$target = $this->input->post('target');
			$is_active = $this->input->post('is_active');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/sliders/';
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
	   
					if($slider->img && file_exists(FCPATH.'media/uploads/sliders/'.$slider->img))
					{
						unlink(FCPATH.'media/uploads/sliders/'.$slider->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$sliderData = array(
					'title' => $title,
					'user_id' => $user_id,
					'description' => $description,
					'img' => $filename,
					'is_activeText' => $is_activeText,
					'is_activeBot' => $is_activeBot,
					'boton' => $boton,
					'enlace' => $enlace,
					'target' => $target,
					'is_active' => $is_active,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_slider->updateSlider($id, $sliderData);

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

	public function deleteSlider($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$slider = $this->api_model_slider->get_admin_slider($id);

			if($slider->img && file_exists(FCPATH.'./media/uploads/sliders/'.$slider->img))
			{
				unlink(FCPATH.'./media/uploads/sliders/'.$slider->img);
			}

			$this->api_model_slider->deleteSlider($id);

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
