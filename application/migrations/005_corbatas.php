
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_corbatas extends CI_Migration {
	
	//agregamos tipos de trabajos en la tabla de relCategorias

	public function up()
	{
		$fields = array(
			'sustituir' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0'),
			'reparar' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0'),
			'retoque' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0'),
			'pintura' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0'),
			'estetica' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0'),
			'otros' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0'),


		);
		$this->dbforge->add_column('relcategorias', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('relcategorias', 'sustituir');
		$this->dbforge->drop_column('relcategorias', 'reparar');
		$this->dbforge->drop_column('relcategorias', 'retoque');
		$this->dbforge->drop_column('relcategorias', 'pintura');
		$this->dbforge->drop_column('relcategorias', 'estetica');
		$this->dbforge->drop_column('relcategorias', 'otros');

	}

}