 <?php
                foreach($vehiculos->result() as $vehiculo)
                {
                    if($vehiculo->numero > 0){$valor = ' si';} else {$valor = '';}
                    if($vehiculo->entregado == 1){$valor = ' si';} else {$valor = '';}
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
                        <td align="center"><a class=" link-boton-menu" href="index.php/vehiculo/impresionCorbata/<?php echo $vehiculo->idVehiculo?>/<?php echo $vehiculo->idOrdenes?>"><i class="icon-print"></i>Imprimir Corbata</a></td> 
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar <?php echo $valor?>" data-open="entregarVehiculo" data-url="index.php/vehiculo/entregado"  data-id="<?php echo $vehiculo->idOrdenes;?>"><i class="icon-ok"></i>Entregado</a></td>
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-url="index.php/orden/C_cancelarOrden" data-open="cancelarOrden" data-id="<?php echo $vehiculo->idOrdenes;?>"><i class="icon-remove"></i>Cancelar</a></td>                     
                        <td align="center"><a class="link-abrir-cuadro link-boton-menu link-boton-finalizar" data-open="finalizarOrden" data-url="index.php/orden/C_finalizarOrden" data-id="<?php echo $vehiculo->idOrdenes;?>"><i class="icon-ok"></i>Finalizar</a></td>

                        <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $vehiculo->clave;?>"><i class="icon-share-alt"></i>Regresar</a></td>
                    </tr>
            <?
                }
            ?>
<script type="text/javascript" src="js/funciones-vehiculo.js"></script>
