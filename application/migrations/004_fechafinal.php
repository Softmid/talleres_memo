<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_fechafinal extends CI_Migration {
	
	//agregamos fechaFinal en la tabla de ordenes para cada que un vehiculo se finalize

	public function up()
	{
		$fields = array(
			'fechaFinal' => array('type' => 'DATETIME')
		);
		$this->dbforge->add_column('orden', $fields);

		//copiar los datos de las siguientes columnas de vehiculo a orden
		$this->db->simple_query("UPDATE orden SET fechaFinal = fecha_hora");
	
	}

	public function down()
	{
		$this->dbforge->drop_column('orden', 'fechaFinal');

	}

}