<?php

class Procesos_Servicios extends CI_Model {

	function agregar($data)
	{
		$this->db->insert('servicios', $data);
	}

	function ver($idOrden)
	{
		$query = $this->db->query("SELECT * FROM servicios WHERE idOrden = '$idOrden'");
		return $query;
	}

	function ver_monto_servicio($cat='',$sub_cat='',$orden='',$id_servicio='')
	{
		$query = $this->db->query("SELECT * FROM rel_monto_servicios WHERE id_categoria = '$cat' AND id_subcategoria = '$sub_cat' AND id_orden = '$orden' AND id_servicio = '$id_servicio'");
		return $query;
	}

	function ver_suma_monto($orden='')
	{
		$query = $this->db->query("SELECT SUM(monto) AS monto_total FROM rel_monto_servicios WHERE id_orden = '$orden'");
		return $query;
	}

	function agregar_monto_servicio($data)
	{
		$this->db->insert('rel_monto_servicios', $data);
	}
	function actualizar_monto_orden($id_orden,$monto)
	{
		$this->db->where('idOrdenes',$id_orden);
		$this->db->update('orden', $monto);
	}

	function eliminar_servicios($id)
	{	
		$this->db->where('id',$id);
		$this->db->delete('servicios');
	}

	function eliminar_rel_servicios($id)
	{	
		$this->db->where('id_servicio',$id);
		$this->db->delete('rel_monto_servicios');
	}


	function actualizar_monto_servicio($cat='',$sub_cat='',$orden='',$id_servicio='',$monto='')
	{
		$this->db->where('id_categoria',$cat);
		$this->db->where('id_subcategoria',$sub_cat);
		$this->db->where('id_orden',$orden);
		$this->db->where('id_servicio',$id_servicio);
		$query = $this->db->update('rel_monto_servicios',$monto);

		return $query;

	}
	
	/* categoria */
	
	function categorias()
	{
		$query = $this->db->query("SELECT * FROM categorias_servicios WHERE visible = '1'");
		return $query;
	}
	
	function subCategorias($id)
	{
		$query = $this->db->query("SELECT * from subcategorias_servicios where idCategoria = '$id'");
		return $query;
	}

	function ver_subcategorias()
	{
		$query = $this->db->query("SELECT * from subcategorias_servicios");
		return $query;
	}
	
	function agregar_categoria($data)
	{
		$this->db->insert('categorias_servicios', $data['categoria']);
	}
	
	function agregar_subCategoria($data)
	{
		$this->db->insert('subcategorias_servicios', $data['subcategoria']);
	}
	
	function eliminarCategoria($data) 
	{	
		$query = $this->db->query("select * from servicios where id_categoria = ".$data['idCategorias']."");
		if($query->num_rows() > 0)
		{ 	
			$update = array(
				'visible' => '0'
			);
			$this->db->where('idCategoria', $data['idCategorias']);
			$this->db->update('subcategorias_servicios', $update);
			$this->db->where('idCategorias', $data['idCategorias']);
			$this->db->update('categorias_servicios', $update);
		}
		else
		{			
			$this->db->where('idCategoria', $data['idCategorias']);
			$this->db->delete('subcategorias_servicios');
			$this->db->delete('categorias_servicios',$data);
		}
	}
	
	function eliminarSubCategoria($data) 
	{	
		$query = $this->db->query("select * from servicios where id_subcategoria = ".$data['idSubcategorias']."");
		if($query->num_rows() > 0)
		{	
			$update = array(
				'visible' => '0'
			);
			$this->db->where('idSubcategorias', $data['idSubcategorias']);
			$this->db->update('subcategorias_servicios', $update);
		}
		else
		{
			$this->db->where('idSubcategorias', $data['idSubcategorias']);
			$this->db->delete('subcategorias_servicios');
		}
	}
	
	function desactiverCategoria($data, $tipo)
	{
		if($tipo == 1)
		{
			$update = array(
				'visible' => '1'
			);
		}
		else
		{
			$update = array(
				'visible' => '0'
			);
		}
		$this->db->where('idCategoria', $data['idCategorias']);
		$this->db->update('subcategorias', $update);
		$this->db->where('idCategorias', $data['idCategorias']);
		$this->db->update('categorias_servicios', $update);
	}
	
	function desactiverSubCategoria($data, $tipo)
	{
		if($tipo == 1)
		{
			$update = array(
				'visible' => '1'
			);
		}
		else
		{
			$update = array(
				'visible' => '0'
			);
		}
		$this->db->where('idSubcategorias', $data['idSubcategorias']);
		$this->db->update('subcategorias', $update);
	}


}

?>