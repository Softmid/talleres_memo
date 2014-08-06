<script type="text/javascript" src="js/funciones.js"></script>


<section id="form_checkbox" title="Formulario Agregar Categoria">
    <section class="columna-2 clear">
    <aside class="contenedor-caracteristica clear">
        <form method="post" accept-charset="utf-8" id="form_eliminarCategorias">
            <ul id="datos">
            	<li><h2>Caracteristicas<span>>></span></h2></li>
                <li>
                	<ul class="lista-categoria modificar refrescar-categoria">
                        <?php
						
							$count2=1;
							foreach($caracteristicas->result() as $data)
							{
								if($data->checked == true){
									
									echo '<li class="left"><aside class="izquierda active"><input checked="checked" type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-idProp="'.$idVehiculo.'" data-idOrden="'.$idOrden.'"  data-id="'.$data->idCaracteristica.'" value="'.$data->idCaracteristica.'" /><label for="input2-'.$count2.'">'.$data->concepto.'</label><li></aside>';	
								}
								else{
									echo '<li class="left"><aside class="izquierda active"><input type="checkbox" name="categoria" id="input2-'.$count2.'" class="categoria" data-idProp="'.$idVehiculo.'" data-idOrden="'.$idOrden.'" data-id="'.$data->idCaracteristica.'" value="'.$data->idCaracteristica.'" /><label for="input2-'.$count2.'">'.$data->concepto.'</label><li></aside>';	
								}
								
								$count2++;
							}
                        ?>
                    </ul>
                </li> 
            </ul>
        </form>
    </aside>
    
    <aside class="contenedor-caracteristica clear">
		
        <form method="post" accept-charset="utf-8" id="form_trabajoSolicitado">
            <ul id="datos">
            	<li><h2>Trabajo Solicitado<span>>></span><a class="link-abrir boton-categoria btn-categoria-color" data-open="form_agregarCategorias" data-link="boton-categoria" data-width="800">Nueva Categoria</a></h2></li>
                <li>
                	<ul class="lista-categoria tamn refrescar-categoria">
                      	
                                <a href="#" class="addInput">Agregar</a>
                                <div class="divCategorias" id="div_corbata"></div>
                                <input type="hidden" class="cantInput" required name="cantInput" id="cantInput" value="0" />
					
						
                        	<input type="hidden" name="idVehiculo" id="idVehiculoCar" value="<? echo $idVehiculo ?>"/>
                        	<input type="hidden" name="idOrden" id="idOrden" value="<? echo $idOrden ?>"/>
                        <input type="button"  name="btnTrabajo" id="btnTrabajo" value="Guardar" />
                    </ul>
                </li> 
            </ul>
            <aside id="relacion-orden">
	
			</aside>
            
        </form>
    </aside>

   <?php include 'inc/include/categorias_servicios.php';?>
    
    
    <script type="text/javascript">
	

$(document).ready(
	function()
	{	
		jQuery.validator.addClassRules("requerido", {required: true});

		//var idVehiculo = $("#idVehiculoCar").val();
		var idOrden = $("#idOrden").val();

		$("#relacion-orden").load("servicios/verRelacionCategoria",{idOrden:idOrden});
		
	}
);

//categorias
$(function(){

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
});
		

	
		$(function () {
			
			$("#btnTrabajo").on("click",function()
			{	
				if($("#form_trabajoSolicitado").valid())
				{	

					$.post("index.php/servicios/agregarTrabajo",$("#form_trabajoSolicitado").serialize(),
					function()
					{
						//var idVehiculo = $("#idVehiculoCar").val();
						var idOrden = $("#idOrden").val();

						

						$("#relacion-orden").load("servicios/verRelacionCategoria",{idOrden:idOrden},function(){

							$(".divCategorias p").remove();
							$(".cantInput").val(0);
							$("#form_trabajoSolicitado").reset();

						});
						
					}
					);
				}
			});
			

			
	 $('.addInput').on('click', function() {
	 		
				var scntDiv = $("#div_corbata");
				var i = $("#div_corbata p").size()+1;
				
				$("#cantInput").val(i);
						
				var input ='<p><label for="p_scnts"><input class="input-concepto-trabajo" type="text" size="20" id="concepto'+i+'" name="concepto'+i+'" value="" placeholder="Concepto" /></label><a href="#" class="remInput"><i class="icon-remove-sign"></i></a></p>';
				
				var j_input = jQuery(input);
				jQuery('.remInput',j_input).bind('click',borrador);
				
                $(j_input).appendTo(scntDiv);
                return false;
        });
		
        
		function borrador()
        {
            
			var i = $("#div_corbata p").size();
			var aux = i-1;
			$("#cantInput").val(aux);
									
            $("#concepto"+i).parents('p').remove();   
				
                return false;
        }
		

			
			
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
