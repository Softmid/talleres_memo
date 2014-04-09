<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');		
?>

<script type="text/javascript" src="js/funciones-vehiculo.js"></script>
<section class="contenedor" id="vehiculo">  
	<aside id="menu-opciones" class="clear">
		<a class="link-ajax link-boton" data-open="vista-agregar-carro" data-link="agregar-vehiculo" data-ajax="form-agregar-carro" data-url="vehiculo/verFormParticular" data-visible="form-agregar-carro">Agregar Vehiculo</a>
	</aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Vehiculos<span>>></span> <a class="link-abrir boton-categoria" data-open="form_agregarCategorias" data-link="boton-categoria" data-width="800">Nueva Categoria</a></h2>
        <aside class="buscador">
            <div class="input-prepend">
                <span class="add-on" style="float:left;"><i class="icon-search"></i></span>
                <input type="text" id="input_buscador" placeholder="Buscar numero de orden" style="">
            </div>
        </aside>
        <script type="text/javascript">
            $(function(){
                $('#input_buscador').keypress(function(event){
                    var numeroLetras = $(this).val();
                    if(numeroLetras.length != 0)
                    {

                        if ( event.keyCode == 13 ) {

                    
                            $.post("vehiculo/ajax_vehiculo", {busqueda: ""+numeroLetras+""}, function(data) 
                            {
                                $('#busqueda-vehiculo').html(data);
                            });

                        }
                    }
                    // else
                    // {
                    //     $("#tablaPrincipal").load("vehiculo/ver_vehiculo");
                    // }
                    
                });
            });
        </script>
        <div id="paginacion">
            <? echo $this->pagination->create_links(); ?>
        </div>
        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr  class="persist-header header-tabla">
                    <th width="74">N°</th>
                    <th width="113">Marca</th>
                    <th width="111">Modelo</th>
                    <th width="94">Color</th>
                    <th width="139">Empresa</th>
                    <th width="100">Monto</th>
                    <th width="73">Gastos</th>
                    <th width="74">Monto-Gastos</th>
                    <th width="200">Fecha Promesa</th>                    
                </tr>

        
            </thead>
            <aside id="tablaPrincipal">
            <tbody id="busqueda-vehiculo">
            <?php
            	foreach($vehiculos->result() as $vehiculo)
				{
					if($vehiculo->numero > 0){$valor = ' si';} else {$valor = '';}
                    if($vehiculo->entregado == 1){$entregado = 'link-boton-menu si';} else {$entregado = 'link-abrir-cuadro link-boton-menu link-boton-finalizar ';}
			?>
            		<tr class="padre btnMenu" data-id="<? echo $vehiculo->clave; ?>">
                    	<td align="center"><?php echo $vehiculo->clave?></td>
                        <td align="center"><?php echo $vehiculo->marca?></td>
                        <td align="center"><?php echo $vehiculo->modelo?></td>
                        <td align="center"><?php echo $vehiculo->color?></td>
                        <td align="center"><?php echo $vehiculo->empresa?></td>
                        <td align="center">$ <?php echo number_format($vehiculo->monto,2)?></td>
                        <td align="center">$ <?php echo number_format($vehiculo->gastos,2)?></td>                    
                        <td align="center">$ <?php echo $total = number_format($vehiculo->monto - $vehiculo->gastos,2);?></td>
                        <td style="color:#F00;" align="center"><?php echo $this->funciones->convertir_fecha($vehiculo->fechaPromesa);?></td>
                    </tr>
                    <?php /* despliegue menu */?>
                    <tr class="hijo" data-id="<? echo $vehiculo->clave; ?>" style="display:none">
                       <td align="center"><a href="index.php/vehiculo/modificarVehiculo/<?php echo $vehiculo->idVehiculo?>/<?php echo $vehiculo->idOrdenes?>" class="link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" ><i class="icon-cogs"></i>Modificar</a></td>
                        <!-- <td align="center"><a class=" link-abrir link-boton link-abrir-post modificar-caracteristica" data-open="form-modificar-caracteristica" data-link="modificar-caracteristica" data-url="caracteristicas/verMod" data-id="<?php echo $vehiculo->idVehiculo?>" data-width="900">Ordenes</a></td> -->
                        <td align="center"><a class="link-ajax link-boton-menu <?php echo $valor?>" data-id="<?php echo $vehiculo->idVehiculo?>" data-idOrden="<? echo $vehiculo->idOrdenes ?>"  data-open="vista-gastos-vehiculo" data-link="gastos-vehiculo" data-url="index.php/vehiculo/ver_gastos_vehiculo" data-ajax="form-gastos-vehiculo" ><i class="icon-shopping-cart"></i>Gastos</a></td>
                        <td align="center"><a class=" link-boton-menu" href="index.php/vehiculo/impresionOrden/<?php echo $vehiculo->idVehiculo?>/<?php echo $vehiculo->idOrdenes?>"><i class="icon-print"></i>Imprimir Orden</a></td> 
                        <?php if($vehiculo->corbata==0 || $this->session->userdata('privilegios')==1) { ?><td align="center"><a class=" link-boton-menu" href="index.php/vehiculo/impresionCorbata/<?php echo $vehiculo->idVehiculo?>/<?php echo $vehiculo->idOrdenes?>"><i class="icon-print"></i>Imprimir Corbata</a></td> <? } ?>
                        <td align="center"><a class="<?php echo $entregado?>" data-open="entregarVehiculo" data-url="index.php/vehiculo/entregado"  data-id="<?php echo $vehiculo->idOrdenes;?>"><i class="icon-ok"></i>Entregado</a></td>
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-url="index.php/orden/C_cancelarOrden" data-open="cancelarOrden" data-id="<?php echo $vehiculo->idOrdenes;?>"><i class="icon-remove"></i>Cancelar</a></td>                     
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-open="finalizarOrden" data-url="index.php/orden/C_finalizarOrden" data-id="<?php echo $vehiculo->idOrdenes;?>"><i class="icon-ok"></i>Finalizar</a></td>

                        <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $vehiculo->clave;?>"><i class="icon-share-alt"></i>Regresar</a></td>
                    </tr>
            <?
				}
			?>
            <tbody>
        </table>

        </aside>
    </section>
</section>

        
	



<section id="form-modificar-caracteristica" title="Formulario Modificar Caracteristica" style="display:none;">
	
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

<section class="contenedor" id="vista-gastos-vehiculo" style="display:none;">
    <aside id="menu-opciones" class="clear">
        <a class="link-boton regresar" data-oculto="vista-gastos-vehiculo" data-ajax="form-gastos-vehiculo" data-visible="vehiculo">Regresar</a>
    </aside>
    <section id="form-gastos-vehiculo">
    
    </section>
</section>

<?php include 'inc/include/categoria.php';?>

<section id="entregarVehiculo" title="Entregar Vehiculo" style="display:none;">
    <p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>¿Está seguro que el vehiculo ya ha sido entregado?</p>
</section>

<section id="cancelarOrden" title="Cancelar Orden" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>¿Estás seguro que desea cancelar esta orden?, porque no se podrá recuperar después</p>
</section>

<section id="finalizarOrden" title="Finalizar Orden" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>¿Estás seguro que desea finalizar esta orden, si continua no podra ingresar mas gastos en esta orden</p>
</section>

<section id="cuadro_modificar" title="Eliminar Vehiculo" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>El registro se ha modificado con: </p>
</section>



