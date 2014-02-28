<?php 

class Procesos_Nomina extends CI_Model {

	public function nomina($id)
	{
		$query = $this->db->query("SELECT * FROM orden LEFT JOIN nomina on nomina.id_orden=orden.idOrdenes WHERE clave = '$id'");
		return $query;
	}


	public function empleados()
	{
		$query = $this->db->query("SELECT * FROM empleados");
		return $query;
	}

	public function insertar_nomina($data)
	{
		$insert = $this->db->insert('nomina',$data);
	}
	

}

?>
