<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caracteristicas extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'/login');
		}
		
		
	}
	function agregar()
	{
		$data = array(
			'concepto' => $this->input->post('nombre')
		);
		$this->load->model('Procesos_Caracteristicas');
		$this->Procesos_Caracteristicas->agregar($data);
	}
	
	function modificar()
	{
		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->caracteristicas();
		$this->load->view("ver_caracteristicas", $data);
	}
	
	public function ver()
	{
		$this->load->model('Procesos_Vehiculo');
		$data['vehiculo'] = $this->Procesos_Vehiculo->verVehiculo();
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		
		$nav = array(
			'pagina' => 'caracteristicas'
		);

		$this->load->view("site_header");
		$this->load->view("site_nav", $nav);
		$this->load->view("caracteristicas", $data);
		$this->load->view("site_footer");
	}
	
	function refrescar_categorias()
	{
		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->caracteristicas();
		$this->load->view('recargar/caracteristica', $data);
	}
	
		function eliminar()
	{
		$data = array(
			'idCaracteristica' => $this->input->post('id')
		);
		$this->load->model('Procesos_Caracteristicas');
		$this->Procesos_Caracteristicas->eliminar($data);
		
	}
	
	function verMod()
	{		
		$id = $this->input->post('id');
		$idOrden = $this->input->post('idOrden');

		$data['idVehiculo'] = $id;
		$data['idOrden'] = $idOrden;


		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->caracteristicasRelacion($id,$idOrden);
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		
		$this->load->view("modificar_caracteristicas", $data);
	}

	function verRelacionOrden()
	{
		$id = $this->input->post('id');
		$idOrden = $this->input->post('idOrden');

		$data['id'] = $id;
		$data['idOrden'] = $idOrden;

		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->caracteristicasRelacion($id,$idOrden);
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		
		$this->load->view("modificar_caracteristicas", $data);
	}
	

function verModPresupuesto()
	{		
		$id = $this->input->post('id');
		$idOrden = $this->input->post('idOrden');

		$data['id'] = $id;
		$data['idOrden'] = $idOrden;

		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->caracteristicasRelacion($id,$idOrden);
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		
		$this->load->view("modificar_caracteristicasPresupuesto", $data);
	}

	function agregarRelacion()
	{		
		$id = $this->input->post('id');
		
		$idOrden = $this->input->post('idOrden');

		$data['datos'] = array(
			'idCaracteristica' => $id,
			'activo' => 1,
			'idOrden' => $idOrden
		);
		
		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->agregarRelacion($data['datos']);
		
		
		
	}
	
	function eliminarRelacion()
	{		
		$id = $this->input->post('id');
	
		$idOrden = $this->input->post('idOrden');
		$data['datos'] = array(
			'idCaracteristica' => $id,
			'activo' => 1,
			'idOrden' => $idOrden
		);
		
		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->eliminarRelacion($data['datos']);
		
		
		
	}
	
	
	
}
