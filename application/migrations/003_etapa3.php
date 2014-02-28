<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_etapa3 extends CI_Migration {
	
	//agregamos RFC,direccion y celular a la tabla de ordenes

	public function up()
	{
		$fields = array(
			'dedusible' => array('type' => 'TEXT','constraint' => '100'),
			'fechaSiniestro' => array('type' => 'DATETIME'),
			'numeroPoliza' => array('type' => 'INT','constraint' => '50'),
			'numeroReporte' => array('type' => 'TEXT','constraint' => '50'),
			'aseguradora' => array('type' => 'TINYINT','constraint' => '1'),
			'entregado' => array('type' => 'TINYINT','constraint' => '1'),
			'fecha_vehiculoEntregado' => array('type' => 'DATETIME')


		);
		$this->dbforge->add_column('orden', $fields);

		$this->dbforge->drop_column('relcaracteristica', 'idVehiculo');
		$this->dbforge->drop_column('relcategorias', 'idVehiculo');

	}

	public function down()
	{
		$this->dbforge->drop_column('orden', 'dedusible');
		$this->dbforge->drop_column('orden', 'fechaSiniestro');
		$this->dbforge->drop_column('orden', 'numeroPoliza');
		$this->dbforge->drop_column('orden', 'numeroReporte');
		$this->dbforge->drop_column('orden', 'aseguradora');
		$this->dbforge->drop_column('orden', 'entregado');
		$this->dbforge->drop_column('orden', 'fecha_vehiculoEntregado');



	}

}