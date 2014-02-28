<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gastos extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'index.php/login');
		}
		
		
	}
	
	public function ver_gastos()
	{	
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');

		$fechaInicio = $this->input->post('from');
		$fechaFinal = $this->input->post('to');		

		$this->load->model('Procesos_GastosFijos');
		$gastos['gastos'] = $this->Procesos_GastosFijos->ver_gastoFijo($fechaInicio,$fechaFinal);
		
		$data = array(
			'pagina' => 'gastosFijos'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("gastosFijos", $gastos);
		$this->load->view("site_footer");
		
		
	}
	function C_Agregar_gastosFijos()
	{
			
			date_default_timezone_set('Mexico/General');
			$date = new DateTime('NOW');
			$dateTime = $date->format('Y-m-d H:i:s');	

			$data = array(
			'concepto' => $this->input->post('concepto'),
			'monto' => $this->input->post('monto'),
			'fecha_hora' => $dateTime,
			'idUsuario' => $this->session->userdata('idUsuario')
			
			);
			
			$this->load->model('Procesos_gastosFijos');
			$this->Procesos_gastosFijos->agregar_gastosFijos($data);			
	}
	
	function C_Agregar_Gasto()
	{
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y-m-d H:i:s');
		
		$data['orden'] = array(
		'idCategoria' => $this->input->post('categoria'),
		'idSubcategoria' => $this->input->post('subcategoria'),
		'monto' => $this->input->post('gasto'),
		'idOrden' => $this->input->post('idOrden'),
		'descripcion' => $this->input->post('descripcion'),
		'idUsuario' => $this->session->userdata('idUsuario'),
		);
		
		$this->load->model('Procesos_Vehiculo');
		$orden = $this->Procesos_Vehiculo->agregar_orden($data);	
	}
	
	function update_gasto()
	{
		$id = $this->input->post('id');
		$this->load->model('Procesos_Vehiculo');
		$data['gasto'] = array(
			'monto' => $monto = $this->input->post('monto')
		);
		$orden = $this->Procesos_Vehiculo->update_gasto($data, $id);
	}
	
	function eliminar_gasto()
	{
		$data = array(
			'idGastos_Vehiculo' => $this->input->post('id')
		);
		$this->load->model('Procesos_Vehiculo');
		$orden = $this->Procesos_Vehiculo->eliminarGastoVehiculo($data);
	}
		
}



?>