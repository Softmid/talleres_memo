<?php 

class Procesos_Reportes extends CI_Model {

	function ver_reporteFechas($ini,$fin)
	{
		$inicio = $ini.' 00:00:00';
		$final = $fin.' 23:59:59';

		$query = $this->db->query("SELECT * from vehiculo join orden on vehiculo.idVehiculo = orden.idVehiculo WHERE orden.fechaFinal >= '$inicio' AND orden.fechaFinal <= '$final' AND orden.finalizado = '1' Order by orden.clave");
		return $query;
	}

	function vehiculos_finalizados($ini,$fin)
	{
		$inicio = $ini.' 00:00:00';
		$final = $fin.' 23:59:59';

		$query = $this->db->query("SELECT count(*) as vehiculosFinalizados from vehiculo join orden on vehiculo.idVehiculo = orden.idVehiculo WHERE orden.fechaFinal >= '$inicio' AND orden.fechaFinal <= '$final' AND orden.finalizado = '1' Order by orden.clave");
		return $query;
	}

	function gastoFijo($ini, $fin)
	{
		$inicio = $ini.' 00:00:00';
		$final = $fin.' 23:59:59';

		$query = $this->db->query("SELECT SUM(gas.monto) as total FROM gastos_fijos as gas Join usuarios as user on (gas.idUsuario = user.idUsuarios ) WHERE fecha_hora >= '$inicio' AND fecha_hora <= '$final'");
		return $query;
	}

	
	function ver_reporteCategorias($id,$cat,$subCat)
	{
		$query = $this->db->query("SELECT SUM(gas.monto) as total FROM gastos_vehiculo AS gas JOIN categorias as cat on gas.idCategoria = cat.idCategorias JOIN subcategorias as sub on gas.idSubcategoria = sub.idSubcategorias WHERE gas.idOrden = '$id' AND cat.nombre = '$cat' AND sub.nombre = '$subCat' Limit 1");
		return $query;
	}

	function ver_ordenVehiculo($id)
	{
		$query = $this->db->query("SELECT * FROM orden WHERE idOrdenes = '$id' Limit 1");
		return $query;
	}
	
		function ver_headerCat()
	{
		$query = $this->db->query("SELECT * FROM categorias");
		return $query;
	}
	
	function ver_headerSubcat($idCat)
	{
		$query = $this->db->query("SELECT * FROM subcategorias WHERE idCategoria = '$idCat'");
		return $query;
	}
	
	
	function ver_reporteGastos($ini,$fin)
	{
		$inicio = $ini.' 00:00:00';
		$final = $fin.' 23:59:59';

		$query = $this->db->query("SELECT * FROM gastos_fijos as gas Join usuarios as user on (gas.idUsuario = user.idUsuarios ) WHERE fecha_hora >= '$inicio' AND fecha_hora <= '$final' Order by fecha_hora");
		return $query;
	}

	
}