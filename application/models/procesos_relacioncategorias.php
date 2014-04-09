<?php

class Procesos_relacionCategorias extends CI_Model {

	
	/* categoria */
	
	


	function verCategorias($idVehiculo,$idOrden)
	{
		$query = $this->db->query("SELECT distinct(select nombre from categorias where relcategorias.idCategoria = categorias.idCategorias) as nombre, idCategoria FROM relcategorias WHERE  idOrden = '$idOrden'");
		return $query;
	}
	function eliminarRelacion($idRel)
	{	
		$this->db->where('idRel',$idRel);
		$query = $this->db->delete("relcategorias");
			
	}

	function actualizarCorbata($data,$id) 
	{	
		$this->db->where('idRel', $id);	
		$this->db->update('relcategorias', $data);
	}
	
	

	function actualizar($idOrden,$data)
	{
		$this->db->where('idordenes',$idOrden);
		$query = $this->db->update('orden',$data);
		return $query;
	}


	
}


?>