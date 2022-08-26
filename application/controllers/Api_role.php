<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Role extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('api_model_role');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
	}

	public function roles()
	{
		

		$roles = $this->api_model_role->get_roles($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($roles)){
			foreach($roles as $role){


				$posts[] = array(
					'id' => $roles->id,
					'role_name' => $roles->role_name,
					'status' => $roles->status,
                    'created_at' => $roles->created_at,
                    'updated_at' => $roles->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function role($id)
	{
		
		
		$role = $this->api_model_role->get_role($id);

		$post = array(
            'id' => $role->id,
					'role_name' => $role->role_name,
					'status' => $role->status,
                    'created_at' => $role->created_at,
                    'updated_at' => $role->updated_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_sliders()
	{
		
		$roles = $this->api_model_role->get_roles($featured=false, $recentpost=1);

		$posts = array();
		if(!empty($roles)){
			foreach($roles as $role){

				$posts[] = array(
					'id' => $roles->id,
					'role_name' => $roles->role_name,
					'status' => $roles->status,
                    'created_at' => $roles->created_at,
                    'updated_at' => $roles->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	//


	//CRUD slider

	public function adminRoles()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$roles = $this->api_model_role->get_admin_roles();
			foreach($roles as $role) {
				$posts[] = array(
					'id' => $roles->id,
					'role_name' => $roles->role_name,
					'status' => $roles->status,
                    'created_at' => $roles->created_at,
                    'updated_at' => $roles->updated_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminRole($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$role = $this->api_model_role->get_admin_role($id);

			$posts[] = array(
                'id' => $role->id,
                'role_name' => $role->role_name,
                'status' => $role->status,
                'created_at' => $role->created_at,
                'updated_at' => $role->updated_at
            );
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createRole()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$role_name = $this->input->post('role_name');
			$status = $this->input->post('status');


			$isUploadError = FALSE;

			if( $token) {
	        	$roleData = array(
					'role_name' => $role_name,
					'status' => $status,
				);

				$id = $this->api_model_role->insertRole($roleData);

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

	public function updateRole($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$slider = $this->api_model_role->get_admin_slider($id);
			$role_name = $this->input->post('role_name');
			$status = $this->input->post('status');


			if( ! $token) {
	        	$roleData = array(
					'role_name' => $role_name,
					'status' => $status,
				);

				$this->api_model_role->updateSlider($id, $roleData);

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

	public function deleteRole($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$role = $this->api_model_role->get_admin_role($id);

			$this->api_model_role->deleteRole($id);

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
