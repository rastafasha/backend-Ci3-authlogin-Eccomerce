<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Venta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model_venta');
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

	public function ventas()
	{

		$ventas = $this->api_model_venta->get_ventas($featured=false, $recentpost=false);

		$posts = array();
		if(!empty($ventas)){
			foreach($ventas as $venta){

				$posts[] = array(
					'id' => $venta->id,
					'user_id' => $venta->user_id,
					'total_pagado' => $venta->total_pagado,
					'info_cupon' => $venta->info_cupon,
					'metodo_pago' => $venta->metodo_pago,
					'precio_envio' => $venta->precio_envio,
					'tipo_envio' => $venta->tipo_envio,
					'tiempo_estimado' => $venta->tiempo_estimado,
					'direccion' => $venta->direccion,
					'referencia' => $venta->referencia,
					'destinatario' => $venta->destinatario,
					'tracking_number' => $venta->tracking_number,
					'idtransaccion' => $venta->idtransaccion,
					'pais' => $venta->pais,
					'zip' => $venta->zip,
					'ciudad' => $venta->ciudad,
					'month' => $venta->month,
					'day' => $venta->day,
					'year' => $venta->year,
					'estado' => $venta->estado,
					'created_at' => $venta->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function venta($id)
	{
		
		$venta = $this->api_model_venta->get_venta($id);

		$post = array(
            'id' => $venta->id,
					'user_id' => $venta->user_id,
					'total_pagado' => $venta->total_pagado,
					'info_cupon' => $venta->info_cupon,
					'metodo_pago' => $venta->metodo_pago,
					'precio_envio' => $venta->precio_envio,
					'tipo_envio' => $venta->tipo_envio,
					'tiempo_estimado' => $venta->tiempo_estimado,
					'direccion' => $venta->direccion,
					'referencia' => $venta->referencia,
					'destinatario' => $venta->destinatario,
					'tracking_number' => $venta->tracking_number,
					'idtransaccion' => $venta->idtransaccion,
					'pais' => $venta->pais,
					'zip' => $venta->zip,
					'ciudad' => $venta->ciudad,
					'month' => $venta->month,
					'day' => $venta->day,
					'year' => $venta->year,
					'estado' => $venta->estado,
					'created_at' => $venta->created_at
		);
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($post));
	}


	public function recent_ventas()
	{

		$ventas = $this->api_model_venta->get_ventas($featured=false, $recentpost=5);

		$posts = array();
		if(!empty($ventas)){
			foreach($ventas as $venta){
				
				
				$posts[] = array(
					'id' => $venta->id,
					'user_id' => $venta->user_id,
					'total_pagado' => $venta->total_pagado,
					'info_cupon' => $venta->info_cupon,
					'metodo_pago' => $venta->metodo_pago,
					'precio_envio' => $venta->precio_envio,
					'tipo_envio' => $venta->tipo_envio,
					'tiempo_estimado' => $venta->tiempo_estimado,
					'direccion' => $venta->direccion,
					'referencia' => $venta->referencia,
					'destinatario' => $venta->destinatario,
					'tracking_number' => $venta->tracking_number,
					'idtransaccion' => $venta->idtransaccion,
					'pais' => $venta->pais,
					'zip' => $venta->zip,
					'ciudad' => $venta->ciudad,
					'month' => $venta->month,
					'day' => $venta->day,
					'year' => $venta->year,
					'estado' => $venta->estado,
					'created_at' => $venta->created_at
				);
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($posts));
	}


	public function adminVentas()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		$posts = array();
		if($token) {
			$ventas = $this->api_model_venta->get_admin_ventas();
			foreach($ventas as $venta) {
				$posts[] = array(
					'id' => $venta->id,
					'user_id' => $venta->user_id,
					'total_pagado' => $venta->total_pagado,
					'info_cupon' => $venta->info_cupon,
					'metodo_pago' => $venta->metodo_pago,
					'precio_envio' => $venta->precio_envio,
					'tipo_envio' => $venta->tipo_envio,
					'tiempo_estimado' => $venta->tiempo_estimado,
					'direccion' => $venta->direccion,
					'referencia' => $venta->referencia,
					'destinatario' => $venta->destinatario,
					'tracking_number' => $venta->tracking_number,
					'idtransaccion' => $venta->idtransaccion,
					'pais' => $venta->pais,
					'zip' => $venta->zip,
					'ciudad' => $venta->ciudad,
					'month' => $venta->month,
					'day' => $venta->day,
					'year' => $venta->year,
					'estado' => $venta->estado,
					'created_at' => $venta->created_at
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($posts)); 
		}
	}

	public function adminVenta($id)
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$venta = $this->api_model_venta->get_admin_venta($id);

			$post = array(
				'id' => $venta->id,
					'user_id' => $venta->user_id,
					'total_pagado' => $venta->total_pagado,
					'info_cupon' => $venta->info_cupon,
					'metodo_pago' => $venta->metodo_pago,
					'precio_envio' => $venta->precio_envio,
					'tipo_envio' => $venta->tipo_envio,
					'tiempo_estimado' => $venta->tiempo_estimado,
					'direccion' => $venta->direccion,
					'referencia' => $venta->referencia,
					'destinatario' => $venta->destinatario,
					'tracking_number' => $venta->tracking_number,
					'idtransaccion' => $venta->idtransaccion,
					'pais' => $venta->pais,
					'zip' => $venta->zip,
					'ciudad' => $venta->ciudad,
					'month' => $venta->month,
					'day' => $venta->day,
					'year' => $venta->year,
					'estado' => $venta->estado,
					'created_at' => $venta->created_at
			);
			

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($post)); 
		}
	}

	public function createVenta()
	{
		$headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[0];

		if($token) {

			$user_id = $this->input->post('user_id');
			$total_pagado = $this->input->post('total_pagado');
			$info_cupon = $this->input->post('info_cupon');
			$metodo_pago = $this->input->post('metodo_pago');
			$precio_envio = $this->input->post('precio_envio');
			$tipo_envio = $this->input->post('tipo_envio');
			$tiempo_estimado = $this->input->post('tiempo_estimado');
			$direccion = $this->input->post('direccion');
			$referencia = $this->input->post('referencia');
			$destinatario = $this->input->post('destinatario');
			$tracking_number = $this->input->post('tracking_number');
			$idtransaccion = $this->input->post('idtransaccion');
			$pais = $this->input->post('pais');
			$ciudad = $this->input->post('ciudad');
			$zip = $this->input->post('zip');
			$day = $this->input->post('day');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$estado = $this->input->post('estado');



			if( $user_id) {
	        	$blogData = array(
					'user_id' => $user_id,
					'total_pagado' => $total_pagado,
					'info_cupon' => $info_cupon,
					'metodo_pago' => $metodo_pago,
					'precio_envio' => $precio_envio,
					'tipo_envio' => $tipo_envio,
					'tiempo_estimado' => $tiempo_estimado,
					'direccion' => $direccion,
					'referencia' => $referencia,
					'destinatario' => $destinatario,
					'tracking_number' => $tracking_number,
					'idtransaccion' => $idtransaccion,
					'pais' => $pais,
					'ciudad' => $ciudad,
					'zip' => $zip,
					'day' => $day,
					'month' => $month,
					'year' => $year,
					'estado' => $estado,
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

	

	public function deleteVenta($id)
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
