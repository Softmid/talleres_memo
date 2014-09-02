
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_cierre4 extends CI_Migration {
	
	//agregamos nuevos campos para aseguradora en el cierre

	public function up()
	{
		$fields = array(

			'valuacion_herreria' => array('type' => 'DECIMAL','constraint' => '11,4'),
			'herreria_30' => array('type' => 'DECIMAL','constraint' => '11,4'),
			'pago_hojalateria_aseguradora' => array('type' => 'DECIMAL','constraint' => '11,4'),
		
		);
		$this->dbforge->add_column('cierre', $fields);
	
	}

	public function down()
	{
		$this->dbforge->drop_column('cierre', 'valuacion_herreria');
		$this->dbforge->drop_column('cierre', 'herreria_30');
		$this->dbforge->drop_column('cierre', 'pago_hojalateria_aseguradora');
		

	}

}