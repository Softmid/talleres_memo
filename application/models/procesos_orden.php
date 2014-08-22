<?php 

class Procesos_Orden extends CI_Model {

	function agregarOrden($data) 
	{
		$this->db->insert('orden',$data['orden']);
		$idOrden = $this->db->insert_id();
		return $idOrden;
	}
    
    function agregar_cierre($data) 
	{
		$this->db->insert('cierre',$data);
	}
    
    function update_cierre($data,$id) 
	{  
        $this->db->where("id_orden",$id);
		$this->db->update('cierre',$data);
	}
	
	
	function verOrden($id)
	{
		
		$query = $this->db->query("SELECT * FROM orden WHERE idOrdenes = '$id'");
		return $query;
	}
    
    function search_cierre($id)
	{
		
		$query = $this->db->query("SELECT * FROM cierre WHERE id_orden = '$id'");
		return $query;
	}
    
    
	function usar_corbata($id)
	{
		
		$query = $this->db->query("UPDATE orden SET corbata=1 WHERE idOrdenes = '$id'");
		return $query;
	}
    
    function sumar_piezas($id)
	{
		
		$query = $this->db->query("SELECT SUM(piezas) as suma_piezas FROM rel_monto_servicios WHERE id_orden = '$id'");
		return $query;
	}
    
    function sumar_montos($id,$id_orden)
	{
		
		$query = $this->db->query("SELECT SUM(monto) as suma_montos FROM rel_monto_servicios WHERE id_categoria = '$id' AND id_orden = '$id_orden'");
		return $query;
	}
    
    function search_id($nombre)
	{
		
		$query = $this->db->query("SELECT idCategorias FROM categorias_servicios WHERE nombre = '$nombre'");
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