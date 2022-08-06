<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->helper('verifyAuthToken');

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
	}

    


    public function login(){
        $jwt = new JWT(); 
        $JwtSecretKey = "myloginSecret";

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $id = $this->input->post('id');

        $user = $this->AuthModel->check_login($email, $password, $id);
        // echo json_encode($user);

        if($user === false){
            echo 'user not found';
        }else{
            $token = $jwt->encode($user, $JwtSecretKey, 'HS256');
            $tokenArray = array(
                'user' => $user,
                'token' => $token,
            );

            echo json_encode($tokenArray);

        }
    }


    public function signup(){
        if($this->input->post()){
            $username = $this->input->post('username'); 
            $password = $this->input->post('password'); 
            $first_name = $this->input->post('first_name'); 
            $last_name = $this->input->post('last_name'); 
            $email = $this->input->post('email'); 
            $role_id = $this->input->post('role_id'); 
            $userData = array(
                'username'=>$username,
                'password'=>$password,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'email'=>$email,
                'role_id'=>$role_id,
                'created_at'=>date('Y-m-d H:i:s', time())
            );

            $userId = $this->AuthModel->signup($userData);
            if($userId){
                echo'User registered Succesfully';
            }else{
                echo 'User Registered fail';
            }
        }
    }

    public function get_roles(){
        $roles = $this->AuthModel->getRoles();
        echo json_encode($roles);
    }

    public function getUsers(){
		
        $header = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $header);
        $token =  $splitToken[0];
    
            try {
                $token = verifyAuthToken($token);
                if($token){
                    $users = $this->AuthModel->getUsers();
                    echo json_encode($users);
                }
                    
            }
            catch(Exception $e) {
            // echo 'Message: ' .$e->getMessage();
                $error = array(
                    "status"=>401,
                    "message"=>"Invalid Token provided",
                    "sucess"=>false
                    );
    
                echo json_encode($error);
            }
            
            
    }


    public function renewToken(){
        $header = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $header);
        $token =  $splitToken[0];

        $jwt = new JWT(); 
        $JwtSecretKey = "myloginSecret";
    
            try {
                $token = verifyAuthToken($token);
                if($token){
                    
                    $user_id = $this->AuthModel->renewToken();

                    $token = $jwt->encode($user_id, $JwtSecretKey, 'HS256');
                    $tokenArray = array(
                        'ok' => true,
                        'user' => $user_id,
                        'token' => $token,
                    );

                    // echo json_encode($user);
                    echo json_encode($tokenArray);
                }
                    
            }
            catch(Exception $e) {
                $error = array(
                    "status"=>401,
                    "message"=>"Invalid Token provided",
                    "sucess"=>false
                    );
    
                echo json_encode($error);
            }

    }

    

}