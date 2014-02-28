<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_parte2 extends CI_Migration {
	
	//agregamos RFC,direccion y celular a la tabla de ordenes

	public function up()
	{
		$fields = array(
			'rfc' => array('type' => 'TEXT','constraint' => '50'),
			'direccion' => array('type' => 'TEXT','constraint' => '200'),
			'celular' => array('type' => 'TEXT','constraint' => '50'),
			'empresa' => array('type' => 'TEXT','constraint' => '100'),
			'telefono' => array('type' => 'TEXT','constraint' => '50'),
			'cliente' => array('type' => 'TEXT','constraint' => '100'),
			'correo' => array('type' => 'TEXT','constraint' => '100')
		);
		$this->dbforge->add_column('orden', $fields);

		//copiar los datos de las siguientes columnas de vehiculo a orden
		$this->db->simple_query("UPDATE orden JOIN vehiculo SET orden.empresa = vehiculo.empresa WHERE vehiculo.idVehiculo = orden.idVehiculo");
		$this->db->simple_query("UPDATE orden JOIN vehiculo SET orden.telefono = vehiculo.telefono WHERE vehiculo.idVehiculo = orden.idVehiculo");
		$this->db->simple_query("UPDATE orden JOIN vehiculo SET orden.cliente = vehiculo.cliente WHERE vehiculo.idVehiculo = orden.idVehiculo");
		$this->db->simple_query("UPDATE orden JOIN vehiculo SET orden.correo = vehiculo.correo WHERE vehiculo.idVehiculo = orden.idVehiculo");

		//borrar los campos de vehiculo que se copiaron
		$this->dbforge->drop_column('vehiculo', 'empresa');
		$this->dbforge->drop_column('vehiculo', 'telefono');
		$this->dbforge->drop_column('vehiculo', 'cliente');
		$this->dbforge->drop_column('vehiculo', 'correo');
	}

	public function down()
	{
		$this->dbforge->drop_column('orden', 'rfc');
		$this->dbforge->drop_column('orden', 'direccion');
		$this->dbforge->drop_column('orden', 'celular');
		$this->dbforge->drop_column('orden', 'empresa');
		$this->dbforge->drop_column('orden', 'telefono');
		$this->dbforge->drop_column('orden', 'cliente');
		$this->dbforge->drop_column('orden', 'correo');

		$fields = array(
			'correo' => array('type' => 'TEXT','constraint' => '100'),
			'empresa' => array('type' => 'TEXT','constraint' => '100'),
			'cliente' => array('type' => 'TEXT','constraint' => '100'),
			'telefono' => array('type' => 'INT','constraint' => '50')
		);
		$this->dbforge->add_column('vehiculo', $fields);


	}

}