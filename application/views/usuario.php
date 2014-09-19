<section class="contenedor">  
	<aside id="menu-opciones" class="clear">
		<a class="link-abrir link-boton boton-abrir-form" data-width="500" data-open="form-agregar-usuario" data-link="boton-abrir-form">Agregar Usuario</a>
	</aside>
	<section class="despliegue-vehiculo clear">
		<h2>Usuarios<span>>></span></h2>
		<nav class="clear">
			<ul class="clear">
				<? 
				foreach($usuarios->result() as $usuario)
				{
				?>
					<li>
						<h3 class="titulo no-center">Nombre Usuario: <span><?php echo $usuario->nombre?></span></h3>
						<h3 class="titulo no-center">Nombre Usuario: <span><?php echo $usuario->apellido_pat.' '.$usuario->apellido_mat?></span></h3>
						 <h3 class="titulo no-center">Username: <span><?php echo $usuario->username;?></span></h3>
						 <h3 class="titulo no-center">Privilegio: <span><?php echo $usuario->privilegios;?></span></h3>
						<aside class="boton-ab">
							<a href="index.php/usuario/C_eliminarUsuario/<? echo $usuario->idUsuarios ?>" class="link-abrir link-boton-eliminar borrar-link" ><i class="icon-remove"></i></a>
							<a class="link-abrir-post link-boton-modificar modificar-usuario" data-open="form-modificar-usuario" data-link="modificar-usuario" data-url="index.php/usuario/modificarUsuario" data-id="<?php echo $usuario->idUsuarios;?>" data-width="600"><i class="icon-cogs"></i></a>
						</aside>
					</li>
				<?
				}
				?>
			</ul>     
		</nav>
	</section>
</section>

<section id="form-agregar-usuario" title="Formulario Agregar Usuario" style="display:none;">
	<form id="form_usuarios" accept-charset="utf-8">
		<ul id="datos">
		
			<li><h2>Datos del Usuario <span>>></span></h2></li>
			
			<li><input type="text" name="nombre" value="" id="nombre" placeholder="Nombre" /></li>
			<li><input type="text" name="apellido_pat" value="" id="apellido_pat" placeholder="Apellido Paterno"/></li>
			<li><input type="text" name="apellido_mat" value="" id="apellido_mat" placeholder="Apellido Materno" /></li>
			<li><input type="text" name="username" value="" id="username" placeholder="Usuario" /></li>
			<li><input type="password" name="password" value="" id="password" placeholder="Contrase&ntilde;a" /></li>
			<li><input type="password" name="password_conf" value="" id="password_conf" placeholder="Repetir Contrase&ntilde;a" /></li>
			<li><select name="privilegios">
			<option value="">Seleccione sus Privilegios</option>
			<option value="1">Administrador</option>
			<option value="2">Normal</option>
			</select></li>
			<li><input type="button" name="btnFormUsuarios" value="Agregar Usuario" onclick="enviarRegistro();" id="btnFormUsuarios"  /></li>
		</ul>
	</form>
</section>


<section id="form-modificar-usuario" title="Formulario Modificar Usuario" style="display:none;">
	
</section>


<section id="eliminarUsuario" title="Eliminar Usuario" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>¿Estás seguro de eliminar este Usuario?, porque no se podrá recuperar después</p>
</section>

<section id="cuadro_modificar" title="Modificar Usuario" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>El registro se ha modificado con: </p>
</section>

<script type="text/javascript">


$(document).ready(function(){	
	var validator = $("#form_usuarios").validate({ 
		  rules: 
		  {
			password: 
			{	
				required: true 
			},
			password_conf: 
			{	
				required: true,
				equalTo: "#password" 
			},
			username:
		  {		
				required: true,
				remote: {
				url: "index.php/check/check_username",
				type: "post"
						}
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
	});//Validate
	
});//Ready		

function enviarRegistro()
{					
	if($("#form_usuarios").valid())
	{
	
	$.post("index.php/usuario/C_Agregar_usuario",$("#form_usuarios").serialize(),
		function(data)
		{
			alert("El registro se ha ingresado correctamente");
			$("#form_usuarios").reset();			
		});
	}
}
	
</script>
