<?php 

class Procesos_GastosFijos extends CI_Model {

	function agregar_gastosFijos($data) 
	{		
		$this->db->insert('gastos_fijos',$data);
	}
	
	function ver_gastoFijo($ini, $fin)
	{
		$query = $this->db->query("SELECT * FROM gastos_fijos as gas Join usuarios as user on (gas.idUsuario = user.idUsuarios ) WHERE fecha_hora BETWEEN '$ini' AND '$fin' Order by fecha_hora");
		return $query;
	}

}

?>
