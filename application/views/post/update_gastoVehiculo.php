<?php
    $result = json_decode($result);
?>
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
            foreach($result->gastos as $dataGastos)
            {
                $total_gastos += $dataGastos->monto;
        ?>  
            <tr>
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
        <span style="float:right;">$ <?php echo number_format($result->orden->monto, 2);?></span>
    </aside>
    <aside style="border-bottom:1px solid; padding-bottom: 3px; margin-bottom: 1px;">
        <span>Gastos</span>
        <span style="float:right;">$ <?php echo number_format($total_gastos, 2);?></span>
    </aside>
    <aside>
        <span>Total</span>
        <span style="float:right;">$ <?php echo number_format(($result->orden->monto - $total_gastos), 2);?></span>
    </aside>
</section>

<script type="text/javascript">
    $(function(){
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