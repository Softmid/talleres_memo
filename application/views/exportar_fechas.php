<? 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=");

?>


<section class="contenedor">  
	<aside id="menu-opciones" class="clear">
		
	</aside>
    <section class="despliegue-vehiculo clear">
        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr class="persist-header header-tabla">
                    <th width="38">N°</th>
                    <th width="64">Marca</th>
                    <th width="71">Modelo</th>
                    <th width="73">Placa</th>
                    <th width="117">VIN</th>
                    <th width="108">Monto</th>
                    <th width="85">IVA</th>
                                   
                </tr>
            </thead>
            <?php
            	foreach($fechas->result() as $vehiculo)
				{
			?>
            		<tr>
                    	<td align="center"><?php echo $vehiculo->idOrdenes?></td>
                        <td align="center"><?php echo $vehiculo->marca?></td>
                        <td align="center"><?php echo $vehiculo->modelo?></td>
                        <td align="center"><?php echo $vehiculo->placas?></td>
                        <td align="center"><?php echo $vehiculo->num_VIN?></td>
                        <td align="center">$ <?php echo number_format($vehiculo->monto,2)?></td>
                        <td align="center">$ <?php echo number_format($vehiculo->IVA,2)?></td>
                        
                     
                    </tr>
            <?
				}
			?>
        </table>
    </section>
</section>







