<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('google_login_model');

	}

    function loginGoogle(){
        include_once APPPATH . 'libraries/vendor/autoload.php';
        $google_client = new Google_Client();
        $google_client -> setClientId('238811095861-t48mi1cjqkrnlo6dr9uiq0kb03ggjvdd.apps.googleusercontent.com');

        $google_client->setClientSecretKey('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');
        $google_client->setRedirectUri('http://localhost:4200');
        $google_client->addScope('email');
        $google_client->addScope('profile');
        
        if(isset($_GET['code'])){
            $token = $google_client->fetchAccesstokenWithAuthCode($_GET['code']);

            if(!isset($token['error'])){
                $google_client->setAccesToken($token['access_token']);
                $this->session->userdata('acces_token', $token['access_token']);
                $google_client = new Google_Service_Oauth2($google_client);
                $data = $google_service->userinfo->get();
                $current_datetime = date('Y-m-d H:i:s');

                if($this->google_login_model->Is_already_register($data['id'])){

                    //update data
                    $user_data = array(
                        'first_name' => $data['given_name'],
                        'last_name' => $data['family_name'],
                        'email' => $data['email'],
                        'img' => $data['img'],
                        'update_at' => $current_datetime

                    );
                    $this->google_login_model-> Update_user_data($user_data, $data['id']);

                }else{
                    //insert data
                    $user_data = array(
                        'login_oauth_uid' => $data['id'],
                        'first_name' => $data['given_name'],
                        'last_name' => $data['family_name'],
                        'email' => $data['email'],
                        'img' => $data['img'],
                        'created_at' => $current_datetime

                    );

                    $this->google_login_model->Insert_user_data($user_data);
                }

                $this->session->userdata('user_data', $user_data);

            }

        }

        if(!$this->session->userdata('acces_token')){
            $login_button = '<a href ="'.$google_client->createAutUrl().'" <img src="'.base_url().'assets/sign-in-with-google.png"/></a>';
        }

        $data['login_button']= $login_button;
        $this->load->view('google_login', $data);
    }

    function logout(){
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        redirect('google_login/login');
    }


}