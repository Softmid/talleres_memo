<?php 

class Procesos_Orden extends CI_Model {

	function agregarOrden($data) 
	{
		$this->db->insert('orden',$data['orden']);
		$idOrden = $this->db->insert_id();
		return $idOrden;
	}
	
	
	function verOrden($id)
	{
		
		$query = $this->db->query("SELECT * FROM orden WHERE idOrdenes = '$id'");
		return $query;
	}
	function usar_corbata($id)
	{
		
		$query = $this->db->query("UPDATE orden SET corbata=1 WHERE idOrdenes = '$id'");
		return $query;
	}
	function obtenerClave()
	{
		
		$query = $this->db->query("SELECT clave FROM orden WHERE clave!=0 ORDER BY clave DESC LIMIT 1");
		return $query;
	}
	
	function modOrden($data)
	{
		$this->db->where("idOrdenes", $data['id']['idOrden']); 
		$this->db->update('orden', $data['orden']);
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