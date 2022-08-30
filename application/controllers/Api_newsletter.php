<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Newsletter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_newsletter');
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

	public function newsletters()
	{

		$newsletters = $this->api_model_newsletter->get_newsletters($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($newsletters)){
			foreach($newsletters as $newsletter){

				$posts[] = array(
					'id' => $newsletter->id,
					'email' => $newsletter->email,
					'created_at' => $newsletter->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function newsletter($id)
	{
		
		$newsletter = $this->api_model_newsletter->get_newsletter($id);
		$post = array(
			'id' => $newsletter->id,
					'email' => $newsletter->email,
					'created_at' => $newsletter->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	public function recent_newsletters()
	{

		$newsletters = $this->api_model_newsletter->get_newsletters($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($newsletters)){
			foreach($newsletters as $newsletter){
				
				
				$posts[] = array(
					'id' => $newsletter->id,
					'email' => $newsletter->email,
					'created_at' => $newsletter->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminNewsletters()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$newsletters = $this->api_model_newsletter->get_admin_newsletters();
			foreach($newsletters as $newsletter) {
				$posts[] = array(
					'id' => $newsletter->id,
					'email' => $newsletter->email,
					'created_at' => $newsletter->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminNewsletter($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$newsletter = $this->api_model_newsletter->get_admin_newsletter($id);

			$post = array(
				'id' => $newsletter->id,
					'email' => $newsletter->email,
					'created_at' => $newsletter->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}



    public function subscribe()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");
		header('Access-Control-Allow-Headers: Accept,Accept-Language,Content-Language,Content-Type');

		$formdata = json_decode(file_get_contents('php://input'), true);

		if( ! empty($formdata)) {

			$email = $formdata['email'];

			$newsletterData = array(
				'email' => $email,
				'created_at' => date('Y-m-d H:i:s', time())
			);
			
			$id = $this->api_model_newsletter->insertNewsletter($newsletterData);

			$this->sendemail($newsletterData);
			
			$response = array('id' => $id);
		}
		else {
			$response = array('id' => '');
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function sendemail($newsletterData)
	{
		$message = '<p>Hi, <br />Some one has subscribed to newsletter.</p>';
		$message .= '<p><strong>Email: </strong>'.$newsletterData['email'].'</p>';
		$message .= '<br />Thanks';

		$this->load->library('email');

		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';

		$this->email->initialize($config);

		$this->email->from('mercadocreativo@gmail.com', 'UrsiAdmin');
		$this->email->to('mercadocreativo@gmail.com');
		$this->email->cc('mercadocreativo@hotmail.com');
		$this->email->bcc('mercadocreativo@gmail.com');

		$this->email->subject('Subscribe Form');
		$this->email->message($message);

		$this->email->send();
	}


	public function deleteNewsletter($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$newsletter = $this->api_model_newsletter->get_admin_newsletter($id);


			$this->api_model_newsletter->deleteNewsletter($id);

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
