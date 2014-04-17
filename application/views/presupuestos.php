<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');		
?>
<script type="text/javascript" src="js/funciones-presupuestos.js"></script>
<section class="contenedor" id="vehiculo"> 
	<aside id="menu-opciones" class="clear">
        <a class="link-ajax link-boton" data-open="vista-agregar-carro" data-link="agregar-vehiculo" data-ajax="form-agregar-carro" data-url="presupuestos/verFormParticular" data-visible="form-agregar-carro">Agregar Presupuesto</a>
    </aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Presupuestos<span>>></span></h2>
        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr  class="persist-header header-tabla">
                    <th width="120">Marca</th>
                    <th width="114">Modelo</th>
                    <th width="101">Color</th>
                    <th width="121">Empresa</th>
                    <th width="214">Fecha Promesa</th>
                    <th width="96">Monto</th>
                
                    
                </tr>

        
            </thead>
            <tbody id="busqueda-vehiculo">
            <?php
            	foreach($vehiculos->result() as $vehiculo)
				{
					if($vehiculo->numero > 0){$valor = 'si';} else {$valor = '';}
			?>
            		<tr class="padre btnMenu" data-id="<? echo $vehiculo->idOrdenes; ?>">
                        <td align="center"><?php echo $vehiculo->marca?></td>
                        <td align="center"><?php echo $vehiculo->modelo?></td>
                        <td align="center"><?php echo $vehiculo->color?></td>
                        <td align="center"><?php echo $vehiculo->empresa?></td>                    
                        <td style="color:#F00;" align="center"><?php echo $this->funciones->convertir_fecha($vehiculo->fechaPromesa);?></td>
                        <td align="center">$ <?php echo number_format($vehiculo->monto,2)?></td>

                        

                    </tr>
                     <tr class="hijo" data-id="<? echo $vehiculo->idOrdenes; ?>" style="display:none">
                        <td align="center"><a href="index.php/vehiculo/modificarVehiculo/<?php echo $vehiculo->idVehiculo?>/<?php echo $vehiculo->idOrdenes?>" class="link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" ><i class="icon-cogs"></i>Modificar</a></td>
                       <td align="center"><a class=" link-boton-menu" href="index.php/presupuestos/imprecionOrdenPresupuesto/<?php echo $vehiculo->idVehiculo?>/<?php echo $vehiculo->idOrdenes?>" data-open="" data-url="" data-id="<?php echo $vehiculo->idVehiculo;?>"><i class="icon-print"></i>Imprimir</a></td>
                       <td align="center"><a class="btnMenu link-boton-menu btnAutorizar" data-id="<? echo $vehiculo->idVehiculo; ?>" data-idOrden="<? echo $vehiculo->idOrdenes; ?>"><i class="icon-check menu"></i>Autorizar</a></td> 
                       <td align="center"><a class="btnMenu link-boton-menu btnCancelar" data-id="<? echo $vehiculo->idVehiculo; ?>" data-idOrden="<? echo $vehiculo->idOrdenes; ?>"><i class="icon-check menu"></i>Cancelar</a></td>                 
                        <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $vehiculo->idOrdenes;?>"><i class="icon-share-alt"></i>Regresar</a></td>
                    </tr>
            <?
				}
			?>
            <tbody>
        </table>
    </section>
</section>

<section class="contenedor" id="vista-agregar-carro" style="display:none;">
    <aside id="menu-opciones" class="clear">
        <a class="link-boton regresar" data-oculto="vista-agregar-carro" data-ajax="form-agregar-carro" data-visible="vehiculo">Regresar</a>
    </aside>
    <section id="form-agregar-carro">
    
    </section>
</section>

<section class="contenedor" id="vista-modificar-carro" style="display:none;">
    <aside id="menu-opciones" class="clear">
        <a class="link-boton regresar" data-oculto="vista-modificar-carro" data-ajax="form-modificar-carro" data-visible="vehiculo">Regresar</a>
    </aside>
    <section id="form-modificar-carro">
    
    </section>
</section>

<section class="contenedor" id="form-agregar-carro" style="display:none;">
    <section id="form-agregar-carro" title="Formulario Agregar Vehiculo" >
    	
        <section class="tabs clear">
	    <aside id="menu-opciones" class="clear">
	        <a class="link-boton regresar" data-oculto="form-agregar-carro" data-visible="vehiculo">Regresar</a>
	    </aside>
	<nav class="nav">
    	<ul>
    		<li><a class="opcion-tab active" data-url="" data-opcion="1">Paso 1</a></li>
        	<li><a class="opcion-tab" data-url="caracteristicas/verModPresupuesto"   data-opcion="2">Paso 2</a></li>
    	</ul>
    </nav>
    <aside class="cont-tab clear" data-opcion="1">
    	<form method="post" accept-charset="utf-8" id="form_vehiculo">
        <ul id="datos">
            <li><h2>Datos del Vehiculo <span>>></span></h2></li>
            <li><input type="text" name="vin" value="" id="vin" placeholder="VIN del Vehiculo"/></li>
            <li><input type="text" name="marca" value="" id="marca" placeholder="Marca del Vehiculo" /></li>
            <li><input type="text" name="modelo" value="" id="modelo" placeholder="Modelo del Vehiculo" /></li>
            <li><select name="year" id="year">
                <option value="">Selecciona el año</option>
                <? for($i=$dateTime+1;$i>=1950;$i--)
                { 
                        echo "<option value=\"$i\">$i</option>";
                 } ?>
                
            </select></li>
            <li><input type="text" name="color" value="" id="color" placeholder="Color del Vehiculo" /></li>
            <li><input type="text" name="placas" value="" id="placas" placeholder="Placas del Vehiculo"/></li>
            <li><h2>Datos del cliente <span>>></span></h2></li>
            <li><input type="text" name="cliente" value="" id="cliente" placeholder="Cliente"/></li>
            <li><input type="text" name="empresa" value="" id="empresa"  placeholder="Empresa"/></li>
            <li><input type="text" name="telefono" value="" id="telefono" placeholder="Telefono"/></li>
            <li><input type="text" name="fechaPromesa"  id="fechaPromesa" placeholder="Fecha Promesa"/></li>
            <li><input type="text" name="correo" value="" id="correo" placeholder="Correo Electronico"/></li>       
            <li><input type="hidden" id="idVehiculo" name="idVehiculo" value="0" /></li>
            <li><input type="hidden" id="tipoVehiculo" name="tipoVehiculo" value="0" /></li>
            <li><input type="button" name="btnFormVehiculo" value="Paso 2"  id="btnFormVehiculo"  /></li>
        </ul>
        </form>
    </aside>
    <aside class="cont-tab clear" data-opcion="2"  style="display:none;">
   
    </aside>
		</section>  
	</section>        
</section> 

