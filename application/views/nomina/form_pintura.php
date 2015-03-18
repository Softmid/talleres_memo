<?php if ($this->session->flashdata('msg_success')): ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('msg_success'); ?>
	</div>
<?php endif ?>
<section class="contenedor">
    <div class="retenciones">
        <form action="" method="post">
                <div class="input-orden-pintura">
                    <h3>Pintura</h3>
                    <? //print_r($pintura); ?>
                    <input type="text" placeholder="Orden" class="clave" name="clave" value="<? echo $pintura->clave; ?>" readonly>
                    <input type="text" placeholder="Marca" name="marca"  value="<? echo $pintura->marca; ?>" readonly >
                    <input type="text" placeholder="Modelo" name="modelo" value="<? echo $pintura->modelo; ?>" readonly >
                    <input type="text" placeholder="Color" name="color"  value="<? echo $pintura->color; ?>" readonly >
                    <input type="text" placeholder="Piezas" name="piezas" id="piezas" value="<? echo $pintura->piezas; ?>" readonly >
                    <input type="text" placeholder="Preparacion" name="info[preparacion]" id="preparacion" value="<? echo $pintura->preparacion; ?>">
                     <input type="checkbox" name="chk_preparacion" value="1" data-nombre="preparacion" <? if($pintura->chk_preparacion==1){ echo "checked";  } ?> class="chk"  id="chk_preparacion">
                    <input type="text" placeholder="Pintura" name="info[pintura]" data-nombre="pintura"  value="<?php echo $pintura->pintura; ?>" id="pintura" class="datos_pintura">
                    <input type="checkbox" name="chk_pintura" value="1" class="chk" data-nombre="pintura" <? if($pintura->chk_pintura==1){ echo "checked";  } ?>  id="chk_pintura" >
                    <input type="text" placeholder="Total" name="info[total_pintura]" value="<? echo $pintura->total_pintura; ?>" id="total">
                    <div id="materiales">
                       <h3>Materiales</h3>
                        <input type="text" placeholder="Procesivos" class="materiales" name="info[materiales_procesivos]" value="<?php echo $pintura->materiales_procesivos; ?>" id="procesivos_materiales">
                    <input type="text" placeholder="color" name="info[materiales_color]" class="materiales" value="<?php echo $pintura->materiales_color; ?>" id="color_materiales">
                    <input type="text" placeholder="pintura" name="info[materiales_pintura]" class="materiales" value="<?php echo $pintura->materiales_pintura; ?>" id="pintura_materiales">
                    <input type="text" placeholder="total" name="info[total_materiales]" value="<?php echo $pintura->total_materiales; ?>" id="total_materiales">
                    </div>

                </div>
        
                <input type="submit" value="Guardar" name="btn_guardar" >
        
            
        </form>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function() {
        
        var pint = $('#chk_pintura').prop('checked');
        
        if(pint==true)
        {
            $('#materiales').show();
        }
        else
        {
            $('#materiales').hide();
        }
        
        $(".materiales").change(function()
        {
            var id = $(this).attr("data-id");
            
            var procesivos_materiales  = Number($("#procesivos_materiales").val());
            var pintura_materiales  = Number($("#pintura_materiales").val());
            var color_materiales  = Number($("#color_materiales").val());
            
            var total_materiales = procesivos_materiales + pintura_materiales + color_materiales;
            
            $("#total_materiales").val(total_materiales).number(true,2);
            
            
        });
        
        
        $(".chk").change(function()
        {
            var activo = $(this).prop('checked');
            var nombre = $(this).attr("data-nombre");
            var piezas = Number($("#piezas").val());
            
            if(activo==true)
            {
                if(nombre=="pintura")
                {
                    var total = piezas * 60;
                    
                    $('#materiales').show();
                    //$('#pintura').prop('disabled',false);
                    $("#pintura").val(total);
                    
                }
                if(nombre=="preparacion")
                {
                    var total = piezas * 120;
                    //$('#preparacion').prop('disabled',false);
                    $("#preparacion").val(total);
                    
                }
                
                var preparacion = Number($("#preparacion").val());
                var pintura = Number($("#pintura").val());

                var total_general = preparacion + pintura;

                $("#total").val(total_general);
                
            }
            else
            {
                if(nombre=="pintura")
                {
                    $('#materiales').hide();
                    //$('#pintura').prop('disabled',true);
                    $('#pintura').val('');
                }
                if(nombre=="preparacion")
                {
                    //$('#preparacion').prop('disabled',true);
                    $('#preparacion').val('');
                }
                
                var preparacion = Number($("#preparacion").val());
                var pintura = Number($("#pintura").val());

                var total_general = preparacion + pintura;

                $("#total").val(total_general);
                
            }
        
        });
        
    });
    
</script>