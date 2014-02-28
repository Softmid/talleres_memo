<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orden extends CI_Controller {
	
		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect('index.php/login');
		}
		
	}
	
	
	function C_agregarOrden()
	{
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y-m-d H:i:s');
		$data = array(
			'factura' => $this->input->post('factura'),
			'monto' => $this->input->post('monto'),
			'fecha_hora' => $dateTime,
			'idUsuario' => $this->session->userdata('idUsuario'),
			'idVehiculo' => $this->input->post('idVehiculoOrden'),
			'num_factura' => $this->input->post('num_factura'),
			'IVA' => $this->input->post('iva'),
			'finalizado' => 0
			);
		
	
		$this->load->model('Procesos_Orden');
		$this->Procesos_Orden->agregarOrden($data);
	}
	
	function C_cancelarOrden()
	{	
		$idOrden = $this->input->post('id');

		$data['orden'] = array(
			'cancelado' => 1
			);

		$data['id'] = array(
			'idOrden' => $idOrden
			);
		

		$this->load->model('Procesos_Orden');
		$query = $this->Procesos_Orden->modOrden($data);
	
	}
	function C_finalizarOrden()
	{	
		
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y-m-d H:i:s');
		
		$idOrden = $this->input->post('id');

		$data['orden'] = array(
			'finalizado' => 1,
			'entregado' => 1,
			'fechaFinal' => $dateTime
			);

		$data['id'] = array(
			'idOrden' => $idOrden
			);
		

		$this->load->model('Procesos_Orden');
		$query = $this->Procesos_Orden->modOrden($data);
	
	}
}