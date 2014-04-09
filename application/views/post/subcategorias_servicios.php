<select name="subcategoria_servicio" id="subcat_servicio">
	<option value=""></option>
	<? foreach ($subcat->result() as $dataSub) { 

		echo '<option value="'.$dataSub->idSubcategorias.'">'.$dataSub->nombre.'</option>';
		
	
	}
	?>
</select>

