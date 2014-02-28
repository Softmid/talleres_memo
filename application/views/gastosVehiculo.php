<?php
	
	$orden = $orden->row(); 
	$dataVehiculo = $vehiculo->row();
	
?>
<section id="gastos-vehiculo" class="clear">
	<section id="header">
    	<aside id="datos-vehiculo">
        	<h2>Marca: <span id="texto"><?php echo $dataVehiculo->marca;?></span> | Modelo: <span id="texto"><?php echo $dataVehiculo->modelo;?></span> | Color: <span id="texto"><?php echo $dataVehiculo->color;?></span></h2>
        </aside>
        <aside id="num-orden">
        	<h2>N° <span id="num-orden"><?php echo $orden->clave;?></span></h2>
        </aside>
    </section>
 	<h2>Gastos del vehiculo</h2>
 	
 	<section class="actualizar-gasto">
 		<table id="tabla-despliegue" class="persist-area">
	    	<thead>
	            <tr  class="persist-header header-tabla">
	                <th>Categoría</th>
	                <th>Subcategoría</th>
	                <th>Gasto</th>
	                <th>Descripción</th> 
	                <th>Eliminar</th>                   
	            </tr>    
	        </thead>
	        <tbody>
	        	<?php
	             	$total_gastos = 0;
					
	                foreach($gastos->result() as $dataGastos)
	                {
						$total_gastos += $dataGastos->monto;
	            ?>	
	            	<tr data-id="<?php echo $dataGastos->idGastos_Vehiculo?>">
	            		<td><?php echo $dataGastos->nombre_categoria;?></td>
	            		<td><?php echo $dataGastos->nombre_subcategoria;?></td>
	            		<td><input type="text" name="gasto" data-id="<?php echo $dataGastos->idGastos_Vehiculo?>" value=" <?php echo number_format($dataGastos->monto,2);?>" id="gasto" class="numero update-monto" placeholder="Gasto" style="width:80%;"/></td>
	            		<td><?php echo $dataGastos->descripcion?></td>
	                    <td><input type="button" name="btnFormGasto" class="eliminar-botom nuevo-tam" value="Eliminar Gasto" data-id="<?php echo $dataGastos->idGastos_Vehiculo?>" id="btnFormGasto"  /></td>
	                                    
	                </tr>
	        <?php
	                }            
	        ?>
	        <tbody>
	    </table>
	    <section class="contenedor-gasto clear">
	    	<aside>
	            <span>Presupuesto</span>
	            <span style="float:right;">$ <?php echo number_format($orden->monto, 2);?></span>
	    	</aside>
	        <aside style="border-bottom:1px solid; padding-bottom: 3px; margin-bottom: 1px;">
	            <span>Gastos</span>
	            <span style="float:right;">$ <?php echo number_format($total_gastos, 2);?></span>
	    	</aside>
	        <aside>
	            <span>Total</span>
	            <span style="float:right;">$ <?php echo number_format(($orden->monto - $total_gastos), 2);?></span>
	    	</aside>
	    </section>	
 	</section>
    
    
    <a class="link-boton newTam link-despliegue mostrar">Agregar Nuevo Gasto</a>
    <aside class="caja">
    	<form id="form_gasto">
            <ul id="datos">
                <li>
                    <select name="categoria" id="categoria" class="result-categoria">
                        <option value="">Seleccione una Categoría</option>
                        <?php
							foreach($categorias->result() as $categoria)
							{
								echo '<option value="'.$categoria->idCategorias.'">'.$categoria->nombre.'</option>';
							}
                        ?>
                    </select>
                </li>
                <li id="result-subcategoria">
                    <select name="subcategoria" id="subcategoria">
                        <option value="">Seleccione una Sub-Categoría</option>
                    </select>
                </li>
                <li><input type="text" name="gasto" value="" id="gasto" class="numero" placeholder="Gasto" /></li>
                <li><textarea name="descripcion" id="descripcion" placeholder="Descripcion"></textarea></li>
                <li><input type="submit" name="btnFormGasto" value="Agregar Gasto"  onclick="enviarRegistro()" id="btnFormGasto"  /></li>
                <input type="hidden" name="idOrden" id="idOrden" value="<?php echo $orden->idOrdenes;?>" />
            </ul>
        </form>
    </aside>
</section>

<script type="text/javascript">
	$(function (){
		$('.numero').number(true,2);
		
		$(".mostrar").click(function(event) {
			event.preventDefault();
			$(".caja").slideToggle();
		});
		$(".caja a").click(function(event) {
			event.preventDefault();
			$(".caja").slideUp();
		});
		
		$('.result-categoria').change(function(){
			var id = $(this).val();
			$.post('index.php/vehiculo/ver_subcategoria', {id : id},  function(data){
			$('#result-subcategoria').html(data);});
		});
		
		$('.update-monto').blur(function (){
			var id = $(this).attr('data-id');
			var monto = $(this).val();
			$.post("index.php/gastos/update_gasto",{ id : id, monto : monto });
		});
		
		$('.eliminar-botom').click(function (){
			var id = $(this).attr('data-id');
			$.post("index.php/gastos/eliminar_gasto",{ id : id},
			function(data)
			{
				var id = $("#idOrden").val();
				$.post("index.php/vehiculo/update_gastosVehiculo",{id: id},
				function(data)
				{
					$(".actualizar-gasto").html(data);	
				}
				);	
			});
		});
		
	});
</script>
<script type="text/javascript">
$(function(){
    $("#form_gasto").validate({
		  rules: 
		  {
			categoria: 
			{
				required: true
			},
			subcategoria: 
			{
				required: true
			},
			gasto:
			{
				required: true,
				number: true
			},
			descripcion:
			{
				required: true
			}
		  }//rules
	});//validate
});//ready		

function enviarRegistro()
{
	if($("#form_gasto").valid())
	{
		
		$.post("index.php/gastos/C_Agregar_Gasto",$("#form_gasto").serialize(),
		function(data)
		{
			var id = $("#idOrden").val();
			$("#form_gasto").reset();
			$.post("index.php/vehiculo/update_gastosVehiculo",{id: id},
			function(data)
			{
				$(".actualizar-gasto").html(data);	
			}
			);	
			$(".caja").slideUp();
		}
		);
	}	
}

</script>
