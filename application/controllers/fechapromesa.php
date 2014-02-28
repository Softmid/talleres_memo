<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FechaPromesa extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'/login');
		}
		
		
	}
	
	
	public function ver_fechaPromesa()
	{
		$this->load->model('Procesos_FechaPromesa');
		$data['atrasado'] = $this->Procesos_FechaPromesa->verFechaPromesaAtrasada();
		$data['hoy'] = $this->Procesos_FechaPromesa->verFechaPromesaHoy();
		$data['tomorrow'] = $this->Procesos_FechaPromesa->verFechaPromesaTomorrow();
		$data['afterTomorrow'] = $this->Procesos_FechaPromesa->verFechaPromesaNextDay();



		$nav = array(
			'pagina' => 'fechaPromesa'
		);

		$this->load->view("site_header");
		$this->load->view("site_nav", $nav);
		$this->load->view("fechapromesa", $data);
		$this->load->view("site_footer");
	}
	
	
	
	
	
}
