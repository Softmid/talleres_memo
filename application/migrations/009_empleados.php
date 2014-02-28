
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_empleados extends CI_Migration {
	
	//agregamos el campo de privilegios a la tabla de empleados

	public function up()
	{
		$fields = array(

			'privilegios' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0')
		);
		$this->dbforge->add_column('empleados', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('empleados', 'privilegios');

	}

}