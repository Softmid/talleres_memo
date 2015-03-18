<?php 

class Procesos_Usuario extends CI_Model {

	function agregar_usuarios($data) 
	{	
		$this->db->insert('usuarios',$data);
	}
	
	function verUsuarios()
	{
		$query = $this->db->query('SELECT * FROM usuarios WHERE privilegios !=1;');
		return $query;
	}
	
		function eliminarUsuario($data) 
	{	
		$this->db->where($data['id']);
		$this->db->update('usuarios',$data['update']);
	}
	
	function verUsuarioMod($id)
	{
		$query = $this->db->query('SELECT * FROM usuarios Where idUsuarios = '.$id.';');
		return $query;
	}
	
	function modUsuario($data)
	{
		$this->db->where("idUsuarios", $data['id']['idUsuarios']); 
		$this->db->update('usuarios', $data['update']);
		if($this->db->affected_rows() > 0)
		{
			return 'Exitoso';
		}
		else
		{
			return 'Un fallo, inténtelo de nuevo';
		}
	}

}

?>
