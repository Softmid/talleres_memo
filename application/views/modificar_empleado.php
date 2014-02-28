<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');	
	foreach($datos->result() as $ver )
	{
?>
   
    <form id="form_empleadoMod" accept-charset="utf-8">
        <ul id="datos">
        
            <li><h2>Datos del Empleado <span>>></span></h2></li>
            
            <li><input type="text" name="nombreMod" value="<? echo $ver->nombre ?>" id="nombreMod" placeholder="Nombre" /></li>
            <li><input type="text" name="apellido_patMod" value="<? echo $ver->apellidoPat ?>" id="apellido_patMod" placeholder="Apellido Paterno"/></li>
            <li><input type="text" name="apellido_matMod" value="<? echo $ver->apellidoMat ?>" id="apellido_matMod" placeholder="Apellido Materno" /></li>
            <li><input type="text" name="direccionMod" value="<? echo $ver->direccion ?>" id="direccionMod" placeholder="Direcci&oacute;n" /></li>
            <li><input type="text" name="telMod" value="<? echo $ver->tel ?>" id="telMod" placeholder="Telefono" /></li> 
            <li><input type="text" name="celMod" value="<? echo $ver->cel ?>" id="celMod" placeholder="Celular" /></li> 
            <li><input type="text" name="areaMod" value="<? echo $ver->area ?>" id="areaMod" placeholder="Area" /></li>
            <li><input type="text" name="puestoMod" value="<? echo $ver->puesto ?>" id="puestoMod" placeholder="Puesto" /></li>
           
        </ul>
        
        <input type="hidden" name="idEmpleado" value="<?php echo $ver->idEmpleado;?>" />
	</form>

<?
	}
?>

<script type="text/javascript">
	$(function(){
	$("#form_empleadoMod").validate({
		  rules: 
		  {		  	
			
		  nombre:
		  {
			  required: true,
			  minlength: 2,
			  maxlength: 30
		  },
		  apellido_pat:
		  {
			  required: true,
			  minlength: 2,
			  maxlength: 30
		  },
		  apellido_mat:
		  {
			  required: true,
			  minlength: 2,
			  maxlength: 30
		  }
		  
		  }//rules
	});//validate
	});//ready		

	function enviarRegistro()
	{	
		if($("#form_empleadoMod").valid())
		{   
			
			$.post("index.php/empleado/mod",$("#form_empleadoMod").serialize(),
			function(data)
			{
				$('#btnFormEmpleado').after(function () {
					$('#cuadro_modificar').append(data);
					$('#cuadro_modificar').dialog('open');
					return false;
				});
			
			}
			);
		}
		
	}	
</script>

