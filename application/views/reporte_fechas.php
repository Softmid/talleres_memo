<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');	

?>
<section class="contenedor">  
	<aside id="menu-opciones" class="clear">
		
	</aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Vehiculos<span>>></span><? if($this->input->post('from')){ ?> 
        <a href="index.php/reportes/C_ver_exportarFechas/<? echo $this->input->post('from') ?>/<? echo $this->input->post('to'); ?>" class="link-abrir boton-categoria"  >Excel</a> <?  } ?></h2>
<form id="form_fechas" action="index.php/reportes/C_ver_reportesFechas"  method="post">        
<label for="from">Desde</label>
<input type="text" id="from" value="<? echo $this->input->post('from'); ?>" name="from" />
<label for="to">Hasta</label>
<input type="text" id="to" name="to" value="<? echo $this->input->post('to'); ?>" />
<input type="submit" value="Enviar" name="btnFechas" id="btnFechas" />
</form>        
        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr class="persist-header header-tabla">
                    <th width="69">N°</th>
                    <th width="136">Marca</th>
                    <th width="132">Modelo</th>
                    <th width="111">Placa</th>
                    <th width="238">VIN</th>
                    <th width="162">Monto</th>
                    <th width="130">IVA</th>
                                   
                </tr>
            </thead>
            <?php
            	foreach($fechas->result() as $vehiculo)
				{
			?>
            		<tr>
                    	<td align="center"><?php echo $vehiculo->clave?></td>
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




<section id="form-modificar-carro" title="Formulario Modificar Vehiculo" style="display:none;">
	
</section>
<script>
	$(".sacar-orden").click(function()
	{
		var id = $(this).attr("data-idOrden");
		$("#idVehiculoOrden").val(id);
	}
	);
</script>



 <script>
  $(function() {
	  
	 
	  
    $( "#from" ).datepicker({
      defaultDate: "-1m",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
		$( "#from" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "-1m",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
		$( "#to" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
      }
    });
  });
  </script>
