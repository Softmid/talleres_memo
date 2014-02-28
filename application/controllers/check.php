<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {

		public function check_username()
	{	
		$data = array(	
		'username' => $username = $this->input->post('username')
		);
		
		$this->load->model('Validacion');
		$this->Validacion->check_username($data);
			
		
	}
	public function check_vin()
	{	
		$data = array(	
		'vin' => $username = $this->input->post('vin')
		);
		
		$this->load->model('Validacion');
		$this->Validacion->check_vin($data);
			
		
	}
	
	public function check_numSerie()
	{	
		$data = array(	
		'num_serie' => $username = $this->input->post('num_serie')
		);
		
		$this->load->model('Validacion');
		$this->Validacion->check_numSerie($data);
			
		
	}

	
	
		
}



?>