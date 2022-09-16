<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_page');
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

	public function pages()
	{
		

		$pages = $this->api_model_page->get_pages($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($pages)){
			foreach($pages as $page){


				$posts[] = array(
					'id' => $page->id,
					'title' => $page->title,
					'category_id' => $page->category_id,
					'description' => $page->description,
					'video_review' => $page->video_review,
					'is_active' => $page->is_active,
					'is_featured' => $page->is_featured,
					'imgUrl' => $page->imgUrl,
					'img' => base_url('media/uploads/pages/'.$page->img),
					'created_at' => $page->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_pages()
	{
		

		$pages = $this->api_model_page->get_pages($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($pages)){
			foreach($pages as $page){
				
				// $short_desc = strip_tags(character_limiter($page->description, 70));
				// $author = $page->first_name.' '.$page->last_name;

				$posts[] = array(
					'id' => $page->id,
					'title' => $page->title,
					'category_id' => $page->category_id,
					'description' => $page->description,
					'video_review' => $page->video_review,
					'is_active' => $page->is_active,
					'is_featured' => $page->is_featured,
					'imgUrl' => $page->imgUrl,
					// 'short_desc' => html_entity_decode($short_desc),
					// 'author' => $author,
					'img' => base_url('media/uploads/pages/'.$page->img),
					'created_at' => $page->created_at,
					'updated_at' => $page->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function page($id)
	{
		
		$page = $this->api_model_page->get_page($id);


		$post = array(
			'id' => $page->id,
					'title' => $page->title,
					'category_id' => $page->category_id,
					'description' => $page->description,
					'video_review' => $page->video_review,
					'is_active' => $page->is_active,
					'is_featured' => $page->is_featured,
					'imgUrl' => $page->imgUrl,
					'img' => base_url('media/uploads/pages/'.$page->img),
					'created_at' => $page->created_at,
					'updated_at' => $page->updated_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_pages()
	{
		

		$pages = $this->api_model_page->get_pages($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($pages)){
			foreach($pages as $page){
				
				// $short_desc = strip_tags(character_limiter($page->description, 70));
				// $author = $page->first_name.' '.$page->last_name;

				$posts[] = array(
					'id' => $page->id,
					'title' => $page->title,
					'category_id' => $page->category_id,
					'description' => $page->description,
					'video_review' => $page->video_review,
					'is_active' => $page->is_active,
					'is_featured' => $page->is_featured,
					'imgUrl' => $page->imgUrl,
					'img' => base_url('media/uploads/pages/'.$page->img),
					'created_at' => $page->created_at,
					'updated_at' => $page->updated_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminPages()
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) {
		$posts = array();
			$pages = $this->api_model_page->get_admin_pages();
			foreach($pages as $page) {
				$posts[] = array(
					'id' => $page->id,
					'title' => $page->title,
					'category_id' => $page->category_id,
					'description' => $page->description,
					'video_review' => $page->video_review,
					'is_active' => $page->is_active,
					'is_featured' => $page->is_featured,
					'imgUrl' => $page->imgUrl,
					'img' => base_url('media/uploads/pages/'.$page->img),
					'created_at' => $page->created_at,
					'updated_at' => $page->updated_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		// }
	}

	public function adminPage($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$page = $this->api_model_page->get_admin_page($id);

			$post = array(
				'id' => $page->id,
				'title' => $page->title,
				'category_id' => $page->category_id,
				'description' => $page->description,
				'video_review' => $page->video_review,
				'is_active' => $page->is_active,
				'is_featured' => $page->is_featured,
				'imgUrl' => $page->imgUrl,
                'img' => base_url('media/uploads/pages/'.$page->img),
				'is_active' => $page->is_active
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createPage()
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) {

			$title = $this->input->post('title');
			$user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$category_id = $this->input->post('category_id');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');
			$imgUrl = $this->input->post('imgUrl');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/pages/';
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
	        	$pageData = array(
					'title' => $title,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'is_active' => $is_active,
					'imgurl' => $imgurl,
					'img' => $filename,
					'is_featured' => $is_featured,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_page->insertPage($pageData);

				$response = array(
					'status' => 'success'
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		// }
	}

	public function updatePage($id)
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) {

			$page = $this->api_model_page->get_admin_page($id);
			$filename = $page->img;

			$title = $this->input->post('title');
			$user_id = $this->input->post('user_id');
			$category_id = $this->input->post('category_id');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$category_id = $this->input->post('category_id');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');
			$imgUrl = $this->input->post('imgUrl');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/pages/';
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
	   
					if($page->img && file_exists(FCPATH.'media/uploads/pages/'.$page->img))
					{
						unlink(FCPATH.'media/uploads/pages/'.$page->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$pageData = array(
					'title' => $title,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active,
					'imgUrl' => $imgUrl,
					'updated_at' => date('Y-m-d H:i:s', time())
				);

				$this->api_model_page->updatePage($id, $pageData);

				$response = array(
					'status' => 'success'
				);
           	}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		// }
	}

	public function deletePage($id)
	{
		// $headerToken = $this->input->get_request_header('Authorization');
        // $splitToken = explode(" ", $headerToken);
        // $token =  $splitToken[0];

		// if($token) {

			$page = $this->api_model_page->get_admin_page($id);

			if($page->img && file_exists(FCPATH.'media/uploads/pages/'.$page->img))
			{
				unlink(FCPATH.'media/uploads/pages/'.$page->img);
			}

			$this->api_model_page->deletePage($id);

			$response = array(
				'status' => 'success'
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($response)); 
		// }
	}


	public function pagebyCategory($category_id)
	{
		
		$pages = $this->api_model_page->getPageCategory($category_id);

		foreach($pages as $page){
				
			$posts[] = array(
				'id' => $page->id,
					'title' => $page->title,
					'category_id' => $page->category_id,
					'description' => $page->description,
					'video_review' => $page->video_review,
					'is_active' => $page->is_active,
					'is_featured' => $page->is_featured,
					'imgUrl' => $page->imgUrl,
					'img' => base_url('media/uploads/pages/'.$page->img),
					'created_at' => $page->created_at,
					'updated_at' => $page->updated_at
			);
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}
}
