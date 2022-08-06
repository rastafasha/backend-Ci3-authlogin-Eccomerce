<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Blog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->helper('verifyAuthToken');
		$this->load->model('api_model_blog');
		$this->load->helper('url');
		$this->load->helper('text');

		header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	}

	public function blogs()
	{

		$blogs = $this->api_model_blog->get_blogs($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($blogs)){
			foreach($blogs as $blog){

				$short_desc = strip_tags(character_limiter($blog->description, 70));
				$author = $blog->first_name.' '.$blog->last_name;

				$posts[] = array(
					'id' => $blog->id,
					'title' => $blog->title,
					'category_id' => $blog->category_id,
					'description' => $blog->description,
					'video_review' => $blog->video_review,
					'short_desc' => html_entity_decode($short_desc),
					'author' => $author,
					'img' => base_url('media/uploads/blogs/'.$blog->img),
					'created_at' => $blog->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function featured_blogs()
	{

		$blogs = $this->api_model_blog->get_blogs($featured=true, $recentpost=false);

		$posts = array();
		if(!empty($blogs)){
			foreach($blogs as $blog){
				
				$short_desc = strip_tags(character_limiter($blog->description, 70));
				$author = $blog->first_name.' '.$blog->last_name;

				$posts[] = array(
					'id' => $blog->id,
					'title' => $blog->title,
					'category_id' => $blog->category_id,
					'description' => $blog->description,
					'video_review' => $blog->video_review,
					'short_desc' => html_entity_decode($short_desc),
					'author' => $author,
					'img' => base_url('media/uploads/blogs/'.$blog->img),
					'created_at' => $blog->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}

	public function blog($id)
	{
		
		$blog = $this->api_model_blog->get_blog($id);

		$short_desc = strip_tags(character_limiter($blog->description, 70));
		$author = $blog->first_name.' '.$blog->last_name;

		$post = array(
			'id' => $blog->id,
					'title' => $blog->title,
					'category_id' => $blog->category_id,
					'description' => $blog->description,
					'video_review' => $blog->video_review,
					'short_desc' => html_entity_decode($short_desc),
					'author' => $author,
					'img' => base_url('media/uploads/blogs/'.$blog->img),
					'created_at' => $blog->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	public function blogbyCategory()
	{
		
		$blog = $this->api_model_blog->getBlogCategory($id);

		$short_desc = strip_tags(character_limiter($blog->description, 70));

		$post = array(
			'id' => $blog->id,
					'title' => $blog->title,
					'category_id' => $blog->category_id,
					'video_review' => $blog->video_review,
					'short_desc' => html_entity_decode($short_desc),
					'img' => base_url('media/uploads/blogs/'.$blog->img),
					'created_at' => $blog->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}

	public function recent_blogs()
	{

		$blogs = $this->api_model_blog->get_blogs($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($blogs)){
			foreach($blogs as $blog){
				
				$short_desc = strip_tags(character_limiter($blog->description, 70));
				$author = $blog->first_name.' '.$blog->last_name;

				$posts[] = array(
					'id' => $blog->id,
					'title' => $blog->title,
					'category_id' => $blog->category_id,
					'description' => $blog->description,
					'video_review' => $blog->video_review,
					'short_desc' => html_entity_decode($short_desc),
					'author' => $author,
					'img' => base_url('media/uploads/blogs/'.$blog->img),
					'created_at' => $blog->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminBlogs()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$blogs = $this->api_model_blog->get_admin_blogs();
			foreach($blogs as $blog) {
				$posts[] = array(
					'id' => $blog->id,
					'title' => $blog->title,
					'category_id' => $blog->category_id,
					'description' => $blog->description,
					'video_review' => $blog->video_review,
					'short_desc' => html_entity_decode($short_desc),
					'author' => $author,
					'img' => base_url('media/uploads/blogs/'.$blog->img),
					'created_at' => $blog->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminBlog($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$blog = $this->api_model_blog->get_admin_blog($id);

			$post = array(
				'id' => $blog->id,
				'title' => $blog->title,
				'category_id' => $blog->category_id,
				'description' => $blog->description,
				'video_review' => $blog->video_review,
                'img' => base_url('media/uploads/blogs/'.$blog->img),
				'is_featured' => $blog->is_featured,
				'is_active' => $blog->is_active
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createBlog()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$category_id = $this->input->post('category_id');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');

			$filename = NULL;

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/blogs/';
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
	        	$blogData = array(
					'title' => $title,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active,
					'created_at' => date('Y-m-d H:i:s', time())
				);

				$id = $this->api_model_blog->insertBlog($blogData);

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

	public function updateBlog($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];
		
		if($token) {

			$blog = $this->api_model_blog->get_admin_blog($id);
			$filename = $blog->img;

			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$video_review = $this->input->post('video_review');
			$category_id = $this->input->post('category_id');
			$is_featured = $this->input->post('is_featured');
			$is_active = $this->input->post('is_active');

			$isUploadError = FALSE;

			if ($_FILES && $_FILES['img']['name']) {

				$config['upload_path']          = './media/uploads/blogs/';
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
	   
					if($blog->img && file_exists(FCPATH.'media/uploads/blogs/'.$blog->img))
					{
						unlink(FCPATH.'media/uploads/blogs/'.$blog->img);
					}

	            	$uploadData = $this->upload->data();
            		$filename = $uploadData['file_name'];
	            }
			}

			if( ! $isUploadError) {
	        	$blogData = array(
					'title' => $title,
					'user_id' => $user_id,
					'category_id' => $category_id,
					'description' => $description,
					'video_review' => $video_review,
					'img' => $filename,
					'is_featured' => $is_featured,
					'is_active' => $is_active
				);

				$this->api_model_blog->updateBlog($id, $blogData);

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

	public function deleteBlog($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$blog = $this->api_model_blog->get_admin_blog($id);

			if($blog->img && file_exists(FCPATH.'media/uploads/blogs/'.$blog->img))
			{
				unlink(FCPATH.'media/uploads/blogs/'.$blog->img);
			}

			$this->api_model_blog->deleteBlog($id);

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
