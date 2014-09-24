<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehiculo extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'index.php/login');
		}
	}


	
	public function ver_vehiculo($min = '')
	{	
		if(empty($min))
		{
			$min = 0;
		}

		$this->load->model('Procesos_Vehiculo');
		
		$vehiculo['categorias'] = $this->Procesos_Vehiculo->categorias();
		$numeroVehiculos = $this->Procesos_Vehiculo->countVehiculo();
		
		$data = array( 
			'pagina' => 'vehiculos'
		);
		
		//paginacion
		$this->load->library('pagination');

		$config['base_url'] = base_url()."index.php/vehiculo/ver_vehiculo";
		$config['total_rows'] = $numeroVehiculos;
		$config['per_page'] = 30;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<aside id="paginacion">';
		$config['full_tag_close'] = '</aside>';

		$this->pagination->initialize($config);

		//desplegar vehiculos
		$vehiculo['vehiculos'] = $this->Procesos_Vehiculo->verVehiculo($min,$config['per_page']);

		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("vehiculo", $vehiculo);
		$this->load->view("site_footer");
	}

	
	function C_Agregar_vehiculo()
	{
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y-m-d H:i:s');
		
		//tipoVehiculo = 1  el vehiculo ya existe en la base de datos
		
		$this->load->model('Procesos_Orden');
		$data['clave']=$this->Procesos_Orden->obtenerClave();
		
		foreach($data['clave']->result() as $datos)
		{
			$clave = $datos->clave;
		}
		
		$clave++;
		
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
			'factura' => 0,
			'fecha_hora' => $dateTime,
			'idUsuario' => $this->session->userdata('idUsuario'),
			'num_factura' => $this->input->post('num_factura'),
			'IVA' => 0,
			'fechaPromesa' => $this->input->post('fechaPromesa'),
			'finalizado' => 0,
			'presupuesto' => 0,
			'clave' => $clave,
			'idVehiculo' => $this->input->post('idVehiculo'),
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
			'numeroReporte' => $this->input->post('numeroReporte')

			);
			
			$this->load->model('Procesos_Vehiculo');
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
				'idUsuario' => $this->session->userdata('idUsuario'),
				'year' => $this->input->post('year')
				
			);
		
			$data['orden'] = array(
				'factura' => 0,
				'fecha_hora' => $dateTime,
				'presupuesto' => 0,
				'idUsuario' => $this->session->userdata('idUsuario'),
				'num_factura' => $this->input->post('num_factura'),
				'IVA' => 0,
				'fechaPromesa' => $this->input->post('fechaPromesa'),
				'finalizado' => 0,
				'idUsuario' => $this->session->userdata('idUsuario'),
				'clave' => $clave,
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
				'numeroReporte' => $this->input->post('numeroReporte')
			);
		
		$this->load->model('Procesos_Vehiculo');
		$id = $this->Procesos_Vehiculo->agregar_vehiculo($data);

		echo json_encode($id);
		
		}
		
	}

	
	
	function modificarVehiculo($id_vehiculo,$id_orden)
	{
		$this->load->model('Procesos_Vehiculo');
		
		$vehiculos['datos'] = $this->Procesos_Vehiculo->verVehiculoMod($id_vehiculo);
		$this->load->model('Procesos_Orden');
		$vehiculos['orden'] = $this->Procesos_Orden->verOrden($id_orden);

		$data = array( 
			'pagina' => 'vehiculos'
		);

		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("modificar_vehiculo", $vehiculos);
		$this->load->view("site_footer");
		
	}
    
    function cierre($id_vehiculo,$id_orden)
	{
		$this->load->model('Procesos_Vehiculo');
		
		$vehiculos['datos'] = $this->Procesos_Vehiculo->verVehiculoMod($id_vehiculo);
		$this->load->model('Procesos_Orden');
		$vehiculos['orden'] = $this->Procesos_Orden->verOrden($id_orden);
        $vehiculos['piezas'] = $this->Procesos_Orden->sumar_piezas($id_orden);
    
        $id = $this->Procesos_Orden->search_id('refacciones');
        $vehiculos['montos_refacciones'] = $this->Procesos_Orden->sumar_montos($id->row()->idCategorias,$id_orden);
        $id = $this->Procesos_Orden->search_id('T.O.T.');
        $vehiculos['montos_TOT'] = $this->Procesos_Orden->sumar_montos($id->row()->idCategorias,$id_orden);
        $id = $this->Procesos_Orden->search_id('hojalateria');
        $vehiculos['montos_hojalateria'] = $this->Procesos_Orden->sumar_montos($id->row()->idCategorias,$id_orden);
        $id = $this->Procesos_Orden->search_id('pintura');
        $vehiculos['montos_pintura'] = $this->Procesos_Orden->sumar_montos($id->row()->idCategorias,$id_orden);
        $id = $this->Procesos_Orden->search_id('herreria');
        $vehiculos['montos_herreria'] = $this->Procesos_Orden->sumar_montos($id->row()->idCategorias,$id_orden);
        $id = $this->Procesos_Orden->search_id('mecanica');
        $vehiculos['montos_mecanica'] = $this->Procesos_Orden->sumar_montos($id->row()->idCategorias,$id_orden);
        $id = $this->Procesos_Orden->search_id('estetica');
        $vehiculos['montos_estetica'] = $this->Procesos_Orden->sumar_montos($id->row()->idCategorias,$id_orden);
        
        $suma_HyP = $vehiculos['montos_hojalateria']->row()->suma_montos + $vehiculos['montos_pintura']->row()->suma_montos;
        
        
        $cierre = $this->Procesos_Orden->search_cierre($id_orden);
        
        
        if($cierre->num_rows() == 0)
        {
            $vehiculos['datos_cierre'] = array( 
            'id_orden' => $id_orden,
            'id_vehiculo' => $id_vehiculo,
            'total_valuacion' => $vehiculos['orden']->row()->monto,
            'valuacion_refacciones' => $vehiculos['montos_refacciones']->row()->suma_montos,
            'valuacion_TOT' => $vehiculos['montos_TOT']->row()->suma_montos,
            'valuacion_mecanica' => $vehiculos['montos_mecanica']->row()->suma_montos,
            'mecanica_30' => $vehiculos['montos_mecanica']->row()->suma_montos * .30,
            'pago_mecanica' => $vehiculos['montos_mecanica']->row()->suma_montos * .30,
            'valuacion_HP' => $suma_HyP,
            'HP_30' => $suma_HyP * .30,
            'valuacion_estetica' => $vehiculos['montos_estetica']->row()->suma_montos,
            'estetica_30' => $vehiculos['montos_estetica']->row()->suma_montos * .30,
            'pago_estetica' => $vehiculos['montos_estetica']->row()->suma_montos * .30,
            'total_piezas' => $vehiculos['piezas']->row()->suma_piezas,
            'pago_pintura' => $vehiculos['piezas']->row()->suma_piezas * 330,
            'pago_pulida' => $vehiculos['piezas']->row()->suma_piezas * 23,
            'valuacion_herreria' => $vehiculos['montos_herreria']->row()->suma_montos,
			'herreria_30' => $vehiculos['montos_herreria']->row()->suma_montos * .30,
			'valuacion_HPMH' => $vehiculos['orden']->row()->monto - $vehiculos['montos_TOT']->row()->suma_montos,
			'HPMH_30' => ($vehiculos['orden']->row()->monto - $vehiculos['montos_TOT']->row()->suma_montos) * .30,

            );
            
            $this->Procesos_Orden->agregar_cierre($vehiculos['datos_cierre']);
        }
        else
        {
            $vehiculos['datos_cierre'] = array( 
			'id_orden' => $id_orden,
			'id_vehiculo' => $id_vehiculo,
			'total_valuacion' => $vehiculos['orden']->row()->monto,
			'valuacion_refacciones' => $vehiculos['montos_refacciones']->row()->suma_montos,
			'valuacion_TOT' => $vehiculos['montos_TOT']->row()->suma_montos,
			'valuacion_mecanica' => $vehiculos['montos_mecanica']->row()->suma_montos,
			'mecanica_30' => $vehiculos['montos_mecanica']->row()->suma_montos * .30,
			'valuacion_HP' => $suma_HyP,
			'HP_30' => $suma_HyP * .30,
			'valuacion_estetica' => $vehiculos['montos_estetica']->row()->suma_montos,
			'estetica_30' => $vehiculos['montos_estetica']->row()->suma_montos * .30,
			'total_piezas' => $vehiculos['piezas']->row()->suma_piezas,
			'pago_pintura' => $vehiculos['piezas']->row()->suma_piezas * 330,
			'pago_pulida' => $vehiculos['piezas']->row()->suma_piezas * 23,
            'valuacion_herreria' => $vehiculos['montos_herreria']->row()->suma_montos,
			'herreria_30' => $vehiculos['montos_herreria']->row()->suma_montos * .30,
            'valuacion_HPMH' => $vehiculos['orden']->row()->monto - $vehiculos['montos_TOT']->row()->suma_montos,
			'HPMH_30' => ($vehiculos['orden']->row()->monto - $vehiculos['montos_TOT']->row()->suma_montos) * .30,
            
		      );
            
            $this->Procesos_Orden->update_cierre($vehiculos['datos_cierre'],$id_orden);
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $vehiculos['datos_cierre'] = array( 
			'observaciones' => $this->input->post('observaciones'),
			'comision' => $this->input->post('comision'),
			'pago_TOT' => $this->input->post('pago_TOT'),
			'pago_herreria' => $this->input->post('pago_herreria'),
			'hojalateria' => $this->input->post('hojalateria'),
			'pago_hojalateria' => $this->input->post('pago_hojalateria'),
			'pago_hojalateria_aseguradora' => $this->input->post('pago_hojalateria_aseguradora'),
			'pago_refacciones' => $this->input->post('pago_refacciones'),
			'suma_total' => $this->input->post('suma_total'),
			'utilidad' => $this->input->post('utilidad'),
			'percent_utilidad' => $this->input->post('percent_utilidad'),
			'sugerencia_herreria' => $this->input->post('sugerencia_herreria'),
			'sugerencia_mecanica' => $this->input->post('sugerencia_mecanica'),
			'sugerencia_hojalateria' => $this->input->post('sugerencia_hojalateria'),
            'guardado' => 1

		      );
            
            $this->Procesos_Orden->update_cierre($vehiculos['datos_cierre'],$id_orden);
            
            //ingresar gastos 
            
            
        }
        
        
        $vehiculos['ver_cierre'] = $this->Procesos_Orden->search_cierre($id_orden);

		$data['pagina'] = array( 
			'pagina' => 'vehiculos'
		);
        
        $datos_orden = $vehiculos['orden']->row();
        
        if($datos_orden->aseguradora==0)
        {
            $this->load->view("site_header");
            $this->load->view("site_nav",$data);
            $this->load->view("cierre", $vehiculos);
            $this->load->view("site_footer");
            
        }
        if($datos_orden->aseguradora==1)
        {
            $this->load->view("site_header");
            $this->load->view("site_nav",$data);
            $this->load->view("cierre_aseguradora", $vehiculos);
            $this->load->view("site_footer");
        }

		
		
	}
	
	function modVehiculo ()
	{
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y-m-d H:i:s');
		
		$data['update'] = array(
		'marca' => $this->input->post('marcaMod'),
		'modelo' => $this->input->post('modeloMod'),
		'color' => $this->input->post('colorMod'),
		'placas' => $this->input->post('placasMod'),
		'num_VIN' => $this->input->post('vinMod'),
		'year' => $this->input->post('yearMod')
		);
		
		$data['orden'] = array(
			'factura' => $this->input->post('facturaMod'),
			'idUsuario' => $this->session->userdata('idUsuarioMod'),
			'num_factura' => $this->input->post('num_facturaMod'),
			'IVA' => $this->input->post('ivaMod'),
			'fechaPromesa' => $this->input->post('fechaPromesaMod'),
			'cliente' => $this->input->post('clienteMod'),
			'empresa' => $this->input->post('empresaMod'),
			'telefono' => $this->input->post('telefonoMod'),
			'correo' => $this->input->post('correoMod'),
			'rfc' => $this->input->post('rfcMod'),
			'direccion' => $this->input->post('direccionMod'),
			'celular' => $this->input->post('celularMod'),
			'dedusible' => $this->input->post('dedusible'),
			'fechaSiniestro' => $this->input->post('fechaSiniestro'),
			'numeroPoliza' => $this->input->post('numeroPoliza'),
			'numeroReporte' => $this->input->post('numeroReporte')
			// 'piezas' => $this->input->post('piezasMod')
		);
		
		$data['id'] = array(
		'idVehiculo' => $this->input->post('idVehiculoMod'),
		'idOrden' => $this->input->post('idOrdenMod')
		);	
		
		$this->load->model('Procesos_Vehiculo');
		$this->Procesos_Vehiculo->modVehiculo($data);
		$this->load->model('Procesos_Orden');
		$success = $this->Procesos_Orden->modOrden($data);
		echo $success;
	}
	
	function C_eliminarVehiculo()
	{	
		$data = array(
		'idVehiculo' => $this->input->post('id')
		);	
		
		$this->load->model('Procesos_Vehiculo');
		$this->Procesos_Vehiculo->eliminarVehiculo($data);
	}
	
	function ver_gastos_vehiculo()
	{	

		$id = $this->input->post('id');
		$idOrden = $this->input->post('idOrden');
		$this->load->model('Procesos_Vehiculo');
		$data['vehiculo'] = $this->Procesos_Vehiculo->verVehiculoGasto($id);
		$data['gastos'] = $this->Procesos_Vehiculo->idOrdenGastos($idOrden);
		$data['orden'] = $this->Procesos_Vehiculo->idOrden($idOrden);
		$data['categorias'] = $this->Procesos_Vehiculo->categorias();
		$this->load->view('gastosVehiculo', $data);
	}
	
	function ver_subcategoria()
	{
		$id = $this->input->post('id');
		$this->load->model('Procesos_Vehiculo');
		$data['subcategorias'] = $this->Procesos_Vehiculo->subCategorias($id);
		$this->load->view('subcategoria', $data);
	}
	
	function verSubcategoria()
	{
		$id = $this->input->post('id');
		$this->load->model('Procesos_Vehiculo');
		$data['subcategorias'] = $this->Procesos_Vehiculo->subCategorias($id);
		$this->load->view('post/subcategoria', $data);
	}
	
	function update_gastosVehiculo()
	{	
		$obJson = new stdClass();
		$idOrden = $this->input->post('id');
		$this->load->model('Procesos_Vehiculo');
		$objGastos = $this->Procesos_Vehiculo->idOrdenGastos($idOrden);
		
		$objGastos = $objGastos->result();
		$obJson->gastos = $objGastos;
		$objCategorias = $this->Procesos_Vehiculo->categorias();
		$objCategorias = $objCategorias->result();
		$obJson->categorias = $objCategorias;
		$objOrden = $this->Procesos_Vehiculo->idOrden($idOrden);
		$obJson->orden = $objOrden->row();
		$resultJson['result'] = json_encode($obJson);

		$this->load->view('post/update_gastoVehiculo', $resultJson);
	}

	
	/* categoria */
	
	function C_agregar_categoria()
	{
		$data['categoria'] = array(
			'nombre' => $this->input->post('categoria')
		);
		$this->load->model('Procesos_Vehiculo');
		$this->Procesos_Vehiculo->agregar_categoria($data);
		$this->crearTemplate();
	}
	
	function ver_categorias()
	{
		$this->load->model('Procesos_Vehiculo');
		$data['categorias'] = $this->Procesos_Vehiculo->categorias();
		$this->load->view('post/categoria', $data);
	}
	
	function ver_categorias2()
	{
		$this->load->model('Procesos_Vehiculo');
		$data['categorias'] = $this->Procesos_Vehiculo->categorias();
		$this->load->view('post/categoria2', $data);
	}
	
	function refrescar_categorias()
	{
		$this->load->model('Procesos_Vehiculo');
		$data['categorias'] = $this->Procesos_Vehiculo->categorias();
		$this->load->view('post/refrescar_categoria', $data);
	}
	
	function C_agregarSubcategoria()
	{
		$data['subcategoria'] = array(
			'nombre' => $this->input->post('subCategoria'),
			'idCategoria' => $this->input->post('categoria')
		);
		$this->load->model('Procesos_Vehiculo');
		$this->Procesos_Vehiculo->agregar_subCategoria($data);
		$this->crearTemplate();
	}
	
	function C_eliminarCategoria()
	{
		$data = array(
			'idCategorias' => $this->input->post('id')
		);
		$this->load->model('Procesos_Vehiculo');
		$this->Procesos_Vehiculo->eliminarCategoria($data);
		$this->crearTemplate();
	}
	
	function C_desactiverCategoria()
	{
		$data = array(
			'idCategorias' => $this->input->post('id')
		);
		$tipo = $this->input->post('tipo');
		$this->load->model('Procesos_Vehiculo');
		$this->Procesos_Vehiculo->desactiverCategoria($data, $tipo);
	}
	
	function C_eliminarSubCategoria()
	{
		$data = array(
			'idSubcategorias' => $this->input->post('id')
		);
		$tipo = $this->input->post('tipo');
		$this->load->model('Procesos_Vehiculo');
		$this->Procesos_Vehiculo->eliminarSubCategoria($data, $tipo);
		$this->crearTemplate();
	}
	
	public function crearTemplate()
	{		
		$this->load->model('Procesos_Reportes');
		$datos['header_cat'] = $this->Procesos_Reportes->ver_headerCat();
		
		
		// Load libreria
        $this->load->library('Excel/PHPExcel');
		$file = new PHPExcel();
		$reader = PHPExcel_IOFactory::createReader('Excel5');
		$reader->setReadDataOnly(true);
		$file = $reader->load("./templates/template.xls");
			
		$letra = 'K';	
      	$letra2 = 'K';
		
		foreach($datos['header_cat']->result() as $dataRow) {
							
		
		$datos['header_subCat'] = $this->Procesos_Reportes->ver_headerSubcat($dataRow->idCategorias);
		
		foreach($datos['header_subCat']->result() as $subCat) {
			
			$file->getActiveSheet()->setCellValue($letra.'5',$dataRow->nombre);			
			$file->getActiveSheet()->setCellValue($letra2.'6',$subCat->nombre);
			
			
			
			$letra2++;
			$letra++;		
		}//foreach subcat
	
		
		
	      			
		}//foreach cat
 
      

        // Genera Excel
        $writer = PHPExcel_IOFactory::createWriter($file, "Excel5");
        // Escribir
        $writer->save('./templates/templateVehiculos.xls');
			
        exit;
		
	}

	function ajax_vehiculo()
	{
		$text = $this->input->post('busqueda');
		$this->load->model('Procesos_Vehiculo');
		$vehiculo['vehiculos'] = $this->Procesos_Vehiculo->verVehiculoAjax($text);
		$this->load->view("ajax/recargar_vehiculo.php", $vehiculo);
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
	
	

	function actualizarMonto()
	{

		$idOrden = $this->input->post('idOrden');
		$this->load->model('Procesos_relacionCategorias');
		$data2 = array(
		'monto' => $this->input->post('montoTotal') 
		);


		$this->Procesos_relacionCategorias->actualizar($idOrden,$data2);

	}

	function verFormParticular()
	{		
		$this->load->view("formVehiculoParticular");
	}

	function verFormAseguradora()
	{		
		$this->load->view("formVehiculoAseguradora");
	}

	function entregado()
	{
		date_default_timezone_set('Mexico/General');
		$date = new DateTime('NOW');
		$dateTime = $date->format('Y-m-d H:i:s');

		$this->load->model('Procesos_Vehiculo');

		$idOrden = $this->input->post('id');

		$data = array(
		'entregado' => '1',
		'fecha_vehiculoEntregado' => $dateTime
		);

		$this->Procesos_Vehiculo->entregarVehiculo($idOrden,$data);
	}

	function agregarCorbata()
	{		
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');

		$data['datos'] = array(
			$nombre => 1
		);
		
		$this->load->model('Procesos_relacionCategorias');
		$data['caracteristicas'] = $this->Procesos_relacionCategorias->actualizarCorbata($data['datos'],$id);
	}
	
	function eliminarCorbata()
	{		
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');

		$data['datos'] = array(
			$nombre => 0
		);
		
		$this->load->model('Procesos_relacionCategorias');
		$data['caracteristicas'] = $this->Procesos_relacionCategorias->actualizarCorbata($data['datos'],$id);
	}

	/* imprecion */
	function impresionOrden($id = '', $idOrden = '')
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
		$this->load->view("impresionOrden", $data);
	}

	function impresionOrden_Inventario($id = '', $idOrden = '')
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
		$this->load->view("impresionOrden_Inventario", $data);
	}

	function  impresionCorbata($id = '', $idOrden = '')
	{
		$this->load->model('Procesos_Vehiculo');
		$data['vehiculo'] = $this->Procesos_Vehiculo->verVehiculoMod($id);
		$this->load->model('Procesos_Orden');
		$data['orden'] = $this->Procesos_Orden->verOrden($idOrden);
        $data['piezas'] = $this->Procesos_Orden->sumar_piezas($idOrden);
        
		if($this->session->userdata('privilegios')!=1) 
			{ 
				$this->Procesos_Orden->usar_corbata($idOrden);
			}
		
		$this->load->model('Procesos_Servicios');
		$data['categorias'] = $this->Procesos_Servicios->categorias();
		$data['servicios'] = $this->Procesos_Servicios->ver($idOrden);
		
		$this->load->view("site_header");
		$this->load->view("impresionCorbata", $data);
	}

	function agregar_montoCorbata()
	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$valor = $this->input->post('valor');

		$data['datos'] = array(
			$nombre => $valor
		);
		
		$this->load->model('Procesos_relacionCategorias');
		$data['caracteristicas'] = $this->Procesos_relacionCategorias->actualizarCorbata($data['datos'],$id);	
	}
	
}
?>