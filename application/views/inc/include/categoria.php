<section id="form_agregarCategorias" title="Formulario Agregar Categoria" style="display:none;">
	<section class="columna-1 clear">
    <aside class="contenedor-categoria">
    	<form method="post" accept-charset="utf-8" id="form_categorias">
            <ul id="datos">
                <li><h2>Datos de la Categoria <span>>></span></h2></li>
                <li><input type="text" name="categoria" value="" id="categoria" placeholder="Categoria" /></li>
                <li><input type="submit" name="btnFormCategorias" value="Agregar Categoria"  onclick="enviarRegistroCategoria()" id="btnFormCategorias"  /></li>
            </ul>
        </form>
    </aside>
    <script type="text/javascript">
			function enviarRegistroCategoria()
			{
				if($("#form_categorias").valid())
				{
					
					$.post("index.php/vehiculo/C_agregar_categoria",$("#form_categorias").serialize(),
					function(data)
					{
						alert("El registro se ha ingresado correctamente "+data+"");
						$("#form_categorias").reset();
						$.post('index.php/vehiculo/refrescar_categorias',  function(data){
						$('.refrescar-categoria').html(data);});
						$.post('index.php/vehiculo/ver_categorias',  function(data){
						$('#update_categoria').html(data);});
						$.post('index.php/vehiculo/ver_categorias2',  function(data){
						$('#update_categoria2').html(data);});	
					}
					);
				}	
			}
    </script>
    <aside class="contenedor-categoria">
    	<form method="post" accept-charset="utf-8" id="form_subCategorias">
    	<ul id="datos">
    	 		<li><h2>Datos de la subCategoria <span>>></span></h2></li>
                <li id="update_categoria">
                    <select name="categoria" id="categoria" class="result-categoria">
                        <option value="">Seleccione una Categoría</option>
                        <?php
							foreach($categorias->result() as $categoria)
							{
								echo '<option value="'.$categoria->idCategorias.'">'.$categoria->nombre.'</option>';
							}
                        ?>
                    </select>
                </li>
                <li><input type="text" name="subCategoria" value="" id="subCategoria" placeholder="Sub-Categoria" /></li>
                <li><input type="submit" name="btnForm_subCategorias" value="Agregar Sub-Categorias"  onclick="enviarSubcategoria()" id="btnForm_subCategorias"  /></li>
         </ul>
         </form>
    </div>
    </section>
    <section class="columna-1 clear">
    <script type="text/javascript">
		function enviarSubcategoria()
		{
			if($("#form_subCategorias").valid())
			{
				
				$.post("index.php/vehiculo/C_agregarSubcategoria",$("#form_subCategorias").serialize(),
				function(data)
				{
					alert("El registro se ha ingresado correctamente "+data+"");
					$("#form_subCategorias").reset();
					$.post('index.php/vehiculo/ver_categorias2',  function(data){
					$('#update_categoria2').html(data);});	
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>');
				}
				);
			}	
		}
    </script>
    <aside class="contenedor-categoria clear">
        <form method="post" accept-charset="utf-8" id="form_eliminarCategorias">
            <ul id="datos">
            	<li><h2>Eliminar Categoria<span>>></span></h2></li>
                <li>
                	<ul class="lista-categoria refrescar-categoria">
                        <?php
							$count2=1;
							foreach($categorias->result() as $categoria)
							{
								if($categoria->visible == 1)
								{
									echo '<li><aside class="izquierda active"><input type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-id="'.$categoria->idCategorias.'" value="'.$categoria->idCategorias.'" checked=checked/><label for="input2-'.$count2.'">'.$categoria->nombre.'</label><li></aside><aside class="derecha"><a class="eliminar" data-id="'.$categoria->idCategorias.'">X</a></aside>';
								}
								else
								{
									echo '<li data-id="'.$categoria->idCategorias.'" ><aside class="izquierda"><input type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-id="'.$categoria->idCategorias.'" value="'.$categoria->idCategorias.'"/><label for="input2-'.$count2.'">'.$categoria->nombre.'</label><li></aside><aside class="derecha"><a class="eliminar" data-id="'.$categoria->idCategorias.'">X</a></aside>';
								}
								$count2++;
							}
                        ?>
                    </ul>
                </li> 
            </ul>
        </form>
    </aside>
    <script type="text/javascript">
		$(function () {
			$('.categoria').click(function(){
				var marcado = $(this).is(":checked");
				if(marcado == true)
				{
					var id = $(this).attr('data-id');
					$.post("index.php/vehiculo/C_desactiverCategoria",{tipo:1, id:id});
					$(this).parent().addClass('active');
					$('#form_eliminarSubCategorias').reset();
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>');
				}
				else
				{
					var id = $(this).attr('data-id');
					$.post("index.php/vehiculo/C_desactiverCategoria",{tipo:0, id:id});
					$(this).parent().removeClass('active');
					$('#form_eliminarSubCategorias').reset();
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>')
				}
			});
			$('.eliminar').click(function()
			{
				var id = $(this).attr('data-id');
				$.post("index.php/vehiculo/C_eliminarCategoria",{id:id},
				function(data)
				{
					alert("El registro se ha eliminado correctamente");
					$('.eliminar[data-id='+id+']').parent().parent().remove();
					$.post('index.php/vehiculo/ver_categorias',  function(data){
					$('#update_categoria').html(data);});
					$.post('index.php/vehiculo/ver_categorias2',  function(data){
					$('#update_categoria2').html(data);});	
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>');
				}
				);
			});
			
		});
    </script>
    
    <aside class="contenedor-categoria clear">
        <form method="post" accept-charset="utf-8" id="form_eliminarSubCategorias">
            <ul id="datos">
            	<li><h2>Eliminar Sub-Categoria<span>>></span></h2></li>
                 <li id="update_categoria2">
                	<select name="categoria" id="categoria" class="categoria-val">
                        <option value="">Seleccione una Categoría</option>
                        <?php
							foreach($categorias->result() as $categoria)
							{
								echo '<option value="'.$categoria->idCategorias.'">'.$categoria->nombre.'</option>';
							}
                        ?>
                    </select>
                </li>
                <li>
                	<ul class="lista-categoria resultSubCategoria">
                    	<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>
                    </ul>
                </li>              
            </ul>
        </form>
    </aside>
    </section>
</section>
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