<?php echo validation_errors(); ?>

<section class="contenedor">
    <div class="retenciones">
        <form action="" method="post">
           <h2>Agregar Pintura</h2>
           
            <div class="input_fields_wrap">
                <input type="number"  name="input_num" value="<?php echo set_value('input_num','0'); ?>" id="input_num" min="0" max="50">
                <input type="submit" class="btn_submit" name="btn_campos" id="btn_campos" value="Campos">
            </div>
             <?php if ($this->input->post('input_num')>0): ?>
               <? for($i = 0; $i < $this->input->post('input_num'); $i++):  ?>
                <div class="input-orden-pintura">
                    <h3>Pintura</h3>
                    
                    <?  $datos = $this->input->post('info'); ?>
                    
                    <input type="text" placeholder="Orden" class="clave" name="info[clave][]" data-id="<? echo $i; ?>" value="<?php echo set_value('info[clave][]'); ?>"  id="clave<? echo $i; ?>">
                    
                    <input type="hidden" placeholder="Orden" class="id_orden" name="info[id_orden][]" data-id="<? echo $i; ?>" value="<?php echo set_value('info[id_orden][]'); ?>"  id="id_orden<? echo $i; ?>">
                   
                    <input type="text" placeholder="Marca" name="info[marca][]" value="<?php echo set_value('info[marca][]'); ?>" id="marca<? echo $i; ?>" readonly >
                    <input type="text" placeholder="Modelo" name="info[modelo][]" value="<?php echo set_value('info[modelo][]'); ?>" id="modelo<? echo $i; ?>" readonly >
                    <input type="text" placeholder="Color" name="info[color][]" value="<?php echo set_value('info[color][]'); ?>" id="color<? echo $i; ?>" readonly >
                    <input type="text" placeholder="Piezas" name="info[piezas][]" value="<?php echo set_value('info[piezas][]'); ?>" id="piezas<? echo $i; ?>" readonly >
                    <input type="text" placeholder="Preparacion" name="info[preparacion][]" data-nombre="preparacion" class="datos_pintura" data-id="<? echo $i; ?>" value="<?php echo set_value('info[preparacion][]'); ?>" id="preparacion<? echo $i; ?>" readonly>
                    <input type="checkbox" name="info[chk_preparacion][<? echo $i; ?>]" value="1" data-nombre="preparacion" <? if(isset($datos['chk_preparacion'][$i])){ echo "checked";  } ?> data-id="<? echo $i; ?>" class="chk"  id="chk_preparacion<? echo $i; ?>" readonly>
                    <input type="text" placeholder="Pintura" name="info[pintura][]" data-nombre="pintura" data-id="<? echo $i; ?>"  value="<?php echo set_value('info[pintura][]'); ?>" id="pintura<? echo $i; ?>" class="datos_pintura" readonly>
                    <input type="checkbox" name="info[chk_pintura][<? echo $i; ?>]" value="1" class="chk" data-nombre="pintura" <? if(isset($datos['chk_pintura'][$i])){ echo "checked";  } ?> data-id="<? echo $i; ?>"  id="chk_pintura<? echo $i; ?>" readonly >
                    <input type="text" placeholder="Total" name="info[total][]" readonly value="<?php echo set_value('info[total][]'); ?>" id="total<? echo $i; ?>">
                    <div id="materiales-<? echo $i; ?>" <? if(isset($datos['chk_pintura'][$i])){  } else { echo 'style="display:none;"'; } ?>  >
                       <h3>Materiales</h3>
                        <input type="text" placeholder="Procesivos" class="materiales" data-id="<? echo $i; ?>" name="info[procesivos_materiales][]" value="<?php echo set_value('info[procesivos_materiales][]'); ?>" id="procesivos_materiales<? echo $i; ?>">
                    <input type="text" placeholder="color" name="info[color_materiales][]" data-id="<? echo $i; ?>" class="materiales" value="<?php echo set_value('info[color_materiales][]'); ?>" id="color_materiales<? echo $i; ?>">
                    <input type="text" placeholder="pintura" name="info[pintura_materiales][]" data-id="<? echo $i; ?>" class="materiales" value="<?php echo set_value('info[pintura_materiales][]'); ?>" id="pintura_materiales<? echo $i; ?>">
                    <input type="text" placeholder="total" name="info[total_materiales][]" readonly value="<?php echo set_value('info[total_materiales][]'); ?>" id="total_materiales<? echo $i; ?>">
                    </div>

                </div>
                <? endfor ?>
                <input type="submit" value="Guardar" name="btn_guardar" >
            <? endif ?>
            
        </form>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function() {
        
        
        
        $(".clave").change(function()
        {
            var clave = $(this).val();
            var id = $(this).attr("data-id");
            
           
            
            $.post("nomina/get_orden/"+clave,function(data)
            {

                var obj = $.parseJSON(data);
                
                if(obj=="" || obj==null)
                {
                    alert("La orden no Existe");
                    $("#marca"+id).val('');
                    $("#modelo"+id).val('');
                    $("#color"+id).val('');
                    $("#piezas"+id).val('');
                    $("#id_orden"+id).val('');
                }
                else
                {
                    
                    if(obj.piezas > 0)
                    {
                        $("#marca"+id).val(obj.marca);
                        $("#modelo"+id).val(obj.modelo);
                        $("#color"+id).val(obj.color);
                        $("#piezas"+id).val(obj.piezas);
                        $("#id_orden"+id).val(obj.idOrdenes);
                        $('#chk_pintura'+id).prop('disabled',false);
                        $('#chk_preparacion'+id).prop('disabled',false);
                    }
                    else
                    {
                        alert("El numero de piezas en la orden es 0");
                        $("#marca"+id).val('');
                        $("#modelo"+id).val('');
                        $("#color"+id).val('');
                        $("#piezas"+id).val('');
                        $("#id_orden"+id).val('');
                    }
                }
            });// end post
            
        });
        
        $(".materiales").change(function()
        {
            var id = $(this).attr("data-id");
            
            var procesivos_materiales  = Number($("#procesivos_materiales"+id).val());
            var pintura_materiales  = Number($("#pintura_materiales"+id).val());
            var color_materiales  = Number($("#color_materiales"+id).val());
            
            var total_materiales = procesivos_materiales + pintura_materiales + color_materiales;
            
            $("#total_materiales"+id).val(total_materiales).number(true,2);
            
            
        });
        
        
        $(".chk").change(function()
        {
            var activo = $(this).prop('checked');
            var id = $(this).attr("data-id");
            var nombre = $(this).attr("data-nombre");
            var piezas = Number($("#piezas"+id).val());
            
            if(activo==true)
            {
                if(nombre=="pintura")
                {
                    var total = piezas * 60;
                    
                    $('#materiales-'+id).show();
                    //$('#pintura'+id).prop('disabled',false);
                    $("#pintura"+id).val(total);
                    
                }
                if(nombre=="preparacion")
                {
                    var total = piezas * 120;
                    //$('#preparacion'+id).prop('disabled',false);
                    $("#preparacion"+id).val(total);
                    
                }
                
                var preparacion = Number($("#preparacion"+id).val());
                var pintura = Number($("#pintura"+id).val());

                var total_general = preparacion + pintura;

                $("#total"+id).val(total_general);
                
            }
            else
            {
                if(nombre=="pintura")
                {
                    $('#materiales-'+id).hide();
                    //$('#pintura'+id).prop('disabled',true);
                    $('#pintura'+id).val('');
                }
                if(nombre=="preparacion")
                {
                    //$('#preparacion'+id).prop('disabled',true);
                    $('#preparacion'+id).val('');
                }
                
                var preparacion = Number($("#preparacion"+id).val());
                var pintura = Number($("#pintura"+id).val());

                var total_general = preparacion + pintura;

                $("#total"+id).val(total_general);
                
            }
        
        });
        
    });
    
</script>