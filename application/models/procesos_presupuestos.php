<?php 

class Procesos_Presupuestos extends CI_Model {
function agregar_vehiculo($data) 
	{
		function associative_push($arr, $tmp) 
		{
			if (is_array($tmp)) {
			foreach ($tmp as $key => $value) { 
			  $arr[$key] = $value;
			}
			return $arr;
			}
			return false;
		}
		
		$this->db->insert('vehiculo',$data['vehiculo']);
		$id_vehiculo = $this->db->insert_id();
		$aux = array(
			'idVehiculo' => $id_vehiculo
		);
		$theArray = associative_push($data['orden'], $aux);

		$this->db->insert('orden', $theArray);
		$idOrden = $this->db->insert_id();

		$back = array(
			'idVehiculo' => $id_vehiculo,
			'idOrden' => $idOrden
		);

		return $back;
	}
	
	function verVehiculo()
	{
		$query = $this->db->query("SELECT *, (select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero from vehiculo join orden on vehiculo.idVehiculo = orden.idVehiculo where orden.finalizado = 0 AND cancelado = 0 AND presupuesto='1' ORDER BY idOrdenes DESC");
		return $query;
	}
	
	function verVehiculoMod($id)
	{
		$query = $this->db->query('SELECT * FROM vehiculo Where idVehiculo = '.$id.';');
		return $query;
	}
	
	function modVehiculo($data)
	{
		$this->db->where("idVehiculo", $data['id']['idVehiculo']); 
		$this->db->update('vehiculo', $data['update']);
		

		
		if($this->db->affected_rows() > 0)
		{
			return 'Exitoso';
		}
		else
		{
			return 'Un fallo, inténtelo de nuevo';
		}
	}
	
	function eliminarVehiculo($data) 
	{		
		$this->db->delete('vehiculo',$data);
	}
	
	function verVehiculoGasto($id)
	{
		$query = $this->db->query("SELECT vehiculo.marca, vehiculo.modelo, vehiculo.color, (select idOrdenes from orden where vehiculo.idVehiculo = orden.idVehiculo and (finalizado = 0 and cancelado = 0)) as idOrdenes, (select monto from orden where vehiculo.idVehiculo = orden.idVehiculo and (finalizado = 0 and cancelado = 0)) as monto_vehiculo FROM vehiculo where idVehiculo = ".$id."");
		return $query;
	}
	
	function idVehiculoOrden($id)
	{
		$query = $this->db->query("select idOrdenes from orden where idVehiculo = ".$id." and (finalizado = 0 and cancelado = 0)");
		$row = $query->row();
		return $row->idOrdenes;
	}
	
	function idOrdenGastos($id)
	{
		$query = $this->db->query("select *, (select nombre from categorias where categorias.idCategorias = gastos_vehiculo.idCategoria) as nombre_categoria, (select nombre from subcategorias where subcategorias.idSubcategorias = gastos_vehiculo.idSubcategoria) as nombre_subcategoria from gastos_vehiculo where idOrden = ".$id."");
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return '<span id="no-query">No tiene Gastos</span>';
		}
	}
	
	function agregar_orden($data)
	{
		$this->db->insert('gastos_vehiculo', $data['orden']);
	}

	function fillFormaAgregar($data)
	{
		$query = $this->db->query("SELECT * FROM vehiculo WHERE num_VIN = '$data' ");
		return $query;
	}

	function cancelar($idOrden)
 	{	
 		$this->db->where('idOrdenes',$idOrden);
 		$this->db->delete('orden');

	}
	
	
	/* categoria */
	
	function categorias()
	{
		$query = $this->db->query("select * from categorias");
		return $query;
	}


	
	
	

}

?>