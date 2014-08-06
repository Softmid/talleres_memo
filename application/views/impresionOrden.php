<?php 
		$ordenResult = $orden->row();
		$vehiculoResult = $vehiculo->row();
?>

<article class="imprecionOrden clear">
	<section class="header">
		<img src="images/logo_imprecion.png" id="logo-imprecion">

		<aside id="num-orden">
			<h1 id="titulo">ORDEN DE SERVICIO</h1>
			<h1 id="n-titulo">Nº</h1>
			<p id="numero"><? echo $ordenResult->clave; ?></p>
		</aside>
	</section>
	<section class="datos-taller">
		<aside id="texto">
			<p>MIGUEL ANGEL CANUL CATZIN</p>
			<p>R.F.C. CACM-620518-MN3</p>
			<p>CALLE 39 N° 323 x 20 COL. PEDREGALES DE TANLUM</p>
			<p>MERIDA,YUC.  CP. 97210</p>
		</aside>
		<img src="images/medidor.png" id="medidor">
	</section>
	
	<section class="datos-cliente clear">
		<ul class="clear">
			<li class="clear">
				<p class="grande"><span>Cliente: </span><?php echo $ordenResult->cliente; ?></p>
			</li>
			<li class="clear">
				<p class="grande"><span>Direccion: </span><?php echo $ordenResult->direccion; ?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>RFC: </span><?php echo $ordenResult->rfc; ?></p>
				<p class="chico"><span>Telefono: </span><?php echo $ordenResult->telefono; ?></p>
				<p class="schico"><span>Celular: </span><?php echo $ordenResult->celular; ?></p>
			</li>
			<li class="clear">
				<p class="sschico"><span>Marca: </span><?php echo $vehiculoResult->marca?></p>
				<p class="sschico"><span>Modelo: </span><?php echo $vehiculoResult->modelo?></p>
				<p class="sschico"><span>Año: </span><?php echo $vehiculoResult->year?></p>
				<p class="sschico"><span>Color: </span><?php echo $vehiculoResult->color?></p>
				<p class="sschico"><span>Placa: </span><?php echo $vehiculoResult->placas?></p>
			</li>
			<li class="clear">
				<p class="grande"><span>Nº de VIN: </span><?php echo $vehiculoResult->num_VIN?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>Fecha de entrada: </span><?php echo $ordenResult->fecha_hora?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>Fecha promesa de salida: </span><?php echo $ordenResult->fechaPromesa?></p>
			</li>
			<?php if($ordenResult->aseguradora==1){ ?>
			<li class="clear">
				<p class="chico"><span>Empresa: </span><?php echo $ordenResult->empresa?></p>
				<p class="chico"><span>Deducible: </span><?php echo $ordenResult->dedusible?></p>
				<p class="chico"><span>Numero de Poliza: </span><?php echo $ordenResult->numeroPoliza?></p>
				<p class="chico"><span>Numero de Reporte: </span><?php echo $ordenResult->numeroReporte?></p>
				<p class="chico"><span>Fecha de Siniestro: </span><?php echo $ordenResult->fechaSiniestro?></p>
			</li>
			<? } ?>

		</ul>
	</section>

		<section class="caracteristicas clear">
    	
            <?php
				$count=1;
				foreach($caracteristicas->result() as $data)
				{
					if($count == 1 and $data->concepto == 'Unidad de Luces')
					{
						$caracteristicas1 = true;
						echo '
						<ul class="lista-caracteristicas uno">
							<li class="titulo">EXTERIOR</li>
						';

					}

					if($count == 1 and $data->concepto == 'Gato')
					{
						$caracteristicas2 = true;
						echo '
						<ul class="lista-caracteristicas dos">
							<li class="titulo">ACCESORIOS</li>
						';

					}

					if($count == 1 and $data->concepto == 'Instrumentos de Tablero')
					{
						$caracteristicas3 = true;
						echo '
						<ul class="lista-caracteristicas tres">
							<li class="titulo">INTERIOR</li>
						';

					}

					if($count == 1 and $data->concepto == 'Claxon')
					{
						$caracteristicas3 = true;
						echo '
						<ul class="lista-caracteristicas cuatro">
							<li class="titulo">COMPONENTES MECANICOS</li>
						';

					}

					if($data->checked == true){
						
						echo '<li>'.$data->concepto.'<span><i class="icon-check"> SI </i><i class="icon-check-empty"> NO </i></span></li>';	
					}
					else{
						echo '<li>'.$data->concepto.'<span><i class="icon-check-empty"> SI </i><i class="icon-check"> NO </i></li></span></li>';	
					}

					if($data->concepto == 'Bocina de Claxon')
					{
						echo '</ul>';
						$count = 0;
					}

					if($data->concepto == 'Extinguidor')
					{
						echo '</ul>';
						$count = 0;
					}

					if($data->concepto == 'Encendedor')
					{
						echo '</ul>';
						$count = 0;
					}

					if($data->concepto == 'Batería(MCA)')
					{
						echo '</ul>';
						$count = 0;
					}
					
					$count++;
				}
            ?>
        </ul>
        <img src="images/autos/impresion.png" class="imagen-caracteristica">        
	</section>
	
	
		<section class="tabla-corbata clear">

			<?php
				$subTotal = 0;
				$Total = 0;
			?>
				
				<table class="corbata">
        	<thead>
                <tr>
                	<th width="44%">Concepto</th>
                	<? 
                	foreach ($categorias->result() as $data) 
                	{
                		echo '<th width="8%" id="categoria" data-id="'.$data->idCategorias.'">'.$data->nombre.'</th>';

                	}//categorias
                    ?>         
                </tr>

        
            </thead>
           <tbody>
           			<?
           			foreach ($servicios->result() as $data) 
                	{
		           		echo '<tr>';
		           			
		            		echo '<td>'.$data->concepto.'</td>';
							
							foreach ($categorias->result() as $data2) 
							{
								$this->load->model('Procesos_Servicios');
								$data_result['suma'] = $this->Procesos_Servicios->suma_monto_categoria($data2->idCategorias,$ordenResult->idOrdenes,$data->id);

								$suma = $data_result['suma']->row();

								if($suma->monto_categoria>0)
								{
									echo '<td width="8%">'.$suma->monto_categoria.'</td>';
									$subTotal += $suma->monto_categoria;
								}
								else
								{
									echo '<td width="8%">0.00</td>';
								}
								

							}//categorias

		           		echo '</tr>';
           			}//categorias
                    ?>
           </tbody>
        </table>


			<?
				
												
					$Total += $subTotal;
					$subTotal = 0;
				
			?>
	</section>		
	<section class="finalImpresion">
		<p id="datosImpresion">
			 GARANTIZO Y ASEGURO QUE SOY EL DUEÑO O ESTOY  AUTORIZADO PARA ORDENAR ESTA REPARACION, CON LA PRESENTE AUTORIZO<br>
			 EL TRABAJO DESCRITO JUNTO CON LAS PIEZAS Y/O MATERIALES  NECESARIOS PARA EFECTUARLOS Y AUTORIZO A UD. O AL ASESOR <br>
			 DE SERVICIO A OPERAR EL VEHICULO  ARRIBA ESPECIFICADO EN LAS CALLES PARA PROBARLO Y REVISARLO.<br>
			 DEBO Y PAGARE INCONDICIONALMENTE Y DE CONTADO LA CANTIDAD ARRIBA DESCRITA POR LA REPARACION DE MI AUTOMOVIL.<br>
			 La empresa NO se hace responsable por objetos olvidados en el interior de su automóvil, se recomienda depositarlo en la oficina.<br>
			 <span id="center">EL CONSUMIDOR</span>
			 <span id="acepto">ACEPTO</span>
			 <span id="firma">Firma de aceptación</span>
		</p>
		<aside id="total">
			<?php
				echo '<aside class="subtotal">Sub-Total <span>$ '.number_format($Total, 2).'</span></aside>';
				echo '<aside class="subtotal">16% IVA <span id="iva">$ '.number_format(($Total * .16), 2).'</span></aside>';
				echo '<aside class="subtotal">Total <span id="sumaTotal">$ '.number_format(($Total * 1.16), 2).'</span></aside>';
			?>
		</aside>
	</section>
</article>

<style type="text/css" media="print">
@page{
   margin: 0;
}
</style>