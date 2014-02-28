<select name="categoria" id="categoria" class="categoria-val">
    <option value="">Seleccione una Categoría</option>
    <?php
        foreach($categorias->result() as $categoria)
        {
            echo '<option value="'.$categoria->idCategorias.'">'.$categoria->nombre.'</option>';
        }
    ?>
</select>

<script type="text/javascript">
	$(function (){
		$('.categoria-val').change(function(){
			$('.resultSubCategoria').html('<img class="cargando" src="images/loading.gif"/>');
			var id = $(this).val();
			$.post('index.php/vehiculo/verSubcategoria', {id : id},  function(data){
			$('.resultSubCategoria').html(data);});
		});	
	});
</script>