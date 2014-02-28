<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_logged_in'))
		{
			redirect(base_url().'index.php/login');
		}
		
		
	}
	
	public function ver_usuario()
	{
		$this->load->model('Procesos_Usuario');
		$usuarios['usuarios'] = $this->Procesos_Usuario->verUsuarios();
		
		$data = array(
			'pagina' => 'usuarios'
		);
		
		$this->load->view("site_header");
		$this->load->view("site_nav", $data);
		$this->load->view("usuario", $usuarios);
		$this->load->view("site_footer");
	}
	
	
	function modificarUsuario()
	{
		$id = $this->input->post('id');
		$this->load->model('Procesos_Usuario');
		$Usuario['datos'] = $this->Procesos_Usuario->verUsuarioMod($id);
		$this->load->view("modificar_usuario", $Usuario);
	}
	
	function modUsuario()
	{	
	
	
		$password = $this->input->post('passwordMod');
		
		if($password)
		{
			if($password!=""||$password!=NULL)
			{
				$passwordCrypt = sha1($password);
				
				$data['update'] = array(
				'nombre' => $nombre = $this->input->post('nombreMod'),
				'apellido_pat' => $apellido_pat = $this->input->post('apellido_patMod'),
				'apellido_mat' => $apellido_mat = $this->input->post('apellido_matMod'),
				'username' => $username = $this->input->post('usernameMod'),
				'password' => $passwordCrypt,
				'privilegios' => $privilegios = $this->input->post('privilegiosMod')
				);
			}
		}
		
		else
		{
			$data['update'] = array(
				'nombre' => $nombre = $this->input->post('nombreMod'),
				'apellido_pat' => $apellido_pat = $this->input->post('apellido_patMod'),
				'apellido_mat' => $apellido_mat = $this->input->post('apellido_matMod'),
				'username' => $username = $this->input->post('usernameMod'),
				'privilegios' => $privilegios = $this->input->post('privilegiosMod')
				);
		}
		
		
		
		$data['id'] = array(
		'idUsuarios' => $this->input->post('idUsuarios')
		);	
		
		$this->load->model('Procesos_Usuario');
		$success = $this->Procesos_Usuario->modUsuario($data);
		echo $success;
	}
	
	
	function C_Agregar_usuario()
	{
		$password = sha1($this->input->post('password'));
		
		$data = array(
		'nombre' => $nombre = $this->input->post('nombre'),
		'apellido_pat' => $apellido_pat = $this->input->post('apellido_pat'),
		'apellido_mat' => $apellido_mat = $this->input->post('apellido_mat'),
		'username' => $username = $this->input->post('username'),
		'password' => $password,
		'privilegios' => $privilegios = $this->input->post('privilegios')
		);

		
		$this->load->model('Procesos_Usuario');
		$this->Procesos_Usuario->agregar_usuarios($data);
	}
		function C_eliminarUsuario()
	{	
		$data['id'] = array(
		'idUsuarios' => $this->input->post('id')
		);
		$data['update'] = array(
		'privilegios' => 0
		);	
		
		$this->load->model('Procesos_Usuario');
		$this->Procesos_Usuario->eliminarUsuario($data);
	}
		
}


?>