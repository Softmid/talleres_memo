
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_corbata4 extends CI_Migration {
	
	//agregamos un nuevo monto a los tipos de trabajos en la tabla de relCategorias

	public function up()
	{
		$fields = array(
			'piezas' => array('type' => 'DECIMAL','constraint' => '10,1','DEFAULT' => '0'),
			'pago_pintores' => array('type' => 'DECIMAL','constraint' => '10,2','DEFAULT' => '320'),
			'corbata' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0')
		);
		$this->dbforge->add_column('orden', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('orden', 'piezas');
		$this->dbforge->drop_column('orden', 'pago_pintores');
		$this->dbforge->drop_column('orden', 'corbata');
		
	

	}

}