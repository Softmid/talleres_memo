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
				<p class="chico"><span>Dedusible: </span><?php echo $ordenResult->dedusible?></p>
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
	
	
	
</article>

<style type="text/css" media="print">
@page{
   margin: 0;
}
</style>