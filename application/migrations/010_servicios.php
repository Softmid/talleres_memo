<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_servicios extends CI_Migration {
	
	

	public function up()
	{
		//tabla de servicios
		$fields = array(
				"`id` int(11) unsigned NOT NULL AUTO_INCREMENT",
				"`idOrden` int(11) DEFAULT NULL",	
				"`concepto` varchar(255) DEFAULT NULL",
				"`visible` int(1) DEFAULT '0'",
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('servicios', TRUE);
		$this->db->simple_query('ALTER TABLE  `servicios` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');

		//tabla de monto_servicio
		$fields = array(
				"`id` int(11) unsigned NOT NULL AUTO_INCREMENT",
				"`id_categoria` int(11) DEFAULT NULL",
				"`id_subcategoria` int(11) DEFAULT NULL",
				"`monto` decimal(10,2) DEFAULT NULL",
				"`activo` int(1) DEFAULT NULL",
				"`id_orden` int(11) DEFAULT NULL",
				"`id_servicio` int(11) DEFAULT NULL"
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('rel_monto_servicios', TRUE);
		$this->db->simple_query('ALTER TABLE  `rel_monto_servicios` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');

		//tabla de categorias de servicios
		$fields = array(
				"`idCategorias` int(11) NOT NULL AUTO_INCREMENT",
				"`nombre` varchar(45) DEFAULT NULL",
				"`visible` int(1) DEFAULT '1'",
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('idCategorias', TRUE);
		$this->dbforge->create_table('categorias_servicios', TRUE);
		$this->db->simple_query('ALTER TABLE  `categorias_servicios` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');

		//tabla de subcategorias de servicios
		$fields = array(
				"`idSubcategorias` int(11) NOT NULL AUTO_INCREMENT",
				"`idCategoria` varchar(45) DEFAULT NULL",
				"`nombre` varchar(45) DEFAULT NULL",
				"`visible` int(1) DEFAULT '1'",
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('idSubcategorias', TRUE);
		$this->dbforge->create_table('subcategorias_servicios', TRUE);
		$this->db->simple_query('ALTER TABLE  `subcategorias_servicios` AUTO_INCREMENT=1 DEFAULT CHARSET=utf8');
	
	}

	public function down()
	{
		$this->dbforge->drop_table('servicios');
		$this->dbforge->drop_table('rel_monto_servicios');
		$this->dbforge->drop_table('categorias_servicios');
		$this->dbforge->drop_table('subcategorias_servicios');
	}

}