<select name="subcategoria" id="subcategoria">
   <option value="">Seleccione una Sub-Categoría</option>
   <?php
   		foreach($subcategorias->result() as $subcategoria)
		{
			echo '<option value="'.$subcategoria->idSubcategorias.'">'.$subcategoria->nombre.'</option>';
		}
   ?>
</select>