<ul class="rel-categoria">
	<?php
		$montoTotal = 0;
			
			foreach ($rel->result() as $data) 
			{	
					if($data->sustituir==1){$sustituir="checked";$monto_sustituir="text";}else{$sustituir="";$monto_sustituir="hidden";}
					if($data->reparar==1){$reparar="checked";$monto_reparar="text";}else{$reparar="";$monto_reparar="hidden";}
					if($data->retoque==1){$retoque="checked";$monto_retoque="text";}else{$retoque="";$monto_retoque="hidden";}
					if($data->estetica==1){$estetica="checked";$monto_estetica="text";}else{$estetica="";$monto_estetica="hidden";}
					if($data->pintura==1){$pintura="checked";$monto_pintura="text";}else{$pintura="";$monto_pintura="hidden";}
					if($data->mecanica==1){$mecanica="checked";$monto_mecanica="text";}else{$mecanica="";$monto_mecanica="hidden";}
					if($data->otros==1){$otros="checked";$monto_otros="text";}else{$otros="";$monto_otros="hidden";}
					
					
					
					echo '<li class="result-categoria clear" data-id="'.$data->idRel.'">Concepto: '.$data->concepto.' <a class="eliminarRel" data-id="'.$data->idRel.'" title="Eliminar concepto"><i class="icon-remove-sign"></i></a>';
					echo '
					<div class="cate_trabajo">
						<aside>Sustituir <input class="tipo_trabajo" '.$sustituir.' data-idRel="'.$data->idRel.'" type="checkbox" data-nombre="sustituir" name="sustituir" value="1"><input class="monto" type="'.$monto_sustituir.'" name="monto_sustituir" data-id="'.$data->idRel.'" data-nombre="monto_sustituir" size="5" id="monto_sustituir'.$data->idRel.'" value="'.$data->monto_sustituir.'" style="margin: 4px 0px;
width: 81%;"/></aside>
						<aside>Reparar <input class="tipo_trabajo" '.$reparar.' data-idRel="'.$data->idRel.'" data-nombre="reparar" type="checkbox" name="reparar" value="1"><input class="monto" type="'.$monto_reparar.'" name="monto_reparar" size="5" data-id="'.$data->idRel.'" data-nombre="monto_reparar" id="monto_reparar'.$data->idRel.'" value="'.$data->monto_reparar.'" style="margin: 4px 0px;
width: 81%;"/></aside>
						<aside>Retoque <input class="tipo_trabajo" '.$retoque.' data-nombre="retoque" data-idRel="'.$data->idRel.'" type="checkbox" name="retoque" value="1"><input class="monto" type="'.$monto_retoque.'" name="monto_retoque" size="5" data-id="'.$data->idRel.'" data-nombre="monto_retoque" id="monto_retoque'.$data->idRel.'" value="'.$data->monto_retoque.'" style="margin: 4px 0px;
width: 81%;"/></aside>
						<aside>Pintura <input class="tipo_trabajo" '.$pintura.' data-idRel="'.$data->idRel.'" data-nombre="pintura" type="checkbox" name="pintura" value="1"><input class="monto" type="'.$monto_pintura.'" name="monto_pintura" size="5" data-id="'.$data->idRel.'" data-nombre="monto_pintura" id="monto_pintura'.$data->idRel.'" value="'.$data->monto_pintura.'" style="margin: 4px 0px;
width: 81%;"/></aside>
						<aside>Estetica <input class="tipo_trabajo" '.$estetica.' data-idRel="'.$data->idRel.'" data-nombre="estetica" type="checkbox" name="estetica" value="1"><input class="monto" type="'.$monto_estetica.'" name="monto_estetica" size="5" data-id="'.$data->idRel.'" data-nombre="monto_estetica" id="monto_estetica'.$data->idRel.'" value="'.$data->monto_estetica.'" style="margin: 4px 0px;
width: 81%;"/></aside>
						<aside>Mecanica <input class="tipo_trabajo" '.$mecanica.' data-idRel="'.$data->idRel.'" data-nombre="mecanica" type="checkbox" name="mecanica" value="1"><input class="monto" type="'.$monto_mecanica.'" name="monto_mecanica" size="5" data-id="'.$data->idRel.'" data-nombre="monto_mecanica" id="monto_mecanica'.$data->idRel.'" value="'.$data->monto_mecanica.'" style="margin: 4px 0px;
width: 81%;"/></aside>
						<aside>Otros <input class="tipo_trabajo" '.$otros.' data-idRel="'.$data->idRel.'" data-nombre="otros" type="checkbox" name="otros" value="1"><input class="monto" type="'.$monto_otros.'" name="monto_otros" size="5" data-id="'.$data->idRel.'" data-nombre="monto_otros" id="monto_otros'.$data->idRel.'" value="'.$data->monto_otros.'" style="margin: 4px 0px;
width: 81%;"/></aside>
					</div>
					</li>';

					$montoTotal = $montoTotal + $data->monto_sustituir + $data->monto_estetica + $data->monto_pintura + $data->monto_otros + $data->monto_retoque + $data->monto_reparar + $data->monto_mecanica;

			}
			
		

		echo '<li class="titulo-categoria">Monto Total</li>';
		echo '<li class="result-categoria">Monto Total: $'.$montoTotal.' </li>';
		echo '<input type="hidden" name="montoTotal" id="montoTotal" value="'.$montoTotal.'"/>'
	?>
</ul>




<script type="text/javascript">
	$(document).ready(function(){
		
		$(".eliminarRel").click(function()
		{	
			var idRel = $(this).attr("data-id");
			

			$.post("categorias/eliminarRelacion",{idRel:idRel},
				function()
				{
					var idVehiculo = $("#idVehiculoCar").val();
					var idOrden = $("#idOrden").val();

					$("#relacion-orden").load("vehiculo/verRelacionCategoria",{idVehiculo:idVehiculo,idOrden:idOrden});
					
				}
			);
			

		});//click
	});

	$(function(){


		$('.monto').change(function()
		{	
			var id = $(this).attr('data-id');
			var nombre = $(this).attr('data-nombre');
			var valor = $('#'+nombre+id).val();


			$.post("vehiculo/agregar_montoCorbata",{nombre:nombre,id:id,valor:valor});
			

		});


		$('.tipo_trabajo').click(function(){
				var marcado = $(this).is(":checked");

				if(marcado == true)
				{
					
					var id = $(this).attr('data-idRel');
					var nombre = $(this).attr('data-nombre');

					$.post("vehiculo/agregarCorbata",{nombre:nombre,id:id});

					$('#monto_'+nombre+id).attr('type','text');
				}
				else
				{
					
					var id = $(this).attr('data-idRel');
					var nombre = $(this).attr('data-nombre');
					var nombre_monto = "monto_"+$(this).attr('data-nombre');


					$.post("vehiculo/eliminarCorbata",{nombre:nombre,id:id});
					$.post("vehiculo/agregar_montoCorbata",{nombre:nombre_monto,id:id,valor:0});
					$('#monto_'+nombre+id).attr('type','hidden');
					
					
				}
			});
});
</script>