<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presupuestos extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'index.php/login');
		}
	}


	
	public function ver_presupuestos()
	{
		$this->load->model('Procesos_Presupuestos');
		$vehiculo['vehiculos'] = $this->Procesos_Presupuestos->verVehiculo();
		$vehiculo['categorias'] = $this->Procesos_Presupuestos->categorias();
		
		$data = array( 
			'pagina' => 'presupuestos'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("presupuestos", $vehiculo);
		$this->load->view("site_footer");
	}

	function agregarPresupuesto()
	{
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y-m-d H:i:s');
		
		//tipoVehiculo = 1  el vehiculo ya existe en la base de datos
				
		
		$data['id'] = array(
		'idVehiculo' => $this->input->post('idVehiculo')
		);	
		
		
		if($this->input->post('tipoVehiculo')==1)
		{
				$data['update'] = array(
			'marca' => $this->input->post('marca'),
			'modelo' => $this->input->post('modelo'),
			'color' => $this->input->post('color'),
			'placas' => $this->input->post('placas'),
			'num_VIN' => $this->input->post('vin'),
			'year' => $this->input->post('year'),
			'idUsuario' => $this->session->userdata('idUsuario')
			
			);
			
			$data['orden'] = array(
			'factura' => $this->input->post('factura'),
			'monto' => $this->input->post('monto'),
			'fecha_hora' => $dateTime,
			'idUsuario' => $this->session->userdata('idUsuario'),
			'num_factura' => $this->input->post('num_factura'),
			'IVA' => $this->input->post('iva'),
			'fechaPromesa' => $this->input->post('fechaPromesa'),
			'finalizado' => 0,
			'presupuesto' => 1,
			'clave' => 0,
			'cliente' => $this->input->post('cliente'),
			'empresa' => $this->input->post('empresa'),
			'telefono' => $this->input->post('telefono'),
			'correo' => $this->input->post('correo'),
			'rfc' => $this->input->post('rfc'),
			'direccion' => $this->input->post('direccion'),
			'celular' => $this->input->post('celular'),
			'aseguradora' => $this->input->post('aseguradora'),
			'dedusible' => $this->input->post('dedusible'),
			'fechaSiniestro' => $this->input->post('fechaSiniestro'),
			'numeroPoliza' => $this->input->post('numeroPoliza'),
			'numeroReporte' => $this->input->post('numeroReporte'),
			'idVehiculo' => $this->input->post('idVehiculo')
		);
			
			$this->load->model('Procesos_Vehiculo');
			$this->load->model('Procesos_Orden');
			$this->Procesos_Vehiculo->modVehiculo($data);
			$idOrden = $this->Procesos_Orden->agregarOrden($data);

			$id = array(	
				'idVehiculo' => $this->input->post('idVehiculo'),
				'idOrden' => $idOrden
			);

			echo json_encode($id);

		}
		
		if($this->input->post('tipoVehiculo')==0)
		{
			$data['vehiculo'] = array(
		'marca' => $this->input->post('marca'),
		'modelo' => $this->input->post('modelo'),
		'color' => $this->input->post('color'),
		'placas' => $this->input->post('placas'),
		'num_VIN' => $this->input->post('vin'),
		'year' => $this->input->post('year'),
		'idUsuario' => $this->session->userdata('idUsuario'),
		);
		
		$data['orden'] = array(
			'factura' => $this->input->post('factura'),
			'monto' => $this->input->post('monto'),
			'fecha_hora' => $dateTime,
			'idUsuario' => $this->session->userdata('idUsuario'),
			'num_factura' => $this->input->post('num_factura'),
			'IVA' => $this->input->post('iva'),
			'fechaPromesa' => $this->input->post('fechaPromesa'),
			'finalizado' => 0,
			'presupuesto' => 1,
			'cliente' => $this->input->post('cliente'),
			'empresa' => $this->input->post('empresa'),
			'telefono' => $this->input->post('telefono'),
			'correo' => $this->input->post('correo'),
			'rfc' => $this->input->post('rfc'),
			'direccion' => $this->input->post('direccion'),
			'celular' => $this->input->post('celular'),
			'aseguradora' => $this->input->post('aseguradora'),
			'dedusible' => $this->input->post('dedusible'),
			'fechaSiniestro' => $this->input->post('fechaSiniestro'),
			'numeroPoliza' => $this->input->post('numeroPoliza'),
			'numeroReporte' => $this->input->post('numeroReporte'),
			'clave' => 0
		);
		
		$this->load->model('Procesos_Vehiculo');
		$id = $this->Procesos_Vehiculo->agregar_vehiculo($data);



		echo json_encode($id);
		
		}
		
	}

	function autorizar()
	{
		$this->load->model('Procesos_Orden');
		$data['clave']=$this->Procesos_Orden->obtenerClave();
		
		$datos = $data['clave']->row(); 
		
		$clave1 = $datos->clave;

		$clave2 = $clave1 + 1;

		if($clave1 == $clave2)
		{
			$clave2++;
		}

		$data['id'] = array(
		'idVehiculo' => $this->input->post('idVehiculo'),
		'idOrden' => $this->input->post('idOrden')
		);
			
			$data['orden'] = array(
			'presupuesto' => 0,
			'clave' => $clave2
		);



		$this->load->model('Procesos_Orden');
		$this->Procesos_Orden->modOrden($data);

		echo $clave2;

	}

	function cancelar()
	{
		$idVehiculo = $this->input->post('idVehiculo');
		$idOrden = $this->input->post('idOrden');

		$this->load->model('Procesos_Presupuestos');
		$this->Procesos_Presupuestos->cancelar($idOrden);
	}

	public function fillFormaAgregar()
	{		
		$vin = $this->input->post('vin');
		$this->load->model('Procesos_Vehiculo');
		$query['vehiculo'] = $this->Procesos_Vehiculo->fillFormaAgregar($vin);
		
		foreach($query['vehiculo']->result() as $data)
		{
			$array['datos'] = array(
			'idVehiculo' => $data->idVehiculo,
			'marca' => $data->marca,
			'modelo' => $data->modelo,
			'year' => $data->year,
			'color' => $data->color,
			'placas' => $data->placas
			
			);
		}
		
		$aux = array(
			'tipoVehiculo' => 1
		);
		//tipoVehiculo 
		//1 = ya esta en la base de datos
		//0 = no existe en la base de datos
		
		$newArray = $this->funciones->associative_push($array['datos'],$aux);
		
		echo json_encode($newArray);
		
		
	}

	function imprecionOrdenPresupuesto($id = '', $idOrden = '')
	{
	
		$this->load->model('Procesos_Vehiculo');
		$data['vehiculo'] = $this->Procesos_Vehiculo->verVehiculoMod($id);
		$this->load->model('Procesos_Orden');
		$data['orden'] = $this->Procesos_Orden->verOrden($idOrden);

		$this->load->model('Procesos_Caracteristicas');
		$data['caracteristicas'] = $this->Procesos_Caracteristicas->caracteristicasRelacion($id,$idOrden);



		$this->load->model('Procesos_Servicios');
		$data['categorias'] = $this->Procesos_Servicios->categorias();
		$data['servicios'] = $this->Procesos_Servicios->ver($idOrden);
		
		
		$this->load->view("site_header");
		$this->load->view("imprecionOrdenPresupuesto", $data);
	}


	function verFormParticular()
	{		
		$this->load->view("formVehiculoParticularPresupuesto");
	}

	function verFormAseguradora()
	{		
		$this->load->view("formVehiculoAseguradoraPresupuesto");
	}
	
	
	
		
}



?>