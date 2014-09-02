
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_cierre3 extends CI_Migration {
	
	//agregamos nuevos campos para aseguradora en el cierre

	public function up()
	{
		$fields = array(

			'valuacion_HPMH' => array('type' => 'DECIMAL','constraint' => '11,4'),
			'HPMH_30' => array('type' => 'DECIMAL','constraint' => '11,4'),
			'sugerencia_herreria' => array('type' => 'DECIMAL','constraint' => '11,4'),
			'sugerencia_mecanica' => array('type' => 'DECIMAL','constraint' => '11,4'),
			'sugerencia_hojalateria' => array('type' => 'DECIMAL','constraint' => '11,4')
		);
		$this->dbforge->add_column('cierre', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('cierre', 'valuacion_HPMH');
		$this->dbforge->drop_column('cierre', 'HPMH_30');
		$this->dbforge->drop_column('cierre', 'sugerencia_herreria');
		$this->dbforge->drop_column('cierre', 'sugerencia_mecanica');
		$this->dbforge->drop_column('cierre', 'sugerencia_hojalateria');

	}

}