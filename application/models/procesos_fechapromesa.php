<?php 

class Procesos_FechaPromesa extends CI_Model {

	
	function verFechaPromesaAtrasada()
	{

		date_default_timezone_set('Mexico/General');
    	$date = new DateTime('NOW');
    	$dateTime = $date->format('Y-m-d');
    	//$dateTime = $dateTime." 00:00:00"; 

		$query = $this->db->query("SELECT *,(select sum(monto) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) 
		as gastos,(select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero FROM vehiculo JOIN orden 
		on vehiculo.idVehiculo = orden.idVehiculo WHERE orden.presupuesto = 0 AND orden.fechaPromesa <'$dateTime' AND orden.entregado = '0' ORDER BY orden.fechaPromesa DESC limit 10");

		return $query;
	}
	function verFechaPromesaHoy()
	{

		date_default_timezone_set('Mexico/General');
    	$date = new DateTime('NOW');
    	$dateTime = $date->format('Y-m-d');
    	$inicio = $dateTime." 00:00:00";
    	$fin = $dateTime." 23:59:59";

		$query = $this->db->query("SELECT *,(select sum(monto) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) 
		as gastos,(select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero FROM vehiculo JOIN orden 
		on vehiculo.idVehiculo = orden.idVehiculo WHERE orden.presupuesto = 0 AND (orden.fechaPromesa >='$inicio' AND orden.fechaPromesa <='$fin') AND orden.entregado = '0' ORDER BY orden.fechaPromesa DESC limit 10");

		return $query;
	}
	function verFechaPromesaTomorrow()
	{

		date_default_timezone_set('Mexico/General');
    	$date = new DateTime('NOW');
    	$date->modify('+1 day');
    	$dateTime = $date->format('Y-m-d');
    	$inicio = $dateTime." 00:00:00";
    	$fin = $dateTime." 23:59:59";


		$query = $this->db->query("SELECT *,(select sum(monto) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) 
		as gastos,(select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero FROM vehiculo JOIN orden 
		on vehiculo.idVehiculo = orden.idVehiculo WHERE orden.presupuesto = 0 AND (orden.fechaPromesa >='$inicio' AND orden.fechaPromesa <='$fin') AND orden.entregado = '0' ORDER BY orden.fechaPromesa DESC limit 10");

		return $query;
	}
	function verFechaPromesaNextDay()
	{

		date_default_timezone_set('Mexico/General');
    	$date = new DateTime('NOW');
    	$date->modify('+2 day');
    	$dateTime = $date->format('Y-m-d');
    	$inicio = $dateTime." 00:00:00";
    	$fin = $dateTime." 23:59:59";

		$query = $this->db->query("SELECT *,(select sum(monto) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) 
		as gastos,(select count(*) from gastos_vehiculo where orden.idOrdenes = gastos_vehiculo.idOrden) as numero FROM vehiculo JOIN orden 
		on vehiculo.idVehiculo = orden.idVehiculo WHERE orden.presupuesto = 0 AND (orden.fechaPromesa >='$inicio' AND orden.fechaPromesa <='$fin') AND orden.entregado = '0' ORDER BY orden.fechaPromesa DESC limit 10");

		return $query;
	}

	
}

?>
