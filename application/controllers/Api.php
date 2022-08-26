<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
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



	public function users()
	{

		$users = $this->api_model->get_users($recentpost=false);

		$posts = array();
		if(!empty($users)){
			foreach($users as $user){

				$posts[] = array(
					'id' => $user->id,
					'username' => $user->username,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'role_id' => $user->role_id,
					'img' => base_url('media/uploads/users/'.$user->img),
					'created_at' => $user->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function user($id)
	{
		
		$user = $this->api_model->get_user($id);

		$post = array(
			'id' => $user->id,
					'username' => $user->username,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'role_id' => $user->role_id,
					'img' => base_url('media/uploads/users/'.$user->img),
					'created_at' => $user->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}




	public function updateUser($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$user = $this->api_model->get_admin_user($id);
			$filename = $user->img;
			
			$username = $this->input->post('username');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$role_id = $this->input->post('role_id');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/users/';
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
	   
					if($user->img && file_exists(FCPATH.'media/uploads/users/'.$user->img))
					{
						unlink(FCPATH.'media/uploads/users/'.$user->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError && $this->input->post()) {
	        	$userData = array(
					'username' => $username,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'img' => $filename,
					'role_id' => $role_id,
				);

				$this->api_model->updateUser($id, $userData);

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


	public function deleteUser($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$user = $this->api_model->get_admin_user($id);

			if($user->img && file_exists(FCPATH.'media/uploads/users/'.$user->img))
			{
				unlink(FCPATH.'media/uploads/users/'.$user->img);
			}

			$this->api_model->deleteUser($id);

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
