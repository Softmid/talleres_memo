<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'/login');
		}
		
		
	}

	function modificar()
	{
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		$this->load->view("panel/ver_categorias", $data);
	}

	function eliminarRelacion()
	{
		$idRel = $this->input->post('idRel');
		
		$this->load->model('Procesos_relacionCategorias');
		$this->Procesos_relacionCategorias->eliminarRelacion($idRel);
	}
	
	
		/* categoria */
	
	function C_agregar_categoria()
	{
		$data['categoria'] = array(
			'nombre' => $this->input->post('categoria')
		);
		$this->load->model('Procesos_Categorias');
		$this->Procesos_Categorias->agregar_categoria($data);
	}
	
	function ver_categorias()
	{
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		$this->load->view('post/categoria', $data);
	}
	
	function ver_categorias2()
	{
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		$this->load->view('post/categoria2', $data);
	}
	
	function refrescar_categorias()
	{
		$this->load->model('Procesos_Categorias');
		$data['categorias'] = $this->Procesos_Categorias->categorias();
		$this->load->view('post/refrescar_categoria', $data);
	}
	
	function C_agregarSubcategoria()
	{
		$data['subcategoria'] = array(
			'nombre' => $this->input->post('subCategoria'),
			'idCategoria' => $this->input->post('categoria')
		);
		$this->load->model('Procesos_Categorias');
		$this->Procesos_Categorias->agregar_subCategoria($data);
		
	}
	
	function C_eliminarCategoria()
	{
		$data = array(
			'idCategorias' => $this->input->post('id')
		);
		$this->load->model('Procesos_Categorias');
		$this->Procesos_Categorias->eliminarCategoria($data);
		
	}
	
	function C_desactiverCategoria()
	{
		$data = array(
			'idCategorias' => $this->input->post('id')
		);
		$tipo = $this->input->post('tipo');
		$this->load->model('Procesos_Categorias');
		$this->Procesos_Categorias->desactiverCategoria($data, $tipo);
	}
	
	function C_eliminarSubCategoria()
	{
		$data = array(
			'idSubcategorias' => $this->input->post('id')
		);
		$tipo = $this->input->post('tipo');
		$this->load->model('Procesos_Categorias');
		$this->Procesos_Categorias->eliminarSubCategoria($data, $tipo);
		
	}
	
	function verSubcategoria()
	{
		$id = $this->input->post('id');
		$this->load->model('Procesos_Categorias');
		$data['subcategorias'] = $this->Procesos_Categorias->subCategorias($id);
		$this->load->view('post/subcategoria', $data);
	}
	
}