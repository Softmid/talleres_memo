	<?php if (isset($images) && count($images)):
	foreach($images as $image):	?>
	<div class="thumb">
	<a href="<?php echo $image['url']; ?>">
	<img src="<?php echo $image['thumb_url']; ?>" />
	</a>
	<a class="" onclick="Enviar(<? echo $image['idImagen'] ?>,<? echo $id;?>)" data-id="<? echo $image['idImagen'] ?>" data-prop="<? echo $id;?>">X</a>				
	</div>
	<?php endforeach; else: ?>
	<div id="blank_gallery">Please Upload an Image</div>
	<?php endif; ?>
	
    
<script>
	
	function Enviar(idI,idP)
	
	{ 
		var idImagen = idI;
		var idProp = idP;
		
		$.post("gallery/borrar_imagen",{idImagen:idImagen},function(){
			
			$("#gallery").load("gallery/recargar_imagenes/"+idProp);
			
			});
	}

</script>