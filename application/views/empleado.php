<section class="contenedor">  
	<aside id="menu-opciones" class="clear">
		<a class="link-abrir link-boton boton-abrir-form" data-width="500" data-open="form-agregar-usuario" data-link="boton-abrir-form">Agregar Empleado</a>
	</aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Empleados<span>>></span></h2>
        <nav class="clear">
        	<ul class="clear">
            	<? 
				foreach($empleados->result() as $datos)
				{
				?>
            		<li>
                    	<h3 class="titulo no-center">Nombre: <span><?php echo $datos->nombre?></span></h3>
                        <h3 class="titulo no-center">Apellidos: <span><?php echo $datos->apellidoPat.' '.$datos->apellidoMat?></span></h3>
                        <h3 class="titulo no-center">Celular: <span><?php echo $datos->cel?></span></h3>
                        <h3 class="titulo no-center">Area: <span><?php echo $datos->area?></span></h3>
                        <h3 class="titulo no-center">Puesto: <span><?php echo $datos->puesto?></span></h3>
                        <aside class="boton-ab">
                        	<a class="link-boton-eliminar" data-url="index.php/empleado/C_eliminar" data-open="eliminarUsuario" data-id="<?php echo $datos->idEmpleado;?>"><i class="icon-remove"></i></a>
                            <a class="link-abrir-post link-boton-modificar modificar-usuario" data-open="form-modificar-usuario" data-link="modificar-usuario" data-url="index.php/empleado/modificar" data-id="<?php echo $datos->idEmpleado;?>" data-width="600"><i class="icon-cogs"></i></a>
                        </aside>
                    </li>
            	<?
				}
				?>
            </ul>
        </nav>
    </section>
</section>

<section id="form-agregar-usuario" title="Formulario Agregar Empleado" style="display:none;">
    <form id="form_usuarios" accept-charset="utf-8">
        <ul id="datos">
        
            <li><h2>Datos del Empleado <span>>></span></h2></li>
            
            <li><input type="text" name="nombre" value="" id="nombre" placeholder="Nombre" /></li>
            <li><input type="text" name="apellido_pat" value="" id="apellido_pat" placeholder="Apellido Paterno"/></li>
            <li><input type="text" name="apellido_mat" value="" id="apellido_mat" placeholder="Apellido Materno" /></li>
            <li><input type="text" name="direccion" value="" id="direccion" placeholder="Direcci&oacute;n" /></li>
            <li><input type="text" name="tel" value="" id="tel" placeholder="Telefono" /></li> 
            <li><input type="text" name="cel" value="" id="cel" placeholder="Celular" /></li> 
            <li> <select name="area" id="area" >
            	<option value="hojalateria">Hojalateria</option>
            	<option value="pintura">Pintura</option>
            </select></li>
            <li><input type="text" name="puesto" value="" id="puesto" placeholder="Puesto" /></li> 
            <li><input type="button" name="btnFormUsuarios" value="Agregar Empleado" onclick="enviarRegistro();" id="btnFormUsuarios"  /></li>
        </ul>
	</form>
</section>


<section id="form-modificar-usuario" title="Formulario Modificar Usuario" style="display:none;">
	
</section>


<section id="eliminarUsuario" title="Eliminar Empleado" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>¿Estás seguro de eliminar este Empleado?, porque no se podrá recuperar después</p>
</section>

<section id="cuadro_modificar" title="Modificar Usuario" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>El registro se ha modificado con: </p>
</section>

<script type="text/javascript">


$(document).ready(function(){	
    var validator = $("#form_usuarios").validate({ 
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
	});//Validate

	$(".link-boton-eliminar").on('click',function(){
		var url = $(this).attr('data-url');
		var id = $(this).attr('data-id');
		var r = confirm("Deseas Eliminar este Empleado?");

		if(r == true)
		{
			$.post(url+'/'+id);
			location.reload();
		}

	});
	
});//Ready		

function enviarRegistro()
{					
	if($("#form_usuarios").valid())
	{
	
	$.post("index.php/empleado/C_Agregar",$("#form_usuarios").serialize(),
		function(data)
		{
			alert("El registro se ha ingresado correctamente");
			$("#form_usuarios").reset();			
		});
	}
}
	
</script>
