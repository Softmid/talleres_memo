<section id="form_agregarCategorias" title="Formulario Agregar Categoria">
	<section class="columna-1 clear">
    <aside class="contenedor-caracteristica">
    	<form method="post" accept-charset="utf-8" id="form_caracteristicas">
            <ul id="datos">
                <li><h2>Datos de la Categoria <span>>></span></h2></li>
                <li><input type="text" name="nombre" value="" id="nombre" placeholder="Caracteristica" /></li>
                <li><input type="submit" name="btnFormCaracteristica" value="Agregar Caracteristica"  onclick="enviarRegistroCaracteristica()" id="btnFormCategorias"  /></li>
            </ul>
        </form>
    </aside>
    
    <script type="text/javascript">
			function enviarRegistroCaracteristica()
			{
				if($("#form_caracteristicas").valid())
				{
					
					$.post("caracteristicas/agregar",$("#form_caracteristicas").serialize(),
					function(data)
					{
						alert("El registro se ha ingresado correctamente "+data+"");
						$("#form_caracteristicas").reset();
						$.post('caracteristicas/refrescar_categorias',  function(data){
						$('.refrescar-categoria').html(data);});
					}
					);
				}	
			}
    </script>
    	
    </section>
    <section class="columna-1 clear">
    <aside class="contenedor-categoria clear">
        <form method="post" accept-charset="utf-8" id="form_eliminarCategorias">
            <ul id="datos">
            	<li><h2>Eliminar Categoria<span>>></span></h2></li>
                <li>
                	<ul class="lista-categoria refrescar-categoria">
                        <?php
							$count2=1;
							foreach($caracteristicas->result() as $data)
							{
								
									echo '<li><aside class="izquierda active"><label for="input2-'.$count2.'">'.$data->concepto.'</label><li></aside><aside class="derecha"></aside>';						
								
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
			/*$('.categoria').click(function(){
				var marcado = $(this).is(":checked");
				if(marcado == true)
				{
					var id = $(this).attr('data-id');
					$.post("index.php/categorias/C_desactiverCategoria",{tipo:1, id:id});
					$(this).parent().addClass('active');
					$('#form_eliminarSubCategorias').reset();
					$('.resultSubCategoria').html('<span style="padding-left:5px;">Tiene que seleccionar una categoría</span>');
				}
				else
				{
					var id = $(this).attr('data-id');
					$.post("index.php/categorias/C_desactiverCategoria",{tipo:0, id:id});
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
				{	alert("El registro se ha eliminado correctamente");
					
					$('.refrescar-categoria').load('caracteristicas/refrescar_categorias');
				}
				);
			});
			
		});
    </script>
    
  
    </section>
</section>
