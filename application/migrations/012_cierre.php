<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_cierre extends CI_Migration {
	
	//agregamos la tabla de nomina

	public function up()
	{
		$fields = array(
            "`id` int(11) unsigned NOT NULL AUTO_INCREMENT",
            "`id_vehiculo` int(11) DEFAULT NULL",
            "`id_orden` int(11) DEFAULT NULL",
            "`observaciones` varchar(250) DEFAULT ''",
            "`comision` decimal(11,4) DEFAULT NULL",
            "`total_valuacion` decimal(11,4) DEFAULT NULL",
            "`valuacion_refacciones` decimal(11,4) DEFAULT NULL",
            "`pago_refacciones` decimal(11,4) DEFAULT NULL",
            "`valuacion_TOT` decimal(11,4) DEFAULT NULL",
            "`pago_TOT` decimal(11,4) DEFAULT NULL",
            "`valuacion_mecanica` decimal(11,4) DEFAULT NULL",
            "`mecanica_30` decimal(11,4) DEFAULT NULL",
            "`pago_mecanica` decimal(11,4) DEFAULT NULL",
            "`valuacion_HP` decimal(11,4) DEFAULT NULL",
            "`HP_30` decimal(11,4) DEFAULT NULL",
            "`total_piezas` decimal(11,4) DEFAULT NULL",
            "`pago_pintura` decimal(11,4) DEFAULT NULL",
            "`pago_pulida` decimal(11,4) DEFAULT NULL",
            "`pago_herreria` decimal(11,4) DEFAULT NULL",
            "`hojalateria` decimal(11,4) DEFAULT NULL",
            "`pago_hojalateria` decimal(11,4) DEFAULT NULL",
            "`valuacion_estetica` decimal(11,4) DEFAULT NULL",
            "`estetica_30` decimal(11,4) DEFAULT NULL",
            "`pago_estetica` decimal(11,4) DEFAULT NULL",
            "`suma_total` decimal(11,4) DEFAULT NULL",
            "`utilidad` decimal(11,4) DEFAULT NULL",
            "`percent_utilidad` decimal(11,4) DEFAULT NULL",
            "`valuacion_total` decimal(11,4) DEFAULT NULL"
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('cierre', TRUE);
		$this->db->simple_query('ALTER TABLE  `cierre` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');
	
	}

	public function down()
	{
		$this->dbforge->drop_table('cierre');
		
	

	}

}