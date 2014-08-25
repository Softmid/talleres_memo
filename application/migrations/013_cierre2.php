
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_cierre2 extends CI_Migration {
	
	//agregamos el campo de guardado a el cierre para que no se vuelva a modificar

	public function up()
	{
		$fields = array(

			'guardado' => array('type' => 'TINYINT','constraint' => '1','DEFAULT' => '0')
		);
		$this->dbforge->add_column('cierre', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('cierre', 'guardado');

	}

}