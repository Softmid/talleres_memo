<section class="contenedor">  
	<aside id="menu-opciones" class="clear">
		<a class="link-abrir link-boton boton-abrir-form" data-width="400" data-open="form-agregar-gastosFijos" data-link="boton-abrir-form">Agragar Gastos Fijos</a>
	</aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Gastos<span>>></span>
      <? if($this->input->post('from')){ ?>  <a href="index.php/reportes/excelGastosFijos/<? echo $this->input->post('from') ?>/<? echo $this->input->post('to'); ?>" class="link-abrir boton-categoria"  >Excel</a> <?  } ?></h2>
<form id="form_fechas" action="index.php/reportes/C_ver_reporteGastos"  method="post">        
<label for="from">Desde</label>
<input type="text" id="from" value="<? echo $this->input->post('from'); ?>" name="from" />
<label for="to">Hasta</label>
<input type="text" id="to" name="to" value="<? echo $this->input->post('to'); ?>" />
<input type="submit" value="Enviar" name="btnFechas" id="btnFechas" />
</form>   
        </h2>
        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr class="persist-header header-tabla">
                    <th width="280">Tipo de Gasto</th>
                    <th width="145">Monto</th>
                    <th width="212">Fecha del Gasto</th>
                    <th width="281">Realizo el Pago</th>
                </tr>
            </thead>
            <?php
				$total = 0;
            	foreach($gastos->result() as $gasto)
				{
					$total += $gasto->monto;
					$fecha = $this->funciones->convertir_fecha($gasto->fecha_hora);
			?>
            		<tr>
                    	<td><?php echo $gasto->concepto?></td>
                        <td align="center">$ <?php echo number_format($gasto->monto,2); ?></td>
                        <td align="center"><?php echo $fecha; ?></td>
                        <td align="center"><?php echo $gasto->nombre.' '.$gasto->apellido_pat.' '.$gasto->apellido_mat; ?></td>
                    </tr>
            <?
				}
			?>
            <tfoot>
            	<tr>
                    <th width="296">Total</th>
                    <th width="156">$ <?php echo number_format($total,2);?></th>
                    <th width="226"></th>
                    <th width="300"></th>
                </tr>
            </tfoot>
        </table>
    </section>
</section>

<section id="form-agregar-gastosFijos" title="Formulario Gastos Fijos" style="display:none;">
    <form id="form_gastosFijos" accept-charset="utf-8">
        <ul id="datos">
            <li><h2>Gastos Fijos <span>>></span></h2></li>
            <li><input type="text" name="concepto" id="concepto" placeholder="Descripcion" /></li>
            <li><input type="text" name="monto"  id="monto" placeholder="Monto"/></li>
            <li><input type="button" name="btnForm_gastosFijos" value="Agregar Gasto" onclick="enviarForm();" id="btnForm_gastosFijos"  /></li>
        </ul>
    </form>
    <script type="text/javascript">
		
    </script>
</section>

<section id="cuadro_procesoExito" title="Agregar Gasto" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>Gasto Agregado Exitosamente!.</p>
</section>

<script type="text/javascript">
$(function(){
    $("#form_gastosFijos").validate({
		  rules: 
		  {
			concepto: 
			{
				required: true
			},
			 monto: 
			{
				required: true,
				number: true
			}
						
		  }//rules
	});//validate
});//ready		

function enviarForm()
{		
	if($("#form_gastosFijos").valid())
	{
		
		$.post("index.php/gastos/C_Agregar_gastosFijos",$("#form_gastosFijos").serialize(),
		function(data)
		{
			$('#btnForm_gastosFijos').after(function () {
				$('#cuadro_procesoExito').dialog('open');
				return false;
			});
			$("#form_gastosFijos").reset();	
		}
		);
	}
}	
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
