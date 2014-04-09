<?php
	$count2=1;
	foreach($categorias->result() as $categoria)
	{
		if($categoria->visible == 1)
		{
			echo '<li><aside class="izquierda active"><input type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-id="'.$categoria->idCategorias.'" value="'.$categoria->idCategorias.'" checked=checked/><label for="input2-'.$count2.'">'.$categoria->nombre.'</label><li></aside><aside class="derecha"><a class="eliminar_servicios" data-id="'.$categoria->idCategorias.'">X</a></aside>';
		}
		else
		{
			echo '<li><aside class="izquierda"><input type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-id="'.$categoria->idCategorias.'" value="'.$categoria->idCategorias.'"/><label for="input2-'.$count2.'">'.$categoria->nombre.'</label><li></aside><aside class="derecha"><a class="eliminar_servicios" data-id="'.$categoria->idCategorias.'">X</a></aside>';
		}
		$count2++;
	}
?>
 <script type="text/javascript">
		$(function () {
			$('.categoria').click(function(){
				var marcado = $(this).is(":checked");
				if(marcado == true)
				{
					var id = $(this).attr('data-id');
					$.post("index.php/servicios/C_desactiverCategoria",{tipo:1, id:id});
					$(this).parent().addClass('active');
					$('#form_eliminarSubCategorias').reset();
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>');
				}
				else
				{
					var id = $(this).attr('data-id');
					$.post("index.php/servicios/C_desactiverCategoria",{tipo:0, id:id});
					$(this).parent().removeClass('active');
					$('#form_eliminarSubCategorias').reset();
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>')
				}
			});
			$('.eliminar_servicios').click(function()
			{
				var id = $(this).attr('data-id');
				$.post("index.php/servicios/C_eliminarCategoria",{id:id},
				function(data)
				{
					alert("El registro se ha eliminado correctamente");
					//$('.eliminar[data-id='+id+']').parent().parent().remove();
					$.post('index.php/servicios/refrescar_categorias',  function(data){
					$('.refrescar-categoria_servicios').html(data);});
					$.post('index.php/servicios/ver_categorias',  function(data){
					$('#update_categoria_servicios').html(data);});
					$.post('index.php/servicios/ver_categorias2',  function(data){
					$('#update_categoria_servicios2').html(data);});	
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>');
				}
				);
			});
			
		});
    </script>