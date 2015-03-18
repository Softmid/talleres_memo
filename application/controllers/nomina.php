<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nomina extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'index.php/login');
		}
		$this->load->model('Procesos_Nomina');
		$this->load->model('Procesos_Empleado');
	}
    
    
    public function ver()
    {
        $data = array( 
			'pagina' => 'nomina'
		);
        
       
        
        $fechaInicio = $this->input->post('from');
		$fechaFinal = $this->input->post('to');
        
            
            $datos['empleados'] = $this->Procesos_Empleado->ver();
        
            $this->load->view("site_header");
            $this->load->view("site_nav",$data);
            $this->load->view("nomina",$datos);
            $this->load->view("site_footer");
        
    
    }
    
    public function retenciones($semana,$year,$id_empleado,$fecha_ini,$fecha_fin)
	{
		
		$data = array( 
			'pagina' => 'nomina'
		);
        
        $datos['retencion'] = $this->Procesos_Nomina->buscar_retenciones($semana,$year,$id_empleado,$fecha_ini,$fecha_fin);
        
        $datos['empleado'] = $this->Procesos_Nomina->datos_empleado($id_empleado);

        //id de la retencion
        $id = $datos['retencion']->id;

        
        
        
         if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
             
            $datos_update = array(
                'saldo_anterior' => $this->input->post('saldo_anterior'),
                'prestamo_personal' => $this->input->post('prestamo_personal'),
                'abono' => $this->input->post('abono'),
                'saldo_actual' => $this->input->post('saldo_actual'),
                'prestamo_anticipo' => $this->input->post('prestamo_anticipo'),
                'limpieza' => $this->input->post('limpieza'),
                'imss' => $this->input->post('imss'),
                'infonavit' => $this->input->post('infonavit'),
                'retardos' => $this->input->post('retardos'),
                'faltas' => $this->input->post('faltas'),
                'print_personal' => $this->input->post('print_personal'),
                'print_anticipo' => $this->input->post('print_anticipo'),
                'print_limpieza' => $this->input->post('print_limpieza'),
                'print_imss' => $this->input->post('print_imss'),
                'print_infonavit' => $this->input->post('print_infonavit'),
                'print_retardos' => $this->input->post('print_retardos'),
                'print_faltas' => $this->input->post('print_faltas'),
                'actualizado' =>  $datos['retencion']->actualizado + 1
            );
            

             
            $this->Procesos_Nomina->actualizar($id,$datos_update);
            
            $datos['retencion'] = $this->Procesos_Nomina->buscar_retenciones($semana,$year,$id_empleado,$fecha_ini,$fecha_fin);

            $this->form_validation->set_rules('concepto[]','concepto','required|xss_clean');
            $this->form_validation->set_rules('valor[]','puntos','required');
            $this->form_validation->set_rules('visible[]','Imprimir?');

            if($this->form_validation->run())
            {
                $concepto = $this->input->post('concepto');
                $valor = $this->input->post('valor');
                //$visible = $this->input->post('visible');
                
                foreach ($concepto as $key => $value) {

                    $this->db->insert('nomina_retenciones_descuentos',array('id_retencion'=>$id,'concepto'=>$concepto[$key],'valor'=>$valor[$key]));

                }
            }    
        }
        
        $datos['nomina_descuentos'] = $this->Procesos_Nomina->descuentos($id);
        
		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina/retenciones",$datos);
		$this->load->view("site_footer");
	}
    
    
    public function pintura($semana,$year,$id_empleado,$fecha_ini,$fecha_fin)
	{
         $data = array( 
			'pagina' => 'nomina'
		);
        
        $datos['info'] = array(
            'semana' => $semana,
            'year' => $year,
            'id_empleado' => $id_empleado,
            'fecha_ini' => $fecha_ini,
            'fecha_fin' => $fecha_fin
        );
        
        $datos['empleado'] = $this->Procesos_Nomina->datos_empleado($id_empleado);
        $datos['pintura'] = $this->Procesos_Nomina->pintura($id_empleado,$semana,$year);
        $datos['retenciones'] = $this->Procesos_Nomina->retenciones($semana,$year,$id_empleado);
        
        $this->form_validation->set_rules('anticipo_trabajo', 'Anticipo sobre Trabajos','numeric');
        $this->form_validation->set_rules('prestamo_pintura', 'Prestamo','numeric');
        
        if($this->form_validation->run())
        {
            $this->db->set('anticipo_trabajo',$this->input->post('anticipo_trabajo'));
            $this->db->set('prestamo_pintura',$this->input->post('prestamo_pintura'));
            $this->db->where('week',$semana);
            $this->db->where('year',$year);
            $this->db->where('id_empleado',$id_empleado);
            $this->db->update('nomina_retenciones');
        }
        
        
        $this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina/lista_pintura",$datos);
		$this->load->view("site_footer");
    }
    
    public function agregar_pintura($semana,$year,$id_empleado,$fecha_ini,$fecha_fin)
    {
        $data = array( 
			'pagina' => 'nomina'
		);
        
        $datos['empleado'] = $this->Procesos_Nomina->datos_empleado($id_empleado);
        //$this->config->set_item('language', 'spanish');
        
        $this->form_validation->set_rules('input_num', 'numero de Ordenes', 'required');
        $this->form_validation->set_rules('info[id_orden][]');
        $this->form_validation->set_rules('info[clave][]', 'ID de la Orden', 'required');
        $this->form_validation->set_rules('info[marca][]', 'Marca');
        $this->form_validation->set_rules('info[modelo][]', 'modelo');
        $this->form_validation->set_rules('info[color][]', 'color');
        $this->form_validation->set_rules('info[piezas][]', 'piezas', 'required|greater_than[0]');
        $this->form_validation->set_rules('info[chk_preparacion][]','chk Preparacion');
        $this->form_validation->set_rules('info[chk_pintura][]','chk pintura');
        $this->form_validation->set_rules('info[pintura][]','pintura');
        $this->form_validation->set_rules('info[preparacion][]','preparacion');
        $this->form_validation->set_rules('info[total][]','total');
        $this->form_validation->set_rules('info[total_materiales][]','Total de Materiales');
        $this->form_validation->set_rules('info[pintura_materiales][]','Pintura de materiales');
        $this->form_validation->set_rules('info[procesivos_materiales][]','Procesivos de Materiales');
        $this->form_validation->set_rules('info[color_materiales][]','Color de Materiales');
        
        if($this->input->post('btn_guardar'))
        { 
            if ($this->form_validation->run())
            {
                    $a = $this->input->post('info');
                
                    foreach($a['id_orden'] as $clave => $val)
                    {
                       if(isset($a['chk_pintura'][$clave])){ $chk_pint = $a['chk_pintura'][$clave]; } else { $chk_pint = 0; }
                        
                       if(isset($a['chk_preparacion'][$clave])){ $chk_prep = $a['chk_preparacion'][$clave]; } else { $chk_prep = 0; }
                        
                        $newA = array(
                            'id_orden' => $a['id_orden'][$clave],
                            'clave' => $a['clave'][$clave],
                            'id_empleado' => $id_empleado,
                            'week' => $semana,
                            'year' => $year,
                            'pintura' => $a['pintura'][$clave],
                            'preparacion' => $a['preparacion'][$clave],
                            'total_pintura' => $a['total'][$clave],
                            'total_materiales' => $a['total_materiales'][$clave],
                            'materiales_pintura' => $a['pintura_materiales'][$clave],
                            'materiales_procesivos' => $a['procesivos_materiales'][$clave],
                            'materiales_color' => $a['color_materiales'][$clave],
                            'chk_preparacion' => $chk_prep,
                            'chk_pintura' => $chk_pint
                        );
                        
//                        echo "<pre>";
//                        print_r($newA);
//                        echo "</pre>";
                        $this->db->insert('nomina_pintura',$newA);
                    }
                
                redirect('nomina/pintura/'.$semana.'/'.$year.'/'.$id_empleado.'/'.$fecha_ini.'/'.$fecha_fin);
            }
        }
        
        if($this->input->post('btn_campos'))
        { 
            if ($this->form_validation->run() == FALSE)
            {
               
            }
        }

        
        $this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina/agregar_pintura",$datos);
		$this->load->view("site_footer");
    }
    
    public function get_orden($id)
    {
        $datos = $this->Procesos_Nomina->orden($id);
        
        echo $datos;
    }
    
    public function editar_pintura($semana,$year,$id_empleado,$fecha_ini,$fecha_fin,$id)
    {
         $data = array( 
			'pagina' => 'nomina'
		);
                
        
        $this->form_validation->set_rules('chk_preparacion','chk Preparacion');
        $this->form_validation->set_rules('chk_pintura','chk pintura');
        $this->form_validation->set_rules('info[pintura]','pintura');
        $this->form_validation->set_rules('info[preparacion]','preparacion');
        $this->form_validation->set_rules('info[total_pintura]','total');
        $this->form_validation->set_rules('info[total_materiales]','Total de Materiales');
        $this->form_validation->set_rules('info[pintura_materiales]','Pintura de materiales');
        $this->form_validation->set_rules('info[procesivos_materiales]','Procesivos de Materiales');
        $this->form_validation->set_rules('info[color_materiales]','Color de Materiales');
        
        if($this->form_validation->run())
        {
            $chk = $this->input->post('chk_pintura');
            
            if(empty($chk))
            {
                $chk_pintura = 0;
                
            }
            else
            {
                $chk_pintura = 1;
                
            }
            
            $chk2 = $this->input->post('chk_preparacion');
            
            if(empty($chk2))
            {
                $chk_preparacion = 0;
            }
            else
            {
                $chk_preparacion = 1;
            }
            
            $this->db->set('chk_pintura',$chk_pintura);
            $this->db->set('chk_preparacion',$chk_preparacion);
            $this->db->set($this->input->post('info'));
            $this->db->where('id',$id);
            $this->db->update('nomina_pintura');
            $this->session->set_flashdata('msg_success', 'Se ha Actualizado el registro');
        }
        
        $datos['pintura'] = $this->Procesos_Nomina->buscar_join($id,'nomina_pintura','orden','nomina_pintura.id_orden = orden.idOrdenes');
        
        $this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina/form_pintura",$datos);
		$this->load->view("site_footer");  
       //redirect('nomina/pintura/'.$semana.'/'.$year.'/'.$id_empleado.'/'.$fecha_ini.'/'.$fecha_fin); 
    }
    
    public function borrar_pintura($semana,$year,$id_empleado,$fecha_ini,$fecha_fin,$id)
    {   
        if($id=='' || $id<=0)
        {
             $this->session->set_flashdata('msg_success', 'Ha ocurrido un error.');
        }
        else
        {   
            $this->db->where('id',$id);
            $this->db->delete('nomina_pintura');
            $this->session->set_flashdata('msg_success', 'El registro ha sido eliminado.');
            
        }
       
        redirect('nomina/pintura/'.$semana.'/'.$year.'/'.$id_empleado.'/'.$fecha_ini.'/'.$fecha_fin);
    }
    
    public function admin($semana,$year,$id_empleado,$fecha_ini,$fecha_fin)
    {
        $datos['msg_success'] = $this->session->flashdata('msg_success');
        
        $data = array( 
			'pagina' => 'nomina'
		);
        
        $this->form_validation->set_rules('data[sueldo]','Sueldo','required');
        $this->form_validation->set_rules('data[comisiones]','comisiones','required');
        $this->form_validation->set_rules('data[prestamo]','prestamo','required');
        $this->form_validation->set_rules('data[total_percepciones]','total_percepciones');
        $this->form_validation->set_rules('data[prestamo_personal]','prestamo_personal');
        $this->form_validation->set_rules('data[final_percepciones]','final_percepciones');
        $this->form_validation->set_rules('data[otros_descuentos]','otros Descuentos');
        $this->form_validation->set_rules('data[descuentos_fijos]','descuentos_fijos');
        $this->form_validation->set_rules('data[diferencia]','diferencia');
       
        $datos['retenciones'] = $this->Procesos_Nomina->retenciones($semana,$year,$id_empleado);
        
        $datos['empleado'] = $this->Procesos_Nomina->datos_empleado($id_empleado);

        $datos['nomina_descuentos'] = $this->Procesos_Nomina->descuentos($datos['retenciones']->id);
        
        if ($this->form_validation->run())
        {
            $val = $this->input->post('data');
            
            $newA = array(
                            'sueldo' => $val['sueldo'],
                            'comisiones' => $val['comisiones'],
                            'prestamo' => $val['prestamo'],
                            'total_percepciones' => $val['total_percepciones'],
                            'descuentos_fijos' => $val['descuentos_fijos'],
                            'otros_descuentos' => $val['otros_descuentos']
                            
                        );
            
            $this->db->where('id',$datos['retenciones']->id);
            $this->db->update('nomina_retenciones',$newA);
            $this->session->set_flashdata('msg_success', 'El Registro ha sido Guardado');
            
        }
   
        
        $this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina/admin",$datos);
		$this->load->view("site_footer");  
    }

	function imprimir($semana,$year,$id_empleado)
    {
        $data = array( 
			'pagina' => 'nomina'
		);
        
        $datos['retenciones'] = $this->Procesos_Nomina->retenciones($semana,$year,$id_empleado);
        $datos['empleado'] = $this->Procesos_Nomina->datos_empleado($id_empleado);

        $id = $datos['retenciones']->id;

        $datos['nomina_descuentos'] = $this->Procesos_Nomina->descuentos($id);
        
        $this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina/imprimir",$datos);
		$this->load->view("site_footer"); 
    }
    
    function imprimir_pintura($semana,$year,$id_empleado)
    {
        $data = array( 
			'pagina' => 'nomina'
		);
        
        $datos['retenciones'] = $this->Procesos_Nomina->retenciones($semana,$year,$id_empleado);
        $datos['empleado'] = $this->Procesos_Nomina->datos_empleado($id_empleado);
        $datos['pintura'] = $this->Procesos_Nomina->pintura($id_empleado,$semana,$year);

        $id = $datos['retenciones']->id;

        $datos['nomina_descuentos'] = $this->Procesos_Nomina->descuentos($id);
        
        $this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina/imprimir_pintura",$datos);
		$this->load->view("site_footer"); 
    }

    function borrar($tabla,$id)
    {
        $this->db->where('id',$id);
        $this->db->delete($tabla);

    }

    function actualizar($tabla,$id,$valor)
    {
        $this->db->set('visible',$valor);
        $this->db->where('id',$id);
        $this->db->update($tabla);

    }
	
	
		
}



?>