<?php 

class Procesos_Vehiculo extends CI_Model {

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

	
	function verVehiculo($min,$per_page)
	{
		$query = $this->db->query("SELECT *, (select sum(monto) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as gastos,(select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero from vehiculo join orden on vehiculo.idVehiculo = orden.idVehiculo where orden.finalizado = 0 and orden.cancelado = 0 AND orden.presupuesto = 0 ORDER BY orden.clave DESC LIMIT $min,$per_page");
		return $query;
	}

	function countVehiculo()
	{

		$query = $this->db->query("SELECT *, (select sum(monto) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as gastos,(select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero from vehiculo join orden on vehiculo.idVehiculo = orden.idVehiculo where orden.finalizado = 0 and orden.cancelado = 0 AND orden.presupuesto = 0 ORDER BY vehiculo.idVehiculo DESC ");
		$numero = $query->num_rows();
		return $numero;
	}

	
	function verVehiculoMod($id)
	{
		$query = $this->db->query('SELECT * FROM vehiculo Where vehiculo.idVehiculo = '.$id.' ;');
		return $query;
	}

	function verVehiculoAjax($text)
	{
		$query = $this->db->query("SELECT *,(select sum(monto) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as gastos, (select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero from vehiculo join orden on vehiculo.idVehiculo = orden.idVehiculo WHERE (orden.finalizado = 0 AND orden.cancelado = 0 AND orden.presupuesto = 0)  AND orden.clave LIKE '%".$text."%' OR vehiculo.marca LIKE '%".$text."%' OR vehiculo.modelo LIKE '%".$text."%' OR vehiculo.color LIKE '%".$text."%' OR vehiculo.year LIKE '%".$text."%'");
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
		$query = $this->db->query("SELECT * FROM vehiculo where idVehiculo = ".$id."");
		return $query;
	}
	
	
	
	function idOrdenGastos($id)
	{
		$query = $this->db->query("SELECT *, (select nombre from categorias where categorias.idCategorias = gastos_vehiculo.idCategoria) as nombre_categoria, (select nombre from subcategorias where subcategorias.idSubcategorias = gastos_vehiculo.idSubcategoria) as nombre_subcategoria from gastos_vehiculo where idOrden = ".$id."");
		return $query;
	}
	function idOrden($id)
	{
		$query = $this->db->query("SELECT * from orden where idOrdenes = ".$id."");
		return $query;
	}
	
	function agregar_orden($data)
	{
		$this->db->insert('gastos_vehiculo', $data['orden']);
	}
	
	function update_gasto($data, $id)
	{
		$this->db->update('gastos_vehiculo', $data['gasto'], "idGastos_Vehiculo = ".$id."");
	}
	
	function eliminarGastoVehiculo($data) 
	{		
		$this->db->delete('gastos_vehiculo',$data);
	}

	function fillFormaAgregar($data)
	{
		$query = $this->db->query("SELECT * FROM vehiculo WHERE num_VIN = '$data' ");
		return $query;
	}
	
	
	/* categoria */
	
	function categorias()
	{
		$query = $this->db->query("select * from categorias");
		return $query;
	}
	
	function subCategorias($id)
	{
		$query = $this->db->query("select * from subcategorias where idCategoria = ".$id."");
		return $query;
	}
	
	function agregar_categoria($data)
	{
		$this->db->insert('categorias', $data['categoria']);
	}
	
	function agregar_subCategoria($data)
	{
		$this->db->insert('subcategorias', $data['subcategoria']);
	}
	
	function eliminarCategoria($data) 
	{	
		$query = $this->db->query("select * from gastos_vehiculo where idCategoria = ".$data['idCategorias']."");
		if($query->num_rows() > 0)
		{ 	
			$update = array(
				'visible' => '0'
			);
			$this->db->where('idCategoria', $data['idCategorias']);
			$this->db->update('subcategorias', $update);
			$this->db->where('idCategorias', $data['idCategorias']);
			$this->db->update('categorias', $update);
		}
		else
		{			
			$this->db->where('idCategoria', $data['idCategorias']);
			$this->db->delete('subcategorias');
			$this->db->delete('categorias',$data);
		}
	}
	
	function eliminarSubCategoria($data) 
	{	
		$query = $this->db->query("select * from gastos_vehiculo where idSubcategoria = ".$data['idSubcategorias']."");
		if($query->num_rows() > 0)
		{	
			$update = array(
				'visible' => '0'
			);
			$this->db->where('idSubcategorias', $data['idSubcategorias']);
			$this->db->update('subcategorias', $update);
		}
		else
		{
			$this->db->where('idSubcategorias', $data['idSubcategorias']);
			$this->db->delete('subcategorias');
		}
	}
	
	function desactiverCategoria($data, $tipo)
	{
		if($tipo == 1)
		{
			$update = array(
				'visible' => '1'
			);
		}
		else
		{
			$update = array(
				'visible' => '0'
			);
		}
		$this->db->where('idCategoria', $data['idCategorias']);
		$this->db->update('subcategorias', $update);
		$this->db->where('idCategorias', $data['idCategorias']);
		$this->db->update('categorias', $update);
	}
	
	function desactiverSubCategoria($data, $tipo)
	{
		if($tipo == 1)
		{
			$update = array(
				'visible' => '1'
			);
		}
		else
		{
			$update = array(
				'visible' => '0'
			);
		}
		$this->db->where('idSubcategorias', $data['idSubcategorias']);
		$this->db->update('subcategorias', $update);
	}

	function entregarVehiculo($idOrden,$datos)
	{
	
			$this->db->where('idOrdenes',$idOrden);
			$this->db->update('orden',$datos);
		
		
	}
}

?>
