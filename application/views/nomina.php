<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    $fechaW = explode("-",$this->input->post('semana'));
    
    $fechaY = $fechaW[0];
    $fechaWeek = $fechaW[1];

    $semana = substr($fechaWeek,1);

    }
    else
    {
        $fechaY = $date->format('Y');
        $semana = 00;
    }
    
    $dateW = new DateTime();
    $dateW->setISODate($fechaY,$semana,5);
    
?>
<section class="contenedor">  
	<aside id="menu-opciones" class="clear">
		
	</aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Nomina<span>>></span></h2>
<form id="form_fechas" action=""  method="post">
   <div>
       <label for="from">Semana</label>
       <input type="week" value="<? echo $this->input->post('semana'); ?>" name="semana" id="semana" />
   </div>
   <div>
    <label for="from">Desde</label>
    <input type="text" id="from" readonly value="<? echo $from = $dateW->format('Y-m-d'); ?>" name="from" />
    <label for="to">Hasta</label>
    <input type="text" id="to" name="to" readonly value="<? $dateW->modify('+6 days'); echo $to = $dateW->format('Y-m-d'); ?>" />

    <input type="submit" value="Enviar" name="btnFechas" id="btnFechas" />
   </div> 


</form>                   
        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr class="persist-header header-tabla">
                    <th width="69">Nombre</th>
                    <th width="136">Apellidos</th>
                    <th width="132">Area</th>
                    <th width="111">Puesto</th>
                    <th width="238">Cel</th>
                    <th width="162">Tel</th>
                    
                                   
                </tr>
            </thead>
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    foreach($empleados->result() as $emp)
                    {
                ?>
                        <tr class="padre btnMenu" data-id="<? echo $emp->idEmpleado; ?>">
                            <td align="center"><?php echo $emp->nombre?></td>
                            <td align="center"><?php echo $emp->apellidoPat." ".$emp->apellidoMat?></td>
                            <td align="center"><?php echo $emp->area?></td>
                            <td align="center"><?php echo $emp->puesto?></td>
                            <td align="center"><?php echo $emp->cel?></td>
                            <td align="center"><?php echo $emp->tel?></td>


                        </tr>


                        <tr class="hijo" data-id="<? echo $emp->idEmpleado; ?>" style="display:none">
                           <td align="center"><a href="nomina/retenciones/<? echo $semana.'/'.$fechaY.'/'.$emp->idEmpleado.'/'.$from.'/'.$to; ?> " class="link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" ><i class="icon-cogs"></i>Retenciones</a></td>
                           <td align="center"><a href="nomina/pintura/<? echo $semana.'/'.$fechaY.'/'.$emp->idEmpleado.'/'.$from.'/'.$to; ?> " class="link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" ><i class="icon-cogs"></i>Pintura</a></td>
                           <td align="center"><a href="nomina/admin/<? echo $semana.'/'.$fechaY.'/'.$emp->idEmpleado.'/'.$from.'/'.$to; ?> " class="link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" ><i class="icon-cogs"></i>Admin</a></td>
                           <td align="center"><a href="nomina/imprimir/<? echo $semana.'/'.$fechaY.'/'.$emp->idEmpleado; ?> " class="link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" ><i class="icon-cogs"></i>Imprimir Admin</a></td>
                           <td align="center"><a href="nomina/imprimir_pintura/<? echo $semana.'/'.$fechaY.'/'.$emp->idEmpleado; ?> " class="link-boton-modificar link-boton-menu" data-open="vista-modificar-carro" ><i class="icon-cogs"></i>Imprimir Pintura</a></td>
                            <td align="center"><a class="link-abrir link-boton-menu btnCloseMenu" data-id="<?php echo $emp->idEmpleado;?>"><i class="icon-share-alt"></i>Regresar</a></td>
                        </tr>

                    
            	
            <?
                    }
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
      
 
    $(".btnMenu").click(function()
	{
		var id = $(this).attr("data-id");
		
		$(".padre[data-id="+id+"]").fadeOut().hide();
		$(".hijo[data-id="+id+"]").fadeIn().show();
		
	});
	
		$(".btnCloseMenu").click(function()
	{
		var id = $(this).attr("data-id");
		
		$(".padre[data-id="+id+"]").fadeIn().show();
		$(".hijo[data-id="+id+"]").fadeOut().hide();	
		
	});
	  
  });
  </script>
