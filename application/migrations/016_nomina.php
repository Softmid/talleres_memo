<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_nomina extends CI_Migration {
	
	//agregamos las tablas de nomina

	public function up()
	{
		$fields = array(
            "`id` int(11) unsigned NOT NULL AUTO_INCREMENT",
            "`id_empleado` int(11) DEFAULT NULL",
            "`week` int(11) DEFAULT NULL",
            "`year` int(11) DEFAULT NULL",
            "`actualizado` tinyint(1) DEFAULT '0'",
            "`ultima_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP",
            "`fecha_inicio` date DEFAULT NULL",
            "`fecha_final` date DEFAULT NULL",
            "`saldo_anterior` decimal(12,4) DEFAULT NULL",
            "`prestamo_personal` decimal(12,4) DEFAULT NULL",
            "`prestamo_anticipo` decimal(12,4) DEFAULT NULL",
            "`descuentos_fijos` decimal(12,4) DEFAULT NULL",
            "`otros_descuentos` decimal(12,4) DEFAULT NULL",
            "`prestamo_pintura` decimal(12,4) DEFAULT NULL",
            "`anticipo_trabajo` decimal(12,4) DEFAULT NULL",
            "`abono` decimal(12,4) DEFAULT NULL",
            "`saldo_actual` decimal(12,4) DEFAULT NULL",
            "`limpieza` decimal(12,4) DEFAULT NULL",
            "`imss` decimal(12,4) DEFAULT NULL",
            "`infonavit` decimal(12,4) DEFAULT NULL",
            "`sueldo` decimal(12,4) DEFAULT NULL",
            "`comisiones` decimal(12,4) DEFAULT NULL",
            "`prestamo` decimal(12,4) DEFAULT NULL",
            "`total_percepciones` decimal(12,4) DEFAULT NULL",
            "`retardos` int(11) DEFAULT NULL",
            "`faltas` int(11) DEFAULT NULL",
            "`print_personal` tinyint(1) DEFAULT '0'",
            "`print_anticipo` tinyint(1) DEFAULT '0'",
            "`print_limpieza` tinyint(1) DEFAULT '0'",
            "`print_imss` tinyint(1) DEFAULT '0'",
            "`print_infonavit` tinyint(1) DEFAULT '0'",
            "`print_retardos` tinyint(1) DEFAULT '0'",
            "`print_faltas` tinyint(1) DEFAULT '0'",
        );

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('nomina_retenciones', TRUE);
		$this->db->simple_query('ALTER TABLE  `nomina_retenciones` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');
        
        $fields = array(
            "`id` int(11) unsigned NOT NULL AUTO_INCREMENT",
            "`id_empleado` int(11) DEFAULT NULL",
            "`id_orden` int(11) DEFAULT NULL",
            "`clave` int(11) DEFAULT NULL",
            "`week` int(11) DEFAULT NULL",
            "`year` int(11) DEFAULT NULL",
            "`preparacion` decimal(12,4) DEFAULT NULL",
            "`pintura` decimal(12,4) DEFAULT NULL",
            "`materiales` tinyint(1) DEFAULT '0'",
            "`total_pintura` decimal(12,4) DEFAULT NULL",
            "`materiales_procesivos` decimal(12,4) DEFAULT NULL",
            "`materiales_color` decimal(12,4) DEFAULT NULL",
            "`materiales_pintura` decimal(12,4) DEFAULT NULL",
            "`total_materiales` decimal(12,4) DEFAULT NULL",
            "`chk_preparacion` tinyint(1) DEFAULT '0'",
            "`chk_pintura` tinyint(1) DEFAULT '0'",

        );

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('nomina_pintura', TRUE);
		$this->db->simple_query('ALTER TABLE  `nomina_pintura` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');
	
	}

      $fields = array(
            "`id` int(11) unsigned NOT NULL AUTO_INCREMENT",
            "`id_retencion` int(11) DEFAULT NULL",
            "`concepto` varchar(200) DEFAULT NULL",
            "`valor` decimal(12,4) DEFAULT NULL",
            "`visible` tinyint(1) DEFAULT '0'",

        );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('nomina_retenciones_descuentos', TRUE);
            $this->db->simple_query('ALTER TABLE  `nomina_retenciones_descuentos` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');
      
      }

	public function down()
	{
		$this->dbforge->drop_table('nomina_retenciones');
            $this->dbforge->drop_table('nomina_pintura');
		$this->dbforge->drop_table('nomina_retenciones_descuentos');

	}

}