<?php

class Procesos_Categorias extends CI_Model {

	
	/* categoria */
	
	function categorias()
	{
		$query = $this->db->query("select * from categorias WHERE visible = '1'");
		return $query;
	}
	
	function subCategorias($id)
	{
		$query = $this->db->query("select * from subcategorias where idCategoria = ".$id."");
		return $query;
	}
	
	function agregar_categoria($data)
	{
		$this->db->insert('categorias', $data['categoria']);
	}
	
	function agregar_subCategoria($data)
	{
		$this->db->insert('subcategorias', $data['subcategoria']);
	}
	
	function eliminarCategoria($data) 
	{	
		$query = $this->db->query("select * from propiedades where idCategoria = ".$data['idCategorias']."");
		if($query->num_rows() > 0)
		{	
			$update = array(
				'visible' => '0'
			);
			$this->db->where('idCategoria', $data['idCategorias']);
			$this->db->update('subcategorias', $update);
			$this->db->where('idCategorias', $data['idCategorias']);
			$this->db->update('categorias', $update);
		}
		else
		{			
			$this->db->where('idCategoria', $data['idCategorias']);
			$this->db->delete('subcategorias');
			$this->db->delete('categorias',$data);
		}
	}
	
	function eliminarSubCategoria($data) 
	{	
		$query = $this->db->query("select * from propiedades where idSubcategoria = ".$data['idSubcategorias']."");
		if($query->num_rows() > 0)
		{	
			$update = array(
				'visible' => '0'
			);
			$this->db->where('idSubcategorias', $data['idSubcategorias']);
			$this->db->update('subcategorias', $update);
		}
		else
		{
			$this->db->where('idSubcategorias', $data['idSubcategorias']);
			$this->db->delete('subcategorias');
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
		$this->db->update('categorias', $update);
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

	function rel_categoria($id)
	{
		$query = $this->db->query("SELECT * FROM relcategorias WHERE idOrden='$id'");
		return $query;
	}


}

?>