<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('userss');
    }

    function index(){
        if($this->session->has_userdata('logged_in')==NULL)
            $this->load->view('users/login');
    }
    function signin(){
        $username = $this->input->post('email');
        $password = $this->input->post('password');

        $result= $this->userss->Authentication($username,$password);
        if($result){
            $sess_array = array(
                'id' => $result[0]->id,
                'username' => $result[0]->username,
                'rol' => $result[0]->rol,
                'nombre' => $result[0]->nombre,
                'rol_name' => $result[0]->rol_name,
                'company' => $result[0]->idempresa
            );
            if($result[0]->rol==-1)
                $sess_array['rol_name']="SUPER USUARIO";

            $this->session->set_userdata('logged_in', $sess_array);
            //redirect('admin','refresh');
			echo "true";
        }else{
            echo "false";
        }
    }
    function signout(){
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}