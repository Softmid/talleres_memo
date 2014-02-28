<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');	
	foreach($datos->result() as $ver )
	{
?>
   
    <form id="form_usuariosMod" accept-charset="utf-8">
        <ul id="datos">
        
            <li><h2>Datos del Usuario <span>>></span></h2></li>
            
            <li><input type="text" name="nombreMod" value="<? echo $ver->nombre ?>" id="nombreMod" placeholder="Nombre" /></li>
            <li><input type="text" name="apellido_patMod" value="<? echo $ver->apellido_pat ?>" id="apellido_patMod" placeholder="Apellido Paterno"/></li>
            <li><input type="text" name="apellido_matMod" value="<? echo $ver->apellido_mat ?>" id="apellido_matMod" placeholder="Apellido Materno" /></li>
            <li><input type="text" name="usernameMod" value="<? echo $ver->username ?>" id="usernameMod" placeholder="Usuario" /></li>
            <li><select name="privilegiosMod">
            <option value="">Seleccione sus Privilegios</option>
            <option <? if($ver->privilegios == 1){ echo "selected";} ?> value="1">Administrador</option>
            <option <? if($ver->privilegios == 2){ echo "selected";} ?> value="2">Normal</option>
            </select></li>
            <li><h2>Cambio de Contrase&ntilde;a <span>>></span></h2></li>
           <li><input type="password" name="passwordMod" id="passwordMod" placeholder="Contrase&ntilde;a" /></li>
            <li><input type="password" name="password_confMod" id="password_confMod" placeholder="Repetir Contrase&ntilde;a" /></li>
            
            <li><input type="button" name="btnFormUsuarios" value="Agregar Usuario" onclick="enviarRegistro();" id="btnFormUsuarios"  /></li>
        </ul>
        
        <input type="hidden" name="idUsuarios" value="<?php echo $ver->idUsuarios;?>" />
	</form>

<?
	}
?>

<script type="text/javascript">
	$(function(){
	$("#form_usuariosMod").validate({
		  rules: 
		  {
		
		  	
			password_conf: 
			{
				equalTo: "#passwords" 
			},
			username:
		  {		
		  		required: true,
		  },
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
		  },
		  privilegios:
		  {
			  required: true
		  }
			
		  }//rules
	});//validate
	});//ready		

	function enviarRegistro()
	{	
		if($("#form_usuariosMod").valid())
		{   
			
			$.post("index.php/usuario/modUsuario",$("#form_usuariosMod").serialize(),
			function(data)
			{
				$('#btnFormUsuarios').after(function () {
					$('#cuadro_modificar').append(data);
					$('#cuadro_modificar').dialog('open');
					return false;
				});
			
			}
			);
		}
		
	}	
</script>

