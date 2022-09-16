<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_ImageUpload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('api_model_blog');
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



    public function store() {
        $config['upload_path'] = './images/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());

            // $this->load->view('files/upload_form', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());

            // $this->load->view('files/upload_result', $data);
        }
        $response = array(
            'status' => 'success',
            'data' => $response
        );


        $this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
    }
}