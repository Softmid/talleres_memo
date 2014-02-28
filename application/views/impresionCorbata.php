<?php 
		$ordenResult = $orden->row();
		$vehiculoResult = $vehiculo->row();
?>

<? foreach ($categoria->result() as $data) 
{   ?>

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
		</ul>
	</section>

	<section class="tabla-corbata clear">


		<table class="corbata">
        	<thead>
                <tr>
                    <th width="44%"><? echo $data->nombre; ?></th>
                    <th width="8%">Sustituir</th>
                    <th width="8%">Reparar</th>
                    <th width="8%">Ret. Pintura</th>
                    <th width="8%">Pintura</th>  
                    <th width="8%">Estetica</th>
                    <th width="8%">TOT</th>                    
                </tr>

        
            </thead>
            <? foreach ($rel_trabajo->result() as $trabajo) {

             ?>
            <tbody>
            	<tr>
            		<td><? echo $trabajo->concepto; ?></td>
            		<td><? if($trabajo->sustituir==1) echo "x"; ?></td>
            		<td><? if($trabajo->reparar==1) echo "x"; ?></td>
            		<td><? if($trabajo->retoque==1) echo "x"; ?></td>
            		<td><? if($trabajo->pintura==1) echo "x"; ?></td>
            		<td><? if($trabajo->estetica==1) echo "x"; ?></td>
            		<td><? if($trabajo->otros==1) echo "x"; ?></td>
            	</tr>
            </tbody>
            <? }// foreach trabajo ?>
        </table>

        <table class="porcentaje">
        	<thead>
                <tr>
                    <th colspan="8">Porcentaje</th>
                                       
                </tr>
            </thead>
            <tbody>
            	<tr>
            		<td width="12.5%">25%</td>
            		<td width="12.5%"></td>
            	
            		<td width="12.5%">50%</td>
            		<td width="12.5%"></td>
            	
            		<td width="12.5%">75%</td>
            		<td width="12.5%"></td>
    
            		<td width="12.5%">100%</td>
            		<td width="12.5%"></td>
            	</tr>
            </tbody>
        </table>

        <table class="briciado">
        	<thead>
                <tr>
                    <th colspan="4">Briciado</th>
                                       
                </tr>
            </thead>
            <tbody>
            	<tr>
            		<td width="25%">SI</td>
            		<td width="25%"></td>
            		<td width="25%">NO</td>
            		<td width="25%"></td>
            	</tr>
            </tbody>
        </table>

	</section>
	
</article>

<? }//foreach categoria ?>

<style type="text/css" media="print">
@page{
   margin: 0;
}
</style>

<script type="text/javascript">
    $(document).ready(function(){
        var aux = $('.imprecionOrden').height();
        if(aux <= 570)
        {
            $('.imprecionOrden').height('600');
        }
        else
        {
            $('.imprecionOrden').height('1100');
        }
    });
</script>