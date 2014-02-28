<?php
	$count2=1;
	foreach($caracteristicas->result() as $data)
	{
		
			echo '<li class="left"><aside class="izquierda active"><label for="input2-'.$count2.'">'.$data->concepto.'</label><li></aside><aside class="derecha"></aside>';						
		
		$count2++;
	}
?>
<script type="text/javascript">
	$(function () {
		/*$('.categoria').click(function(){
			var marcado = $(this).is(":checked");
			if(marcado == true)
			{
				var id = $(this).attr('data-id');
				$.post("categorias/C_desactiverCategoria",{tipo:1, id:id});
				$(this).parent().addClass('active');
				$('#form_eliminarSubCategorias').reset();
				$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>');
			}
			else
			{
				var id = $(this).attr('data-id');
				$.post("categorias/C_desactiverCategoria",{tipo:0, id:id});
				$(this).parent().removeClass('active');
				$('#form_eliminarSubCategorias').reset();
				$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>')
			}
		});*/
		$('.eliminar').click(function()
		{
			var id = $(this).attr('data-id');
			$.post("caracteristicas/eliminar",{id:id},
			function()
			{
				alert("El registro se ha eliminado correctamente");
				$('.refrescar-categoria').load('caracteristicas/refrescar_categorias');
			}
			);
		});
		
	});
</script>