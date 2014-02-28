<?
    date_default_timezone_set('Mexico/General');
    $date = new DateTime('NOW');
    $dateTime = $date->format('Y');  
   
?>

<script type="text/javascript" src="js/funciones-vehiculo.js"></script>
<section class="contenedor" id="vehiculo">  
    
    <!-- tabla de atrasados -->
    <section class="despliegue-vehiculo clear">
        <h2>Atrasados<span>>></span> </h2>
        <!-- <aside class="buscador">
            <div class="input-prepend">
                <span class="add-on" style="float:left;"><i class="icon-search"></i></span>
                <input type="text" id="input_buscador" placeholder="Buscar numero de orden" style="">
            </div>
        </aside> -->
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
                foreach($atrasado->result() as $atrasado)
                {
                    if($atrasado->numero > 0){$valor = ' si';} else {$valor = '';}
            ?>
                    <tr class="padre btnMenu" data-id="<? echo $atrasado->clave; ?>">
                        <td align="center"><?php echo $atrasado->clave?></td>
                        <td align="center"><?php echo $atrasado->marca?></td>
                        <td align="center"><?php echo $atrasado->modelo?></td>
                        <td align="center"><?php echo $atrasado->color?></td>
                        <td align="center"><?php echo $atrasado->empresa?></td>
                        <td align="center">$ <?php echo number_format($atrasado->monto,2)?></td>
                        <td align="center">$ <?php echo number_format($atrasado->gastos,2)?></td>                    
                        <td align="center">$ <?php echo $total = number_format($atrasado->monto - $atrasado->gastos,2);?></td>
                        <td style="color:#F00;" align="center"><?php echo $this->funciones->convertir_fecha($atrasado->fechaPromesa);?></td>
                    </tr>
                    <?php /* despliegue menu */?>
                    <tr class="hijo" data-id="<? echo $atrasado->clave; ?>" style="display:none">
                       <td align="center"><a class="link-ajax link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" data-link="modificar-vehiculo" data-ajax="form-modificar-carro" data-url="index.php/vehiculo/modificarVehiculo" data-id="<?php echo $atrasado->idVehiculo?>" data-idOrden="<?php echo $atrasado->idOrdenes?>" ><i class="icon-cogs"></i>Modificar</a></td>
                        <!-- <td align="center"><a class=" link-abrir link-boton link-abrir-post modificar-caracteristica" data-open="form-modificar-caracteristica" data-link="modificar-caracteristica" data-url="caracteristicas/verMod" data-id="<?php echo $atrasado->idVehiculo?>" data-width="900">Ordenes</a></td> -->
                        <td align="center"><a class="link-ajax link-boton-menu <?php echo $valor?>" data-id="<?php echo $atrasado->idVehiculo?>" data-idOrden="<? echo $atrasado->idOrdenes ?>"  data-open="vista-gastos-vehiculo" data-link="gastos-vehiculo" data-url="index.php/vehiculo/ver_gastos_vehiculo" data-ajax="form-gastos-vehiculo" ><i class="icon-shopping-cart"></i>Gastos</a></td>
                        <td align="center"><a class=" link-boton-menu" href="index.php/vehiculo/imprecionOrden/<?php echo $atrasado->idVehiculo?>/<?php echo $atrasado->idOrdenes?>" data-open="" data-url="" data-id="<?php echo $atrasado->idVehiculo;?>"><i class="icon-print"></i>Imprimir</a></td> 
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-url="index.php/orden/C_cancelarOrden" data-open="cancelarOrden" data-id="<?php echo $atrasado->idOrdenes;?>"><i class="icon-remove"></i>Cancelar</a></td>                     
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-open="finalizarOrden" data-url="index.php/orden/C_finalizarOrden" data-id="<?php echo $atrasado->idOrdenes;?>"><i class="icon-ok"></i>Finalizar</a></td>                    
                        <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $atrasado->clave;?>"><i class="icon-share-alt"></i>Regresar</a></td>
                    </tr>
            <?
                }
            ?>
            <tbody>
        </table>

        </aside>
    </section>

    <!-- tabla de hoy -->
    <section class="despliegue-vehiculo clear">
        <h2>Hoy<span>>></span> </h2>
        <!-- <aside class="buscador">
            <div class="input-prepend">
                <span class="add-on" style="float:left;"><i class="icon-search"></i></span>
                <input type="text" id="input_buscador" placeholder="Buscar numero de orden" style="">
            </div>
        </aside> -->
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
                foreach($hoy->result() as $hoy)
                {
                    if($hoy->numero > 0){$valor = ' si';} else {$valor = '';}
            ?>
                    <tr class="padre btnMenu" data-id="<? echo $hoy->clave; ?>">
                        <td align="center"><?php echo $hoy->clave?></td>
                        <td align="center"><?php echo $hoy->marca?></td>
                        <td align="center"><?php echo $hoy->modelo?></td>
                        <td align="center"><?php echo $hoy->color?></td>
                        <td align="center"><?php echo $hoy->empresa?></td>
                        <td align="center">$ <?php echo number_format($hoy->monto,2)?></td>
                        <td align="center">$ <?php echo number_format($hoy->gastos,2)?></td>                    
                        <td align="center">$ <?php echo $total = number_format($hoy->monto - $hoy->gastos,2);?></td>
                        <td style="color:#F00;" align="center"><?php echo $this->funciones->convertir_fecha($hoy->fechaPromesa);?></td>
                    </tr>
                    <?php /* despliegue menu */?>
                    <tr class="hijo" data-id="<? echo $hoy->clave; ?>" style="display:none">
                       <td align="center"><a class="link-ajax link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" data-link="modificar-vehiculo" data-ajax="form-modificar-carro" data-url="index.php/vehiculo/modificarVehiculo" data-id="<?php echo $hoy->idVehiculo?>" data-idOrden="<?php echo $hoy->idOrdenes?>" ><i class="icon-cogs"></i>Modificar</a></td>
                        <!-- <td align="center"><a class=" link-abrir link-boton link-abrir-post modificar-caracteristica" data-open="form-modificar-caracteristica" data-link="modificar-caracteristica" data-url="caracteristicas/verMod" data-id="<?php echo $hoy->idVehiculo?>" data-width="900">Ordenes</a></td> -->
                        <td align="center"><a class="link-ajax link-boton-menu <?php echo $valor?>" data-id="<?php echo $hoy->idVehiculo?>" data-idOrden="<? echo $hoy->idOrdenes ?>"  data-open="vista-gastos-vehiculo" data-link="gastos-vehiculo" data-url="index.php/vehiculo/ver_gastos_vehiculo" data-ajax="form-gastos-vehiculo" ><i class="icon-shopping-cart"></i>Gastos</a></td>
                        <td align="center"><a class=" link-boton-menu" href="index.php/vehiculo/imprecionOrden/<?php echo $hoy->idVehiculo?>/<?php echo $hoy->idOrdenes?>" data-open="" data-url="" data-id="<?php echo $hoy->idVehiculo;?>"><i class="icon-print"></i>Imprimir</a></td> 
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-url="index.php/orden/C_cancelarOrden" data-open="cancelarOrden" data-id="<?php echo $hoy->idOrdenes;?>"><i class="icon-remove"></i>Cancelar</a></td>                     
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-open="finalizarOrden" data-url="index.php/orden/C_finalizarOrden" data-id="<?php echo $hoy->idOrdenes;?>"><i class="icon-ok"></i>Finalizar</a></td>                    
                        <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $hoy->clave;?>"><i class="icon-share-alt"></i>Regresar</a></td>
                    </tr>
            <?
                }
            ?>
            <tbody>
        </table>

        </aside>
    </section>

     <!-- tabla de mañana-->
    <section class="despliegue-vehiculo clear">
        <h2>Mañana<span>>></span> </h2>
        <!-- <aside class="buscador">
            <div class="input-prepend">
                <span class="add-on" style="float:left;"><i class="icon-search"></i></span>
                <input type="text" id="input_buscador" placeholder="Buscar numero de orden" style="">
            </div>
        </aside> -->
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


       

                foreach($tomorrow->result() as $tomorrow)
                {
                    if($tomorrow->numero > 0){$valor = ' si';} else {$valor = '';}
            ?>
                    <tr class="padre btnMenu" data-id="<? echo $tomorrow->clave; ?>">
                        <td align="center"><?php echo $tomorrow->clave?></td>
                        <td align="center"><?php echo $tomorrow->marca?></td>
                        <td align="center"><?php echo $tomorrow->modelo?></td>
                        <td align="center"><?php echo $tomorrow->color?></td>
                        <td align="center"><?php echo $tomorrow->empresa?></td>
                        <td align="center">$ <?php echo number_format($tomorrow->monto,2)?></td>
                        <td align="center">$ <?php echo number_format($tomorrow->gastos,2)?></td>                    
                        <td align="center">$ <?php echo $total = number_format($tomorrow->monto - $tomorrow->gastos,2);?></td>
                        <td style="color:#F00;" align="center"><?php echo $this->funciones->convertir_fecha($tomorrow->fechaPromesa);?></td>
                    </tr>
                    <?php /* despliegue menu */?>
                    <tr class="hijo" data-id="<? echo $tomorrow->clave; ?>" style="display:none">
                       <td align="center"><a class="link-ajax link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" data-link="modificar-vehiculo" data-ajax="form-modificar-carro" data-url="index.php/vehiculo/modificarVehiculo" data-id="<?php echo $tomorrow->idVehiculo?>" data-idOrden="<?php echo $tomorrow->idOrdenes?>" ><i class="icon-cogs"></i>Modificar</a></td>
                        <!-- <td align="center"><a class=" link-abrir link-boton link-abrir-post modificar-caracteristica" data-open="form-modificar-caracteristica" data-link="modificar-caracteristica" data-url="caracteristicas/verMod" data-id="<?php echo $tomorrow->idVehiculo?>" data-width="900">Ordenes</a></td> -->
                        <td align="center"><a class="link-ajax link-boton-menu <?php echo $valor?>" data-id="<?php echo $tomorrow->idVehiculo?>" data-idOrden="<? echo $tomorrow->idOrdenes ?>"  data-open="vista-gastos-vehiculo" data-link="gastos-vehiculo" data-url="index.php/vehiculo/ver_gastos_vehiculo" data-ajax="form-gastos-vehiculo" ><i class="icon-shopping-cart"></i>Gastos</a></td>
                        <td align="center"><a class=" link-boton-menu" href="index.php/vehiculo/imprecionOrden/<?php echo $tomorrow->idVehiculo?>/<?php echo $tomorrow->idOrdenes?>" data-open="" data-url="" data-id="<?php echo $tomorrow->idVehiculo;?>"><i class="icon-print"></i>Imprimir</a></td> 
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-url="index.php/orden/C_cancelarOrden" data-open="cancelarOrden" data-id="<?php echo $tomorrow->idOrdenes;?>"><i class="icon-remove"></i>Cancelar</a></td>                     
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-open="finalizarOrden" data-url="index.php/orden/C_finalizarOrden" data-id="<?php echo $tomorrow->idOrdenes;?>"><i class="icon-ok"></i>Finalizar</a></td>                    
                        <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $tomorrow->clave;?>"><i class="icon-share-alt"></i>Regresar</a></td>
                    </tr>
            <?
                }
            ?>
            <tbody>
        </table>

        </aside>
    </section>

     <!-- tabla de pasado mañana -->
    <section class="despliegue-vehiculo clear">
        <h2>Pasado Mañana<span>>></span> </h2>
        <!-- <aside class="buscador">
            <div class="input-prepend">
                <span class="add-on" style="float:left;"><i class="icon-search"></i></span>
                <input type="text" id="input_buscador" placeholder="Buscar numero de orden" style="">
            </div>
        </aside> -->
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
                foreach($afterTomorrow->result() as $afterTomorrow)
                {
                    if($afterTomorrow->numero > 0){$valor = ' si';} else {$valor = '';}
            ?>
                    <tr class="padre btnMenu" data-id="<? echo $afterTomorrow->clave; ?>">
                        <td align="center"><?php echo $afterTomorrow->clave?></td>
                        <td align="center"><?php echo $afterTomorrow->marca?></td>
                        <td align="center"><?php echo $afterTomorrow->modelo?></td>
                        <td align="center"><?php echo $afterTomorrow->color?></td>
                        <td align="center"><?php echo $afterTomorrow->empresa?></td>
                        <td align="center">$ <?php echo number_format($afterTomorrow->monto,2)?></td>
                        <td align="center">$ <?php echo number_format($afterTomorrow->gastos,2)?></td>                    
                        <td align="center">$ <?php echo $total = number_format($afterTomorrow->monto - $afterTomorrow->gastos,2);?></td>
                        <td style="color:#F00;" align="center"><?php echo $this->funciones->convertir_fecha($afterTomorrow->fechaPromesa);?></td>
                    </tr>
                    <?php /* despliegue menu */?>
                    <tr class="hijo" data-id="<? echo $afterTomorrow->clave; ?>" style="display:none">
                       <td align="center"><a class="link-ajax link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" data-link="modificar-vehiculo" data-ajax="form-modificar-carro" data-url="index.php/vehiculo/modificarVehiculo" data-id="<?php echo $afterTomorrow->idVehiculo?>" data-idOrden="<?php echo $afterTomorrow->idOrdenes?>" ><i class="icon-cogs"></i>Modificar</a></td>
                        <!-- <td align="center"><a class=" link-abrir link-boton link-abrir-post modificar-caracteristica" data-open="form-modificar-caracteristica" data-link="modificar-caracteristica" data-url="caracteristicas/verMod" data-id="<?php echo $afterTomorrow->idVehiculo?>" data-width="900">Ordenes</a></td> -->
                        <td align="center"><a class="link-ajax link-boton-menu <?php echo $valor?>" data-id="<?php echo $afterTomorrow->idVehiculo?>" data-idOrden="<? echo $afterTomorrow->idOrdenes ?>"  data-open="vista-gastos-vehiculo" data-link="gastos-vehiculo" data-url="index.php/vehiculo/ver_gastos_vehiculo" data-ajax="form-gastos-vehiculo" ><i class="icon-shopping-cart"></i>Gastos</a></td>
                        <td align="center"><a class=" link-boton-menu" href="index.php/vehiculo/imprecionOrden/<?php echo $afterTomorrow->idVehiculo?>/<?php echo $afterTomorrow->idOrdenes?>" data-open="" data-url="" data-id="<?php echo $afterTomorrow->idVehiculo;?>"><i class="icon-print"></i>Imprimir</a></td> 
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-url="index.php/orden/C_cancelarOrden" data-open="cancelarOrden" data-id="<?php echo $afterTomorrow->idOrdenes;?>"><i class="icon-remove"></i>Cancelar</a></td>                     
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-open="finalizarOrden" data-url="index.php/orden/C_finalizarOrden" data-id="<?php echo $afterTomorrow->idOrdenes;?>"><i class="icon-ok"></i>Finalizar</a></td>                    
                        <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $afterTomorrow->clave;?>"><i class="icon-share-alt"></i>Regresar</a></td>
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


<section id="cancelarOrden" title="Cancelar Orden" style="display:none;">
    <p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>¿Estás seguro que desea cancelar esta orden?, porque no se podrá recuperar después</p>
</section>

<section id="finalizarOrden" title="Finalizar Orden" style="display:none;">
    <p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>¿Estás seguro que desea finalizar esta orden, si continua no podra ingresar mas gastos en esta orden</p>
</section>

<section id="cuadro_modificar" title="Eliminar Vehiculo" style="display:none;">
    <p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>El registro se ha modificado con: </p>
</section>



