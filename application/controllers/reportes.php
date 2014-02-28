<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'index.php/login');
		}
		
		
	}
	
	
	public function C_ver_reportesFechas()
	{	
		$fechaInicio = $this->input->post('from');
		$fechaFinal = $this->input->post('to');
		
		$datos['template'] = array(
		'alert' => $this->uri->segment(3)
		);
		
				
		$this->load->model('Procesos_Reportes');
		$datos['fechas'] = $this->Procesos_Reportes->ver_reporteFechas($fechaInicio,$fechaFinal);
		
		$data = array(
			'pagina' => 'reportes'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("reporte_fechas", $datos);
		$this->load->view("site_footer");
		
		
	}
	
	public function C_ver_reporteGastos()
	{	
		$fechaInicio = $this->input->post('from');
		$fechaFinal = $this->input->post('to');
		
		$datos['template'] = array(
		'alert' => $this->uri->segment(3)
		);
		
				
		$this->load->model('Procesos_Reportes');
		$datos['gastos'] = $this->Procesos_Reportes->ver_reporteGastos($fechaInicio,$fechaFinal);
		
		$data = array(
			'pagina' => 'gastos'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("gastosFijos", $datos);
		$this->load->view("site_footer");
		
		
	}
	
	
	public function C_ver_exportarFechas()
	{	
		$fechaInicio = $this->uri->segment(3);
		$fechaFinal = $this->uri->segment(4);
		
		$this->load->model('Procesos_Reportes');
		$datos['fechas'] = $this->Procesos_Reportes->ver_reporteFechas($fechaInicio,$fechaFinal);

		$datos['vehiculosFinalizados'] = $this->Procesos_Reportes->vehiculos_finalizados($fechaInicio,$fechaFinal);

		$contVehiculos = $datos['vehiculosFinalizados']->row();
		
		// Load libreria
        $this->load->library('Excel/PHPExcel');
		$file = new PHPExcel();
		$reader = PHPExcel_IOFactory::createReader('Excel5');
		$file = $reader->load("./templates/templateVehiculos.xls");
     	$baseRow = 7;
     	$primeraColGastos = 'K';
     	$totalGastosFijos = 0;

     	$ultimaColumna = $file->getActiveSheet()->getHighestColumn();

		$colGastoxVehiculo = $ultimaColumna--;

		//columna de fechas
		$col = $file->getActiveSheet()->getHighestColumn();
		$col++;
		$col++;
		$colFechas = $col;

     	$lastColumn = $file->getActiveSheet()->getHighestColumn();
		$lastColumn++;

		$file->getActiveSheet()->setCellValue($lastColumn.'6','Total');
		$file->getActiveSheet()->setCellValue($colFechas.'6','Dias en Taller');
		
		foreach($datos['fechas']->result() as $r => $dataRow) {
		$row = $baseRow + $r;
		
		$file->getActiveSheet()->setCellValue('A'.$row,$dataRow->clave)
	                              ->setCellValue('B'.$row, $dataRow->modelo)
	                              ->setCellValue('C'.$row, $dataRow->empresa)
								  ->setCellValue('D'.$row, $dataRow->num_factura)
								  ->setCellValue('E'.$row, '')
								  ->setCellValue('F'.$row, $dataRow->monto)
								  ->setCellValue('G'.$row, $dataRow->IVA)
								  ->setCellValue('H'.$row, '')
								  ->setCellValue('I'.$row, '');						  		 
		 
		 

		 	
			$cat = 5;
			$subCat = 6;


		
			//desplegar todos los gastos de los vehiculos
			for ($column = 'K'; $column != $lastColumn; $column++) 
			{
				
				$cellCat = $file->getActiveSheet()->getCell($column.$cat);
				$cellSubCat = $file->getActiveSheet()->getCell($column.$subCat);
				
				$datos['gastosVehiculo'] = $this->Procesos_Reportes->ver_reporteCategorias($dataRow->idOrdenes,$cellCat,$cellSubCat);

				$datos['orden'] = $this->Procesos_Reportes->ver_ordenVehiculo($dataRow->idOrdenes);
				
				$orden = $datos['orden']->row();
			

				//dias en el taller = fecha de entrada - fecha de Salida

				$fecha1 = $orden->fecha_hora;
				$fechaEntrada =  new DateTime($fecha1);
				$fechaEntrada = $fechaEntrada->format('Y-m-d');

				$fecha2 = $orden->fecha_vehiculoEntregado;
				$fechaSalida =  new DateTime($fecha2);
				$fechaSalida = $fechaSalida->format('Y-m-d');
				

				if($fechaSalida!="-0001-11-30")
				{	
				list($ano1,$mes1,$dia1) = explode('-',$fechaEntrada);
				$tiempo1 = mktime(0,0,0,$mes1,$dia1,$ano1);
				list($ano2,$mes2,$dia2) = explode('-',$fechaSalida);
				$tiempo2 = mktime(0,0,0,$mes2,$dia2,$ano2);
				$tiempoSeg = $tiempo1 - $tiempo2;
				$tiempoSeg = $tiempoSeg / (60 * 60 * 24); 
				$tiempoSeg = abs($tiempoSeg); 
				$dias = floor($tiempoSeg);
			
				$file->getActiveSheet()->setCellValue($colFechas.$row,$dias);
				}



					foreach($datos['gastosVehiculo']->result() as $gastos)
			 		{	
				
					$file->getActiveSheet()->setCellValue($column.$row,$gastos->total);

						
					}//foreach categorias


				$file->getActiveSheet()->setCellValue($lastColumn.$row,'=SUM('.$primeraColGastos.$row.':'.$colGastoxVehiculo.$row.')');


			}//For ultima columna usada

			

			//total de gastos por vehiculo
			for ($column2= 'K'; $column2 != $lastColumn; $column2++) {

				$file->getActiveSheet()->setCellValue($column2.($row+1),'=SUM('.$column2.'7'.':'.$column2.($row).')');


			}
			

			//total de gastos de todos los vehiculos
			$file->getActiveSheet()->setCellValue($lastColumn.($row+1),'=SUM('.$lastColumn.'7'.':'.$lastColumn.($row).')');

			//total de montos
			$file->getActiveSheet()->setCellValue('F'.($row+1),'=SUM(F7'.':'.'F'.($row).')');

			//total de Iva
			$file->getActiveSheet()->setCellValue('G'.($row+1),'=SUM('.'G'.'7'.':'.'G'.($row).')');
		 		 		
		}//foreach fechas

		//utilidad Bruta = total de montos - total de gastos
			
			$file->getActiveSheet()->setCellValue('K'.($row+5),'Utilidad Bruta');
			$file->getActiveSheet()->setCellValue('K'.($row+6),'='.'F'.($row+1).'-'.$lastColumn.($row+1));

			$vehiculosFinalizados = $contVehiculos->vehiculosFinalizados;

		//utilidad Neta = utilidad Bruta - gastos Fijos
		$datos['gastosFijos'] = $this->Procesos_Reportes->gastoFijo($fechaInicio,$fechaFinal);
		$gasto = $datos['gastosFijos']->row();
		
		$file->getActiveSheet()->setCellValue('L'.($row+5),'Utilidad Neta');
		$file->getActiveSheet()->setCellValue('L'.($row+6),'='.'K'.($row+6).'-'.$gasto->total);

		//Promedio de utilidad bruta x vehiculo = utlilidad Bruta / total vehiculos
		$vehiculosFinalizados = $contVehiculos->vehiculosFinalizados;
		$file->getActiveSheet()->setCellValue('M'.($row+5),'Promedio de utilidad bruta x vehiculo');
		$file->getActiveSheet()->setCellValue('M'.($row+6),'='.'K'.($row+6).'/'.$vehiculosFinalizados);

		//Promedio de reparacion =  total de montos / total de vehiculos
		$file->getActiveSheet()->setCellValue('N'.($row+5),'Promedio de reparacion');
		$file->getActiveSheet()->setCellValue('N'.($row+6),'='.'F'.($row+1).'/'.$vehiculosFinalizados);

		
 
 		$this->load->library('funciones');
		
		$fecha = $this->funciones->convertirFecha_YM(date('Y-M'));
      	
        // Salida
     	header("Content-Type: application/vnd.ms-excel");
        $nombreArchivo = 'Relacion_de_Ordenes '.$fecha;
        header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\"");
        header("Cache-Control: max-age=0");
        // Genera Excel
        $writer = PHPExcel_IOFactory::createWriter($file, "Excel5");
        // Escribir
        $writer->save('php://output');
        exit;
		
		
	}
	
	
	
	public function excelGastosFijos() {
		
		$fechaInicio = $this->uri->segment(3);
		$fechaFinal = $this->uri->segment(4);
	

		$this->load->model('Procesos_Reportes');
		$datos['gastos'] = $this->Procesos_Reportes->ver_reporteGastos($fechaInicio,$fechaFinal);
		
		if($datos['gastos']->result())
		{
			$this->load->library('Excel/PHPExcel');
		$file = new PHPExcel();
		$reader = PHPExcel_IOFactory::createReader('Excel5');
		$reader->setReadDataOnly(true);
		$file = $reader->load("./templates/templateGastosFijos.xls");
		$baseRow = 2;
		$montoTotal = 0;
		
		foreach($datos['gastos']->result() as $r => $dataRow) {
		$row = $baseRow + $r;
		
		$this->load->library('funciones');
		
		$fecha = $this->funciones->convertir_fecha($dataRow->fecha_hora);
		
		
		$file->getActiveSheet()->setCellValue('A'.$row,$dataRow->concepto)
	                              ->setCellValue('B'.$row, $dataRow->monto)
	                              ->setCellValue('C'.$row,$fecha)
								  ->setCellValue('D'.$row, $dataRow->nombre.' '.$dataRow->apellido_pat.''.$dataRow->apellido_mat);
							
		 $montoTotal += $dataRow->monto;

		}//foreach
		$file->getActiveSheet()->setCellValue('B'.($row+1),'=SUM(B2:B'.($row).')');
 		
		
		$this->load->library('funciones');
		
	
      
        // Salida
     	header("Content-Type: application/vnd.ms-excel");
        $nombreArchivo = 'Gastos_Fijos '.$fechaInicio.' a '.$fechaFinal;
        header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\"");
        header("Cache-Control: max-age=0");
        // Genera Excel
        $writer = PHPExcel_IOFactory::createWriter($file, "Excel5");
        // Escribir
        $writer->save('php://output');
		
        exit;
			
		}
			
		
    }//function
	
	
	
}