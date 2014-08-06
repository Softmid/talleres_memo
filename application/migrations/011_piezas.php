<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_piezas extends CI_Migration {
	
	//agregamos piezas a la tabla de relacion de trabajo solicitado

	public function up()
	{
		$fields = array(
            "`piezas` DECIMAL(2,1) DEFAULT NULL",

		);
		$this->dbforge->add_column('rel_monto_servicios', $fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('rel_monto_servicios', 'piezas');
		



	}

}