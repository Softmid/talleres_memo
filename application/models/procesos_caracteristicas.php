<?php 

class Procesos_Caracteristicas extends CI_Model {

	public function caracteristicas()
	{
		$query = $this->db->query("SELECT * FROM caracteristicas");
		return $query;
	}
	
	public function caracteristicasRelacion($id,$idOrden)
	{
		$query = $this->db->query("SELECT *,(SELECT TRUE FROM relcaracteristica WHERE 
caracteristicas.idCaracteristica = relcaracteristica.idCaracteristica  AND idOrden = '$idOrden' Limit 1 ) 
AS checked FROM caracteristicas");
		return $query;
	}
	
	function agregar($data)
	{
		$this->db->insert('caracteristicas', $data);
	}
	
	function eliminar($data) 
	{	
			$this->db->delete('caracteristicas',$data);
		
	}
	function agregarRelacion($data) 
	{		
		$this->db->insert('relcaracteristica', $data);
	}
	
	function eliminarRelacion($data) 
	{	
			$this->db->delete('relcaracteristica',$data);
		
	}

}

?>
