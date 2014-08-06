<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicios extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'/login');
		}
		
		
	}

	function verRelacionCategoria()
	{
		
		$idOrden = $this->input->post('idOrden');
		$this->load->model('Procesos_Servicios');
		$data['rel'] = $this->Procesos_Servicios->ver($idOrden);
		$data['categorias'] = $this->Procesos_Servicios->categorias();
		$data['suma'] = $this->Procesos_Servicios->ver_suma_monto($idOrden);
        

		//print_r($data['default']->result());

		$this->load->view("rel_categoria", $data);
		
	}

	function ver_subcategoria($id_cat)
	{	
		$this->load->model('Procesos_Servicios');
		$data['subcat'] = $this->Procesos_Servicios->subCategorias($id_cat);
		$this->load->view("post/subcategorias_servicios", $data);

	}

	function eliminar_servicios($id_servicio='')
	{	

		$this->load->model('Procesos_Servicios');
		$this->Procesos_Servicios->eliminar_servicios($id_servicio);
		$this->Procesos_Servicios->eliminar_rel_servicios($id_servicio);

	}

	function ver_monto($id_cat='',$id_subcat='',$id_orden='',$id_servicio='')
	{	

		$this->load->model('Procesos_Servicios');
		$data['ver'] = $this->Procesos_Servicios->ver_monto_servicio($id_cat,$id_subcat,$id_orden,$id_servicio);

		if($data['ver']->num_rows()>0)
		{

			echo json_encode($data['ver']->row());

		}
		else
		{	
			echo $id_subcat;

			if($id_subcat!='0')
			{

				$data['monto_servicio'] = array(
				'id_categoria' => $id_cat,
				'id_subcategoria' => $id_subcat,
				'id_orden' => $id_orden,
				'id_servicio' => $id_servicio,
				'monto' => 0
				
				);
			$this->Procesos_Servicios->agregar_monto_servicio($data['monto_servicio']);
			$data['ver'] = $this->Procesos_Servicios->ver_monto_servicio($id_cat,$id_subcat,$id_orden,$id_servicio);

			echo json_encode($data['ver']->row());

			}
				

		}
		

	}

	function actualizar_monto($id_cat='',$id_subcat='',$id_orden='',$id_servicio='',$monto='')
	{	

		$this->load->model('Procesos_Servicios');

		$update = array(
				'monto' => $monto
		);

		$data['update'] = $this->Procesos_Servicios->actualizar_monto_servicio($id_cat,$id_subcat,$id_orden,$id_servicio,$update);

		
		echo json_encode($data);

	}

	function actualizar_monto_orden($id_orden='')
	{	

		$this->load->model('Procesos_Servicios');
		$data['suma'] = $this->Procesos_Servicios->ver_suma_monto($id_orden);

		$suma_monto = $data['suma']->row();
			
		$update = array(

			'monto' => $suma_monto->monto_total

		);

		$this->Procesos_Servicios->actualizar_monto_orden($id_orden,$update);


		
		echo json_encode($data['suma']->row());

	}

	public function agregarTrabajo()
	{	
		
		
		$idOrden = $this->input->post('idOrden');

		
			$cant = $this->input->post('cantInput');
			
			$cant = $cant + 1;
			
			for($i=1;$i<$cant;$i++)
			{
	
				
				$insertar = array(
					
					'concepto' => $this->input->post('concepto'.$i),
					'idOrden' => $this->input->post('idOrden')
				
				);
				
				$this->load->model('Procesos_Servicios');
				$this->Procesos_Servicios->agregar($insertar);
			}
		

		
	}
    
    function actualizar_piezas($id_cat='',$id_subcat='',$id_orden='',$id_servicio='',$piezas='')
	{	

		$this->load->model('Procesos_Servicios');

		$update = array(
				'piezas' => $piezas
		);

		$data['update'] = $this->Procesos_Servicios->actualizar_piezas($id_cat,$id_subcat,$id_orden,$id_servicio,$update);

		
		echo json_encode($data);

	}

	/* categorias */
	
	function C_agregar_categoria()
	{
		$data['categoria'] = array(
			'nombre' => $this->input->post('categoria')
		);
		$this->load->model('Procesos_Servicios');
		$this->Procesos_Servicios->agregar_categoria($data);
		
	}
	
	function ver_categorias()
	{
		$this->load->model('Procesos_Servicios');
		$data['categorias'] = $this->Procesos_Servicios->categorias();
		$this->load->view('post/categoria_servicios', $data);
	}
	
	function ver_categorias2()
	{
		$this->load->model('Procesos_Servicios');
		$data['categorias'] = $this->Procesos_Servicios->categorias();
		$this->load->view('post/categoria2_servicios', $data);
	}
	
	function refrescar_categorias()
	{
		$this->load->model('Procesos_Servicios');
		$data['categorias'] = $this->Procesos_Servicios->categorias();
		$this->load->view('post/refrescar_categoria_servicios', $data);
	}
	
	function C_agregarSubcategoria()
	{
		$data['subcategoria'] = array(
			'nombre' => $this->input->post('subCategoria_servicios'),
			'idCategoria' => $this->input->post('categoria2')
		);
		$this->load->model('Procesos_Servicios');
		$this->Procesos_Servicios->agregar_subCategoria($data);
		
	}
	
	function C_eliminarCategoria()
	{
		$data = array(
			'idCategorias' => $this->input->post('id')
		);
		$this->load->model('Procesos_Servicios');
		$this->Procesos_Servicios->eliminarCategoria($data);
		
	}
	
	function C_desactiverCategoria()
	{
		$data = array(
			'idCategorias' => $this->input->post('id')
		);
		$tipo = $this->input->post('tipo');
		$this->load->model('Procesos_Servicios');
		$this->Procesos_Servicios->desactiverCategoria($data, $tipo);
	}
	
	function C_eliminarSubCategoria()
	{
		$data = array(
			'idSubcategorias' => $this->input->post('id')
		);
		$tipo = $this->input->post('tipo');
		$this->load->model('Procesos_Servicios');
		$this->Procesos_Servicios->eliminarSubCategoria($data, $tipo);
		
	}

	function verSubcategoria()
	{
		$id = $this->input->post('id');
		$this->load->model('Procesos_Servicios');
		$data['subcategorias'] = $this->Procesos_Servicios->subCategorias($id);
		$this->load->view('post/subcategoria_servicios', $data);
	}

	
	
}