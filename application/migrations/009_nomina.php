<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_nomina extends CI_Migration {
	
	//agregamos un nuevo monto a los tipos de trabajos en la tabla de relCategorias

	public function up()
	{
		$fields = array(
					"`id` int(11) NOT NULL AUTO_INCREMENT",
					"`id_empleado` int(11) DEFAULT NULL",
					"`id_orden` int(11) DEFAULT NULL",
					"`hyp` decimal(10,2) DEFAULT NULL",
					"`30_percent` decimal(10,2) DEFAULT NULL",
					"`pago_pintores` decimal(10,2) DEFAULT '320.00'",
					"`pago_estetico` decimal(10,2) DEFAULT NULL",
					"`pago_hojalatero` decimal(10,2) DEFAULT NULL",
					"`sugerencia` varchar(255) DEFAULT NULL",
					"`pago_percent` varchar(255) DEFAULT NULL",
					"`avance` varchar(255) DEFAULT NULL",
					"`anticipo` varchar(255) DEFAULT NULL",
					"`pago` varchar(255) DEFAULT NULL",
					"`tipo_de_pago` varchar(255) DEFAULT NULL",
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('nomina', TRUE);
		$this->db->simple_query('ALTER TABLE  `caracteristicas` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');
	
	}

	public function down()
	{
		$this->dbforge->drop_table('nomina');
		
	

	}

}