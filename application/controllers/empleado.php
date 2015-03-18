<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'index.php/login');
		}

		$this->load->model('Procesos_Empleado');
		
	}
	
	public function ver()
	{
		
		$datos['empleados'] = $this->Procesos_Empleado->ver();
		
		$data = array(
			'pagina' => 'empleados'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav", $data);
		$this->load->view("empleado", $datos);
		$this->load->view("site_footer");
	}
	
	
	function modificar()
	{
		$id = $this->input->post('id');
		
		$data['datos'] = $this->Procesos_Empleado->verMod($id);
		$this->load->view("modificar_empleado", $data);
	}
	
	function mod()
	{	
	
	
				$data['update'] = array(
				'nombre' => $this->input->post('nombreMod'),
				'apellidoPat' => $this->input->post('apellido_patMod'),
				'apellidoMat' => $this->input->post('apellido_matMod'),
				'direccion' => $this->input->post('direccionMod'),
				'tel' => $this->input->post('telMod'),
				'cel' => $this->input->post('celMod'),
				'area' => $this->input->post('areaMod'),
				'puesto' => $this->input->post('puestoMod')
				);
		
		
		

		$this->Procesos_Empleado->mod($this->input->post('idEmpleado'),$data['update']);

	}
	
	
	function C_Agregar()
	{
		
		$data = array(
		'nombre' => $nombre = $this->input->post('nombre'),
		'apellidoPat' => $apellido_pat = $this->input->post('apellido_pat'),
		'apellidoMat' => $apellido_mat = $this->input->post('apellido_mat'),
		'direccion' => $username = $this->input->post('direccion'),
		'tel' => $this->input->post('tel'),
		'cel' => $privilegios = $this->input->post('cel'),
		'area' => $privilegios = $this->input->post('area'),
		'puesto' => $privilegios = $this->input->post('puesto')
		
		);

		
		
		$this->Procesos_Empleado->agregar($data);
	}
		function C_eliminar($id)
	{	
		$data['id'] = array(
		'idEmpleado' => $id
		);
		$data['update'] = array(
		'privilegios' => 1
		);	
		$this->Procesos_Empleado->eliminar($data);
	}
		
}


?>