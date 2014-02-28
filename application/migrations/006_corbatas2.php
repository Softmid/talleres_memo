
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_corbatas2 extends CI_Migration {
	
	//agregamos montos a los tipos de trabajos en la tabla de relCategorias

	public function up()
	{
		$fields = array(
			'monto_sustituir' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '0'),
			'monto_reparar' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '0'),
			'monto_retoque' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '0'),
			'monto_pintura' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '0'),
			'monto_estetica' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '0'),
			'monto_otros' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '0'),


		);
		$this->dbforge->add_column('relcategorias', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('relcategorias', 'monto_sustituir');
		$this->dbforge->drop_column('relcategorias', 'monto_reparar');
		$this->dbforge->drop_column('relcategorias', 'monto_retoque');
		$this->dbforge->drop_column('relcategorias', 'monto_pintura');
		$this->dbforge->drop_column('relcategorias', 'monto_estetica');
		$this->dbforge->drop_column('relcategorias', 'monto_otros');

	}

}