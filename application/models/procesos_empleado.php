<?php 

class Procesos_Empleado extends CI_Model {

	function agregar($data) 
	{	
		$this->db->insert('empleados',$data);
	}
	
	function ver()
	{
		$query = $this->db->query('SELECT * FROM empleados WHERE privilegios = 1;');
		return $query;
	}
	
		function eliminar($data) 
	{	
		$this->db->where($data['id']);
		$this->db->update('empleados',$data['update']);
	}
	
	function verMod($id)
	{
		$query = $this->db->query('SELECT * FROM empleados Where idEmpleado = '.$id.';');
		return $query;
	}
	
	function mod($data)
	{
		$this->db->where("idEmpleado", $data['id']['idEmpleado']); 
		$this->db->update('empleados', $data['update']);
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
