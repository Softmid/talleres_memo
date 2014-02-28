<section id="form_agregarCategorias" title="Formulario Agregar Categoria">

    <section class="columna-2 clear">
   <!--  <aside class="contenedor-caracteristica clear">
        <form method="post" accept-charset="utf-8" id="form_eliminarCategorias">
            <ul id="datos">
            	<li><h2>Caracteristicas<span>>></span></h2></li>
                <li>
                	<ul class="lista-categoria refrescar-categoria">
                        <?php
						
							$count2=1;
							foreach($caracteristicas->result() as $data)
							{
								if($data->checked == true){
									
									echo '<li class="left"><aside class="izquierda active"><input checked="checked" type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-idProp="'.$id.'" data-idOrden="'.$idOrden.'"  data-id="'.$data->idCaracteristica.'" value="'.$data->idCaracteristica.'" /><label for="input2-'.$count2.'">'.$data->concepto.'</label><li></aside>';	
								}
								else{
									echo '<li class="left"><aside class="izquierda active"><input type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-idProp="'.$id.'" data-idOrden="'.$idOrden.'" data-id="'.$data->idCaracteristica.'" value="'.$data->idCaracteristica.'" /><label for="input2-'.$count2.'">'.$data->concepto.'</label><li></aside>';	
								}
								
								$count2++;
							}
                        ?>
                    </ul>
                </li> 
            </ul>
        </form>
    </aside> -->
    
    <aside class="contenedor-caracteristica clear">
        <form method="post" accept-charset="utf-8" id="form_trabajoSolicitado">
            <ul id="datos">
            	<li><h2>Trabajo Solicitado<span>>></span></h2></li>
                <li>
                	<ul class="lista-categoria tamn refrescar-categoria">
                      	<?
						foreach($categorias->result() as $data)
						{ 
								
								$nombre = strtoupper($this->funciones->eliminar_acentos($data->nombre));
														
						?>
                                <a href="#" class="addInput" data-id="<? echo $data->idCategorias; ?>" data-nombre="<? echo $nombre; ?>"><? echo $nombre; ?></a>
                                <div class="divCategorias" id="div<? echo $nombre; ?>">
                           
                                </div>
                                <input type="hidden" name="cantInput<? echo $data->idCategorias; ?>" id="cantInput<? echo $data->idCategorias; ?>" value="0" />	
					
						<? 	
						}
						
						?>
                        	<input type="hidden" name="idVehiculo" id="idVehiculoCar" value="<? echo $id ?>"/>
                        	<input type="hidden" name="idOrden" id="idOrden" value="<? echo $idOrden ?>"/>

                    </ul>
                </li> 
            </ul>
            <aside id="relacion-orden">
	
			</aside>
			
            <input type="button"  name="btnTrabajo" id="btnTrabajo" value="Guardar" />
        </form>
    </aside>
    
    
    <script type="text/javascript">

    $(document).ready(
	function()
	{	
		jQuery.validator.addClassRules("requerido", {required: true});

		var idVehiculo = $("#idVehiculoCar").val();
		var idOrden = $("#idOrden").val();

		$("#relacion-orden").load("vehiculo/verRelacionCategoria",{idVehiculo:idVehiculo,idOrden:idOrden});
});

	
		$(function () {
			
			$("#btnTrabajo").on("click",function()
			{		
				
				$.post("index.php/vehiculo/agregarTrabajo",$("#form_trabajoSolicitado").serialize(),
				function(data)
				{
					
						var idVehiculo = $("#idVehiculoCar").val();
						var idOrden = $("#idOrden").val();

						$("#relacion-orden").load("vehiculo/verRelacionCategoria",{idVehiculo:idVehiculo,idOrden:idOrden},function(){

							$.post("index.php/vehiculo/actualizarMonto",$("#form_trabajoSolicitado").serialize(),function(data)
								{	
									$(".divCategorias p").remove();
									$(".cantInput").val(0);
									$("#form_trabajoSolicitado").reset();

								});

					});
			
				}
				);
			});
			

			
	 $('.addInput').on('click', function() {
				var id = $(this).attr("data-id");
				var nombre = $(this).attr("data-nombre");
				var scntDiv = $("#div"+nombre);
				var i = $("#div"+nombre+" p").size()+1;
				$("#cantInput"+id).val(i);
						
				var input ='<p><label for="p_scnts"><input type="text" id="'+nombre+i+'"" size="20" name="'+nombre+i+'" value="" placeholder="'+nombre+'" /><input type="text" id="monto'+i+'"" size="20" class="requerido" name="'+nombre+'monto'+i+'" value="" placeholder="Monto" /></label><a data-id="'+id+'" data-nombre="'+nombre+'"  class="remInput"><i class="icon-remove-sign"></i>Remover</a></p>';
				
				var j_input = jQuery(input);
				jQuery('.remInput',j_input).bind('click',borrador);
				
                $(j_input).appendTo(scntDiv);
                return false;
        });
		
        
		function borrador()
        {
            var id = $(this).attr("data-id");
			var nombre = $(this).attr("data-nombre");
			var i = $("#div"+nombre+" p").size();
			var aux = i-1;
			$("#cantInput"+id).val(aux);
									
            $("#"+nombre+i).parents('p').remove();

            
                       
    
				
                return false;
        }
		

			
			$('.categoria').click(function(){
				var marcado = $(this).is(":checked");
				if(marcado == true)
				{
					var id = $(this).attr('data-id');
					
					var idOrden = $(this).attr('data-idOrden');

					$.post("caracteristicas/agregarRelacion",{tipo:1, id:id,idOrden:idOrden},function(data)
					{	
						
					});
				}
				else
				{
					var id = $(this).attr('data-id');
				
					var idOrden = $(this).attr('data-idOrden');

					$.post("caracteristicas/eliminarRelacion",{tipo:0, id:id,idOrden:idOrden});
				}
			});


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
