<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->model('api_model_category');
		$this->load->helper('verifyAuthToken');
		$this->load->helper('url');
		$this->load->helper('text');
		
		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
	}


	public function categorys()
	{
		header("Access-Control-Allow-Origin: *");

		$categorys = $this->api_model_category->get_categories($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($categorys)){
			foreach($categorys as $category){


				$posts[] = array(
					'id' => $category->id,
					'category_name' => $category->category_name,
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function category($id)
	{
		
		$category = $this->api_model_category->get_category($id);

		$post = array(
			'id' => $category->id,
			'category_name' => $category->category_name,
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_categorys()
	{


		$categorys = $this->api_model_category->get_categorys($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($categorys)){
			foreach($categorys as $category){
				

				$posts[] = array(
					'id' => $category->id,
					'category_name' => $category->category_name,
					'created_at' => $category->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminCategorys()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$categorys = $this->api_model_category->get_admin_categorys();
			foreach($categorys as $category) {
				$posts[] = array(
					'id' => $category->id,
					'category_name' => $category->category_name,
					'created_at' => $category->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminCategory($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$category = $this->api_model_category->get_admin_category($id);

			$post = array(
				'id' => $category->id,
					'category_name' => $category->category_name,
					'created_at' => $category->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createCategory()
	{
		

		$category_name = $this->input->post('category_name');

		
		$categoryData = array(
			'category_name' => $category_name,
		);

		$id = $this->api_model_category->insertCategory($categoryData);

		$response = array(
			'status' => 'success'
		);

		

		$this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($response)); 
		

	}

	public function updateCategory($id)
	{
		
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$category = $this->api_model_category->get_admin_category($id);

			$category_name = $this->input->post('category_name');


			$categoryData = array(
				'category_name' => $category_name,
			);

			$this->api_model_category->updateCategory($id, $categoryData);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		}
	}

	public function deleteCategory($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$category = $this->api_model_category->get_admin_category($id);

			$this->api_model_category->deleteCategory($id);

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
