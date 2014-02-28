<section class="contenedor">  
	<aside id="menu-opciones" class="clear">
        <a class="link-abrir-post link-boton abrir-caracteristica" data-open="form-abrir-caracteristica" data-link="abrir-caracteristica" data-url="caracteristicas/modificar" data-id="" data-width="800">Nueva Categoria</a>
        </h2>
        
	</aside>
    <section class="despliegue-vehiculo clear">
    	<h2>Propiedades<span>>></span>
        </h2>
        <table id="tabla-despliegue" class="persist-area">
       <thead>
                <tr class="persist-header header-tabla">
                    <th width="48">N°</th>
                    <th width="109">Marca</th>
                    <th width="126">Modelo</th>
                    <th width="75">Placa</th>
                    <th width="92">Empresa</th>
                    <th width="87">Monto</th>
                    <th width="80">IVA</th>
                    <th width="300">Fecha Promesa</th>
                     <th width="100">Modificar</th>
                </tr>
            </thead>
            <tbody id="propiedades">
            <?php
            	foreach($vehiculo->result() as $vehiculo)
				{
					if($vehiculo->numero > 0){$valor = ' si';} else {$valor = '';}
			?>
            		<tr>
                    	<td align="center"><?php echo $vehiculo->idOrdenes?></td>
                        <td align="center"><?php echo $vehiculo->marca?></td>
                        <td align="center"><?php echo $vehiculo->modelo?></td>
                        <td align="center"><?php echo $vehiculo->placas?></td>
                        <td align="center"><?php echo $vehiculo->empresa?></td>                    
                        <td align="center">$ <?php echo number_format($vehiculo->monto,2)?></td>
                        <td align="center">$ <?php echo number_format($vehiculo->IVA,2)?></td>
                        <td align="center"><?php echo $this->funciones->convertir_fecha($vehiculo->fechaPromesa);?></td>
                          <td align="center"><a class="link-abrir-post link-boton-modificar modificar-caracteristica" data-open="form-modificar-caracteristica" data-link="modificar-caracteristica" data-url="caracteristicas/verMod" data-id="<?php echo $vehiculo->idVehiculo?>" data-width="600"><span></span>Modificar</a></td> 
                   </tr>
                        <? } ?>
             </tbody>           

        </table>
    </section>
</section>
<section id="form-agregar-caracteristica" title="Formulario Caracteristicas" style="display:none">
    <form id="formCaracteristicas" accept-charset="utf-8">
        <ul id="datos">
            <li><h2>Propiedades<span>>></span></h2></li>
             	<li></li>
              
            <li><input type="button" name="btnForm" value="Agregar Caracteristica" onclick="enviarForm();" id="btnForm"  /></li>
        </ul>
    </form>
</section>

<section id="cuadro_procesoExito" title="Agregar Propiedad" style="display:none;">
	<p style="padding: 0px; margin: 10px 0px;"><span class="ui-icon ui-icon-alert" style="float: left; background-color:#4F6AA3; margin: 0 7px 20px 0;"></span>Propiedad Agregada Exitosamente!.</p>
</section>


<section id="form-abrir-caracteristica" title="Formulario Nueva Caracteristica" style="display:none;">
	
</section>

<section id="form-modificar-caracteristica" title="Formulario Modificar Caracteristica" style="display:none;">
	
</section>


<script type="text/javascript">
$(function(){
	
    $("#formCaracteristica").validate({
		  rules: 
		  {
			nombre: 
			{
				required: true
			}		
						
		  }//rules
	});//validate
});//ready		

function enviarForm()
{		
	if($("#formCaracteristica").valid())
	{
		
		$.post("caracteristicas/agregar",$("#formCaracteristica").serialize(),
		function(data)
		{	
			$('#btnForm').after(function () {
				
				$('#cuadro_procesoExito').dialog('open');
				return false;
			});
			$("#formCaracteristica").reset();	
		}
		);
	}
}	
</script>

<script type="text/javascript">
	function abrirSub()
	{
			var id = $('#categoria').val();
			$.post('propiedades/verSub', {id : id},  function(data){
				$('#subCat').html(data);
				
				});
	}
</script>