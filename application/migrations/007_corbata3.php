
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_corbata3 extends CI_Migration {
	
	//agregamos un nuevo monto a los tipos de trabajos en la tabla de relCategorias

	public function up()
	{
		$fields = array(
			'monto_mecanica' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '0'),
			'mecanica' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0'),
		);
		$this->dbforge->add_column('relcategorias', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('relcategorias', 'monto_mecanica');
		$this->dbforge->drop_column('relcategorias', 'mecanica');
	

	}

}