<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->helper('verifyAuthToken');
        $this->load->model('api_model');

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        header("Access-Control-Request-Methods: GET, PUT, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Access-Control-Allow-Request-Method");
	
        // header("Accept: */*");
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Encoding: gzip, deflate, br");
        // header("Accept-Language: es-ES,es;q=0.9,en;q=0.8,gl;q=0.7,pt;q=0.6");
        // header("Content-Type: application/json");
	}

    


    public function login(){
        
        
        $jwt = new JWT(); 
        $JwtSecretKey = "myloginSecret";

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        

        $user = $this->AuthModel->check_login($email, $password);
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
        $jwt = new JWT(); 
        $JwtSecretKey = "myloginSecret";

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->AuthModel->check_login($email, $password);

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
                $token = $jwt->encode($user, $JwtSecretKey, 'HS256');
                $tokenArray = array(
                    'user' => $user,
                    'token' => $token,
                );

                echo json_encode($tokenArray);

            }else{
                echo 'User Registered fail';
            }
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
                    // echo $token;
                    // $userTemp = $this->decode_token($token, $JwtSecretKey);
                    $userId = json_decode($token);
                    
                    $user = $this->AuthModel->renewToken($userId->id);
                    echo ($userId->id);
                    var_dump($userId->id);
                    $token = $jwt->encode($user, $JwtSecretKey, 'HS256');

                    $tokenArray = array(
                        'user' => $user,
                        'token' => $token,
                    );

                    // echo json_decode($userTemp);
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
                // echo ($e);
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

   
    public function  encodetoken(){
        $jwt = new JWT(); 
        $JwtSecretKey = "myloginSecret";

        $data = array(
            'id'=>1245,
            'email' => 'test@gmail.com',
            'uerType'=> 'ADMIN'
        );

        $token = $jwt->encode($data, $JwtSecretKey, 'HS256');
        echo $token; 


    }
    

    public function decode_token($token, $JwtSecretKey){
        // $token = $this->uri->segment(3);
        // $token =  $splitToken[0];

        echo 'hola';
        echo $token;
        echo $JwtSecretKey;
        $jwt = new JWT();

        $JwtSecretKey = "myloginSecret";

        $decoded_token = $jwt->decode($token, $JwtSecretKey, 'HS256');
        echo 'quetal?';
        // return object
        // echo '<pre>';
        // print_r($decoded_token);

        //return json
        $token1 = $jwt->jsonEncode($decoded_token);
        echo $token1;




    }
   

    

}