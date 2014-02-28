<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	
	
	public function index()
	{		
		$this->load->view("site_header");
		$this->load->view("login");
		$this->load->view("site_footer");
		
	}
	
	
	public function validarLogin() 
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('usuario','Usuario','required|trim|xss_clean|callback_validarDatos');
		$this->form_validation->set_rules('password','Contraseña','required|trim|sha1');
		
		if($this->form_validation->run())
		{
			$user = $this->input->post('usuario');
			
			$query = $this->db->query("SELECT * FROM usuarios WHERE username = '$user' LIMIT 1");
			foreach($query->result() as $row)
			
			{
				$id = $row->idUsuarios;
				$priv = $row->privilegios;
			}
			
			
			$data = array(
				'usuario' => $this->input->post('usuario'),
				'idUsuario' => $id,
				'privilegios' => $priv,
				'is_logged_in' => 1
			);
			
			$this->session->set_userdata($data);
			
			redirect('index.php/vehiculo/ver_vehiculo');
		}
		else
		{
			$this->load->view("site_header");
			$this->load->view("login");
			$this->load->view("site_footer");
		}	
	}
	
	public function validarDatos()
	{
		$this->load->model('Procesos_Login');
		
		if($this->Procesos_Login->ingresarSistema())
		{
			return true;
		}
		else
		{
			$this->form_validation->set_error_delimiters('<span class="login-error">', '</span>');
			$this->form_validation->set_message('validarDatos','Usuario o Contraseña Incorrectas');
			return false;
		}	
	}
	
	
	
	public function cerrarSesion()
	{
		$this->session->sess_destroy();
		redirect('index.php/login');
	}
		
}



?>