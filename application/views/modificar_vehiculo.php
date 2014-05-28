<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');
	
	$vehiculo = $datos->row();
	$orden = $orden->row();
		
		
?>

    <form action="vehiculo/agregar_vehiculo" method="post" accept-charset="utf-8" id="form_modVehiculo">
        <ul id="datos">
			<?
				if($orden->aseguradora==1)
				{
			?>
			<li><h2>Datos de la Aseguradora <span>>></span></h2></li>
	        <li>
	            <select name="empresaMod">
	                <option value="mapfre">Mapfre</option>
	                <option value="qualitas">Qualitas</option>
	            </select>
	        </li>
	        <li><input type="text" name="dedusible" value="<?php echo $orden->dedusible;?>" id="dedusible" placeholder="Desdusible"/></li>
	        <li><input type="text" name="fechaSiniestro" value="<?php echo $orden->fechaSiniestro;?>" id="fechaSiniestro" placeholder="Fecha del Siniestro"/></li>
	        <li><input type="text" name="numeroPoliza" value="<?php echo $orden->numeroPoliza;?>" id="numeroPoliza" placeholder="Numero de Poliza"/></li>
	        <li><input type="text" name="numeroReporte" value="<?php echo $orden->numeroReporte;?>" id="numeroReporte" placeholder="Numero de Reporte del Siniestro"/></li>
            
            <?

       			}//end if existe aseguradora
            ?>

            <li><h2>Datos del Vehiculo <span>>></span></h2></li>
            <li><input type="text" name="marcaMod" id="marcaMod" placeholder="Marca"  value="<?php echo $vehiculo->marca;?>" /></li>
            <li><input type="text" name="modeloMod" value="<?php echo $vehiculo->modelo;?>" id="modeloMod" placeholder="Modelo del Vehiculo" /></li>
            <li><select name="yearMod" id="yearMod">
                <option value="">Selecciona el año</option>
				<? 
					for($i=$dateTime+1;$i>=1950;$i--)
					{ 
						if($i == $vehiculo->year)
						{
							echo "<option value=\"$i\" selected=\"selected\">$i</option>";
						}
						else
						{
							echo "<option value=\"$i\">$i</option>";
						}
					} 
                ?>
            	</select></li>
            <li><input type="text" name="colorMod" value="<?php echo $vehiculo->color;?>" id="colorMod" placeholder="Color del Vehiculo" /></li>
            <li><input type="text" name="placasMod" value="<?php echo $vehiculo->placas;?>" id="placasMod" placeholder="Placas del Vehiculo"/></li>
            <li><input type="text" name="vinMod" value="<?php echo $vehiculo->num_VIN;?>" id="vinMod" placeholder="VIN del Vehiculo"/></li>
            <!-- <li><input type="text" name="piezasMod" value="<?php echo $orden->piezas;?>" id="piezasMod" placeholder="Piezas"/></li> -->

            <li><h2>Datos del cliente <span>>></span></h2></li>
            <li><input type="text" name="clienteMod" value="<?php echo $orden->cliente;?>" id="clienteMod" placeholder="Cliente"/></li>
            <?
            if($orden->aseguradora==0){ 
            ?>
            <li>
	            <select name="empresaMod">
	                <option value="particular">Particular</option>
	            </select>
	        </li>
	        <? }
	        if($orden->aseguradora==1){ 
            ?>
	            <li>
	            <select name="empresaMod">
	                <option value="mapfre">Mapfre</option>
	                <option value="qualitas">Qualitas</option>
	            </select>
	        	</li>
	        <? } ?>
            <li><input type="text" name="empresaMod" disabled value="<?php echo $orden->empresa;?>" id="empresaMod"  placeholder="Empresa"/></li>
            <li><input type="text" name="telefonoMod" value="<?php echo $orden->telefono;?>" id="telefonoMod" placeholder="Telefono"/></li>
            <li><input type="text" name="correoMod" value="<?php echo $orden->correo;?>" id="correoMod" placeholder="Correo Electronico"/></li>
            <li><input type="text" name="rfcMod" value="<?php echo $orden->rfc;?>" id="rfcMod" placeholder="RFC"/></li>
            <li><input type="text" name="direccionMod" value="<?php echo $orden->direccion;?>" id="direccionMod" placeholder="Dirección"/></li>
            <li><input type="text" name="celularMod" value="<?php echo $orden->celular;?>" id="celularMod" placeholder="Celular"/></li>
            
           	<?
				if($orden->IVA!=NULL&&$orden->IVA!=""){ $disableIVA = "disable=\"false\"";  } else { $disableIVA = "disable=\"true\"";  }
				if($orden->num_factura!=NULL&&$orden->num_factura!=""){ $disableFac = "disable=\"false\"";  } else { $disableFac = "disable=\"true\"";  }
			?>             
            <li><h2>Datos de Factura <span>>></span></h2></li>
            <li><input type="text" name="fechaPromesaMod"  id="fechaPromesaMod" value="<? echo $orden->fechaPromesa; ?>" placeholder="Fecha Promesa"/></li>
       		<li><input type="text" name="montoMod" value="<?php echo $orden->monto;?>"  id="montoMod" disabled placeholder="Monto"/></li>
        	<li><input type="text" name="ivaMod"  id="ivaMod" value="<? echo $orden->IVA; ?>"  placeholder="IVA" <? echo $disableIVA; ?> /></li>
        	<li><input type="text" name="num_facturaMod"  id="num_facturaMod" value="<? echo $orden->num_factura; ?>" placeholder="Numero de Factura" <? echo $disableFac; ?>/></li>        
        	<li>Factura<input type="checkbox" <? if($orden->factura==1){ echo "checked";} ?>  name="facturaMod" value="1" id="facturaMod"/></li>
            <li><input type="submit" name="btnFormVehiculo" value="Actualizar Vehiculo"  onclick="enviarRegistro()" id="btnFormVehiculo"  /></li>
        </ul>
     	<input type="hidden" id="idVehiculoMod" name="idVehiculoMod" value="<?php echo $vehiculo->idVehiculo;?>" />
      	<input type="hidden" id="idOrdenMod" name="idOrdenMod" value="<?php echo $orden->idOrdenes;?>" />
     </form>


<aside id="modificar-orden">
	
</aside>


<script type="text/javascript">
	$(function(){
	$("#form_modVehiculo").validate({
		  rules: 
		  {
			marcaMod: 
			{
				required: true
			},
			modeloMod: 
			{
				required: true
			},
			placasMod: 
			{
				required: true
			},
			correoMod: 
			{	
				email:true
			},
			empresaMod: 
			{
				required: true
			},
			telefonoMod: 
			{
				required: true
			},
			clienteMod: 
			{
				required: true
			},
			colorMod: 
			{
				required: true
			},
			yearMod:
			{
				required: true
			},
			montoMod:
			{
				required: true
			}
		  
			
		  }//rules
	});//validate

		$("#fechaPromesaMod").datetimepicker({
			addSliderAccess: true,
			dateFormat: "yy-mm-dd",
			sliderAccessArgs: { touchonly: false }
		});

		$("#fechaSiniestro").datetimepicker({
			addSliderAccess: true,
			dateFormat: "yy-mm-dd",
			sliderAccessArgs: { touchonly: false }
		});

	$('#montoMod').number( true, 2 );

	});//ready		


	
$(document).ready(
	function()
	{	
		var idVehiculo = $("#idVehiculoMod").val();
		var idOrden = $("#idOrdenMod").val();


		$("#modificar-orden").load("caracteristicas/verMod",{idVehiculo:idVehiculo,idOrden:idOrden});

});
	

	function enviarRegistro()
	{	
		if($("#form_modVehiculo").valid())
		{
			$.post("index.php/vehiculo/modVehiculo",$("#form_modVehiculo").serialize(),
			function(data)
			{
				alert("Vehiculo Actualizado")
					
			}
			);
		}
		
	}

$('#facturaMod').change(function(){
    var c = this.checked;
	var monto = $("#montoMod").val();
	var iva = 0;
	
	$('#ivaMod').number( true, 2 );
	
   if(c && (monto!=""||monto!=null))
   {
	   
	   
	   iva = monto *.16;
	   
	   $("#ivaMod").val(iva);
	   $("#montoMod").number(true,2).val(monto*1.16);
	   $("#ivaMod").prop('disabled',false);
	   $("#num_facturaMod").prop('disabled',false);
   }
   else
   {
	   var iva = $("#ivaMod").val();
	   monto = monto - iva;
	   $("#montoMod").val(monto);
	   $("#ivaMod").val(null);
	   $("#num_facturaMod").val(null);
	   $("#ivaMod").prop('disabled',true);
	   $("#num_facturaMod").prop('disabled',true);
	   
	}
});	
</script>