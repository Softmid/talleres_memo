<?php
$cont=1;
	foreach($subcategorias->result() as $subcategoria)
	{
		if($subcategoria->visible == 1)
		{
			echo '<li><aside class="izquierda active"><input type="checkbox" name="subcategoria" id="input-'.$cont.'" class="subcategoria" data-id="'.$subcategoria->idSubcategorias.'" value="'.$subcategoria->idSubcategorias.'" checked=checked/><label for="input-'.$cont.'">'.$subcategoria->nombre.'</label><li></aside><aside class="derecha"><a class="eliminar eliminarSubcategoria" data-id="'.$subcategoria->idSubcategorias.'">X</a></aside>';
			$cont++;
		}
		else
		{
			echo '<li><aside class="izquierda"><input type="checkbox" name="subcategoria" id="input-'.$cont.'" class="subcategoria" data-id="'.$subcategoria->idSubcategorias.'" value="'.$subcategoria->idSubcategorias.'"/><label for="input-'.$cont.'">'.$subcategoria->nombre.'</label><li></aside><aside class="derecha"><a class="eliminar eliminarSubcategoria" data-id="'.$subcategoria->idSubcategorias.'">X</a></aside>';
			$cont++;
		}
	}
?>
<script type="text/javascript">
	$(function (){
		$('.subcategoria').click(function(){
			var marcado = $(this).is(":checked");
			if(marcado == true)
			{
				var id = $(this).attr('data-id');
				$.post("index.php/vehiculo/C_eliminarSubCategoria",{tipo:1, id:id});
				$(this).parent().addClass('active');
			}
			else
			{
				var id = $(this).attr('data-id');
				$.post("index.php/vehiculo/C_eliminarSubCategoria",{tipo:0, id:id});
				$(this).parent().removeClass('active');
			}
		});
		
		$('.eliminarSubcategoria').click(function()
		{
			var id = $(this).attr('data-id');
			$.post("index.php/vehiculo/C_eliminarSubCategoria",{id:id},
			function(data)
			{
				alert("El registro se ha eliminado correctamente");
				$('.eliminarSubcategoria[data-id='+id+']').parent().parent().remove();
				$("#form_eliminarSubCategorias").reset();
			}
			);
		});
	});
</script>