<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');		
?>
<script type="text/javascript" src="js/funciones_nomina.js"></script>
<section class="contenedor" id="vehiculo"> 
	<aside id="filtro-nomina" class="clear">
        <!-- agregar una orden a un empleado -->
        <form action="nomina/ver_orden" id="form-filtroNomina" method="post">

        <input type="text" class="filtro" name="num_orden" required size="20" placeholder="Orden" />
        <input type="submit" name="btn_filtro" value="Agregar"  />
            
        </form>
       
        
    </aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Nomina<span>>></span></h2>
    
        <? if($this->input->post()) { ?>

        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr  class="persist-header header-tabla">
                    <th>Empleado</th>
                    <th >Orden</th>
                    <th >H y P</th>
                    <th >30%</th>
                    <th >Piezas</th>
                    <th >Pago Pintores</th>
                    <th >Pago Estetico</th>
                    <th >Pago Hojalatero</th>
                    <th >Sugerencia</th>
                    <th >% Pago</th>
                    <th >Avance</th>
                    <th >$ Ant</th>
                    <th >Pago</th>
                    <th >Tipo de Pago</th>
                    <th >Opciones</th>
        
                
                    
                </tr>

        
            </thead>
            <h1>Hojalateria</h2>
            <tbody id="busqueda-vehiculo">
            <form id="form_nomina">
            <?php
            	foreach($orden->result() as $data)
				{
					
			?>
            		<tr class="padre btnMenu">
                        
                        <td align="center">
                            <select name="id_empleado">
                                <? foreach($empleados->result() as $data2){ ?>
                                <option value="<? echo $data2->idEmpleado; ?>"><? echo $data2->nombre." ".$data2->apellidoPat." ".$data2->apellidoMat; ?></option>
                                <? } ?>
                            </select>
                        </td>
                        

                        <td align="center"><? echo $data->clave; ?><input type="hidden" readonly="true" name="id_orden" value="<? echo $data->idOrdenes; ?>"/></td>
                        <td align="center"><? echo $data->monto; ?><input type="hidden" readonly="true" name="hyp" value="<? echo $data->monto; ?>"/></td>
                        <td align="center"><? echo $data->monto * .30; ?><input type="hidden" readonly="true" name="30_percent" value="<? echo $data->monto * .30; ?>"/></td>
                        <td align="center"><? echo $data->piezas; ?><input type="hidden" readonly="true" name="piezas" value="<? echo $data->piezas; ?>"/></td>
                        <td align="center"><? echo $data->pago_pintores; ?><input type="hidden" readonly="true" name="pago_pintores" value="<?  echo $data->piezas * $data->pago_pintores; ?>"/></td>
                        <td align="center"><? echo $data->pago_estetico; ?><input type="hidden" readonly="true" name="pago_estetico" value="<? echo $data->pago_estetico; ?>"/></td>
                        <td align="center"><? echo $data->pago_hojalatero; ?><input type="hidden" readonly="true" name="pago_hojalatero" value="<? echo $data->pago_hojalatero; ?>"/></td>
                        <td align="center"><? echo $data->sugerencia; ?><input type="hidden" readonly="true" name="sugerencias" value="<? echo $data->sugerencia; ?>"/></td>
                        <td align="center"><? echo $data->pago_percent; ?><input type="hidden" readonly="true" name="pago_percent" value="<? echo $data->pago_percent; ?>"/></td>
                        <td align="center"><? echo $data->avance; ?><input type="hidden" readonly="true" name="avance" value="<? echo $data->avance; ?>"/></td>
                        <td align="center"><? echo $data->anticipo; ?><input type="hidden" readonly="true" name="anticipo" value="<? echo $data->anticipo; ?>"/></td>
                        <td align="center"><? echo $data->pago; ?><input type="hidden" readonly="true" name="pago" value="<? echo $data->pago; ?>"/></td>
                        <td align="center"><? echo $data->tipo_de_pago; ?><input type="hidden" readonly="true" name="tipo_pago" value="<? echo $data->tipo_de_pago; ?>"/></td>
                        <td align="center"><a class="link-boton-menu" id="btn_guardar"><i class="icon-ok"></i>Guardar</a></td>
                    </tr>
                    
            <?
				}
			?>
            </form>
            <tbody>
        </table>
        
        <? } ?>



    </section>
</section>


</section> 

