<ul class="rel-categoria">
	<?
		$montoTotal = 0;

		$suma_monto = $suma->row();
        $this->load->model('Procesos_Servicios');
			
			foreach ($rel->result() as $data) 
			{	   

                
					echo '<li class="result-categoria clear" data-id="'.$data->id.'">Concepto: '.$data->concepto.' <a class="eliminarRel" data-id="'.$data->id.'" title="Eliminar concepto"><i class="icon-remove-sign"></i></a>';
					?>
					<div class="cate_trabajo">
						
						<? foreach ($categorias->result() as $data2)
                        {
                        
							echo '<aside><p style="padding-left: 18px;">'.$data2->nombre.'</p>
							<aside class="sub_servicio" id="subcategoria_servicio" data-id="'.$data2->idCategorias.'">';

								$val['default'] = $this->Procesos_Servicios->servicio_default($data->id,$data2->idCategorias);
								$val['sub'] = $this->Procesos_Servicios->subCategorias($data2->idCategorias); 	
								
                                $default = $val['default']->row();
                            
										echo '<select name="subcategoria_servicio" id="subcat_servicio'.$data2->idCategorias.$data->id.'" class="subcat_servicio" data-idCat="'.$data2->idCategorias.'" data-idOrden="'.$data->idOrden.'" data-servicio="'.$data->id.'">';
                                        
                                        
                        
										echo '<option value="0"></option>';
										
                                        if($val['sub']->num_rows()>0)
                                        {
                                        
                                            foreach($val['sub']->result() as $data3)
                                            {

                                                if($default->id_subcategoria == $data3->idSubcategorias)
                                                {
                                                    echo '<option selected value="'.$data3->idSubcategorias.'">'.$data3->nombre.'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$data3->idSubcategorias.'">'.$data3->nombre.'</option>';
                                                }
                                            }//subcategorias
                                       
                                        }//existen las subcategorias?
				                    
										echo '</select>';						
				        	
							echo '</aside><div id="monto_servicios" >';
                        
                        if($data2->nombre == 'Pintura' || $data2->nombre == 'pintura'){
                            
                        
                                
                                    echo '<select name="piezas" class="piezas" id="piezas" id="subcat_servicio'.$data2->idCategorias.$data->id.'" class="subcat_servicio" data-idCat="'.$data2->idCategorias.'" data-idOrden="'.$data->idOrden.'" data-servicio="'.$data->id.'">';
                                
                                
                                for($i = 0; $i<=3; $i+=0.25)
                                        
                                {
                                    if($default->piezas == $i)
                                    {
                                        echo '<option selected value='.$i.'>'.$i.'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value='.$i.'>'.$i.'</option>';
                                    }
                                    
                                }
                                   echo '</select>';
                                    
                                
                            
                        }
                        
                                
                        
                        if($val['default']->num_rows()>0)
                        {
                            if($default->monto>0){
                                
                                echo '<input class="monto" type="text" name="monto" size="5" id="monto'.$data2->idCategorias.$data->id.'"           value="'.$default->monto.'"  data-idCat="'.$data2->idCategorias.'" data-idOrden="'.$data->idOrden.'" data-servicio="'.$data->id.'" />';
                                
                            }
                        }//existe el monto?
                        
                            else
                            {
                                echo '<input class="monto" type="text" name="monto" size="5" id="monto'.$data2->idCategorias.$data->id.'" value="0"  data-idCat="'.$data2->idCategorias.'" data-idOrden="'.$data->idOrden.'" data-servicio="'.$data->id.'" />';
                            }
									
								
							echo '</div></aside>';
						} ?>
					</div>
					</li>

			<?

					

			}
			
		

		echo '<li class="titulo-categoria">Monto Total</li>';
		echo '<li class="result-categoria" id="monto_total">Monto Total: $'.$suma_monto->monto_total.' </li>';
		
	?>
</ul>




<script type="text/javascript">
		
	

	$(document).ready(function(){

			
			


			$(".subcat_servicio").change(function(){

				var id_categoria = $(this).attr("data-idCat");
				var id_servicio = $(this).attr("data-servicio");
				var id_sub_categoria = $("#subcat_servicio"+id_categoria+id_servicio).val();
				var id_orden = $(this).attr("data-idOrden");
				

				//alert(id_categoria+"-"+id_sub_categoria+"-"+id_orden+"-"+id_servicio);
			
				$.post("servicios/ver_monto/"+id_categoria+"/"+id_sub_categoria+"/"+id_orden+"/"+id_servicio,function(data){

						var obj = $.parseJSON(data);
						
						$("#monto"+id_categoria+id_servicio).val(obj.monto);
				
				});
			});


			
			$(".monto").change(function(){

				var id_categoria = $(this).attr("data-idCat");
				var id_servicio = $(this).attr("data-servicio");
				var id_sub_categoria = $("#subcat_servicio"+id_categoria+id_servicio).val();
				var id_orden = $(this).attr("data-idOrden");
				var monto = $(this).val();

				//alert(id_categoria+"-"+id_sub_categoria+"-"+id_orden+"-"+id_servicio);

				$.post("servicios/actualizar_monto/"+id_categoria+"/"+id_sub_categoria+"/"+id_orden+"/"+id_servicio+"/"+monto,function(){

					$.post("servicios/actualizar_monto_orden/"+id_orden,function(data)
						{	

							var obj = $.parseJSON(data);

							$("#monto_total").html("Monto Total: "+obj.monto_total);

						});
				
				});
				
			});
        
        
            $(".piezas").change(function(){

				var id_categoria = $(this).attr("data-idCat");
				var id_servicio = $(this).attr("data-servicio");
				var id_sub_categoria = $("#subcat_servicio"+id_categoria+id_servicio).val();
				var id_orden = $(this).attr("data-idOrden");
				var piezas = $(this).val();
				

				//alert(id_categoria+"-"+id_sub_categoria+"-"+id_orden+"-"+id_servicio+"-"+piezas);
			
				$.post("servicios/actualizar_piezas/"+id_categoria+"/"+id_sub_categoria+"/"+id_orden+"/"+id_servicio+"/"+piezas,function(data){

				
				});
			});

		
	
 
		$(".eliminarRel").click(function()
		{	
			var idServicio = $(this).attr("data-id");
			

			$.post("servicios/eliminar_servicios/"+idServicio,
				function()
				{
					
					var idOrden = $("#idOrden").val();

					$("#relacion-orden").load("servicios/verRelacionCategoria",{idOrden:idOrden});
					
				}
			);
			

		});//click
	});

	$(function(){

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