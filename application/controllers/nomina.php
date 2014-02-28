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


	
	public function ver_nomina()
	{
		
		$data = array( 
			'pagina' => 'nomina'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina");
		$this->load->view("site_footer");
	}

	public function ver_orden()
	{
		
		$id_orden = $this->input->post('num_orden');

		$orden['orden'] = $this->Procesos_Nomina->nomina($id_orden);
		$orden['empleados'] = $this->Procesos_Empleado->ver();
		
		$data = array( 
			'pagina' => 'nomina'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav",$data);
		$this->load->view("nomina",$orden);
		$this->load->view("site_footer");

	}

	public function agregar_nomina()
	{	
		$data['nomina'] = array(
			'id_empleado' => $this->input->post('id_empleado'),
			'id_orden' => $this->input->post('id_orden'),
			'hyp' => $this->input->post('hyp'),
			'30_percent' => $this->input->post('30_percent'),
			'pago_pintores' => $this->input->post('pago_pintores'),
			'pago_estetico' => $this->input->post('pago_estetico'),
			'pago_hojalatero' => $this->input->post('pago_hojalatero'),
			'sugerencia' => $this->input->post('sugerencia'),
			'pago_percent' => $this->input->post('pago_percent'),
			'avance' => $this->input->post('avance'),
			'anticipo' => $this->input->post('anticipo'),
			'pago' => $this->input->post('pago'),
			'tipo_de_pago' => $this->input->post('tipo_de_pago')

			);

		$this->Procesos_Nomina->insertar_nomina($data['nomina']);

	}	
	
		
}



?>