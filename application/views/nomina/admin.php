<?php if (!empty($msg_success)): ?>
	<div class="alert alert-success">
		<?php echo $msg_success; ?>
	</div>
<?php endif ?>

<section class="contenedor">
  <h2><? echo $empleado->nombre.' '.$empleado->apellidoPat.' '.$empleado->apellidoMat; ?><br> Area: <? echo $empleado->area; ?> <br> Puesto: <? echo $empleado->puesto; ?> </h2>

<?
    echo validation_errors();
    
    $descuentos_fijos = 0;
    $total_retenciones = 0;
    $otros_descuentos = 0;
    $pago_retardo = 50; //valor que se descuenta por retardo
    $pago_falta = 150; //valor que se descuenta por falta

    if($retenciones):
        if($retenciones->print_personal==1){$prestamo_personal = $retenciones->saldo_actual; } else { $prestamo_personal = 0; }
        if($retenciones->print_anticipo==1){$anticipo_semanal = $retenciones->prestamo_anticipo; } else { $anticipo_semanal = 0; }
        if($retenciones->print_limpieza==1){$descuentos_fijos += $retenciones->limpieza; }
        if($retenciones->print_imss==1){$descuentos_fijos += $retenciones->imss; }
        if($retenciones->print_infonavit==1){$descuentos_fijos += $retenciones->infonavit; }
        if($retenciones->print_retardos==1){$descuentos_fijos += $retenciones->retardos * $pago_retardo; }
        if($retenciones->print_faltas==1){$descuentos_fijos += $retenciones->faltas * $pago_falta; }
        foreach ($nomina_descuentos->result() as $key => $value) {
            if($value->visible==1){$otros_descuentos += $value->valor; }
        }
        
        
       
    
        $total_retenciones = $prestamo_personal + $anticipo_semanal + $descuentos_fijos + $otros_descuentos;

        $diferencia = $retenciones->total_percepciones - $total_retenciones;
?>
       

   <form action="" method="post">
       <div class="retenciones">
        <h2>Percepciones</h2>
        <label>Sueldo</label>
        <input type="text" name="data[sueldo]" class="percepciones" value="<? echo set_value('data[sueldo]',$retenciones->sueldo) ?>" id="sueldo">
        <label>Comisiones</label>
        <input type="text" name="data[comisiones]" class="percepciones" value="<? echo set_value('data[comisiones]',$retenciones->comisiones) ?>" id="comisiones">
        <label>Prestamo</label>
        <input type="text" name="data[prestamo]" class="percepciones" value="<? echo set_value('data[prestamo]',$retenciones->prestamo) ?>" id="prestamo">
        <label>Total</label>
        <input type="text" name="data[total_percepciones]" value="<? echo set_value('data[total_percepciones]',$retenciones->total_percepciones) ?>" id="total_percepciones" readonly>                
    </div>    
       
    <div class="retenciones">
        <h2>Retenciones</h2>
        <label>Prestamo Presonal</label>
        <input type="text" name="data[prestamo_personal]" value="<? echo $prestamo_personal; ?>" readonly>
        <label>Anticipo Semanal</label>
        <input type="text" name="data[anticipo_semanal]" value="<? echo $anticipo_semanal; ?>" readonly>
        <label>Descuentos Fijos</label>
        <input type="text" name="data[descuentos_fijos]" value="<? echo $descuentos_fijos; ?>" readonly>
        <label>Otros</label>
        <input type="text" name="data[otros_descuentos]" value="<? echo $otros_descuentos; ?>" readonly>
        <label>Total</label>
        <input type="text" name="data[total_retenciones]" value="<? echo $total_retenciones; ?>" readonly>                
    </div>
    
    <div class="retenciones">
        <h2>A Recibir</h2>
        <label>Percepciones</label>
        <input type="text" name="data[final_percepciones]" id="final_percepciones" value="<? echo set_value('data[final_percepciones]',$retenciones->total_percepciones); ?>" readonly>
        <label>Retenciones</label>
        <input type="text" name="data[retenciones]" value="<? echo $total_retenciones; ?>" id="total_retenciones" readonly>
        <label>Diferencia</label>
        <input type="text" name="data[diferencia]" id="diferencia" value="<? echo set_value('data[diferencia]',$diferencia) ?>" readonly>                
    </div>
    <input type="submit" value="Guardar" name="btn_guardar" >
   </form>
   
<? else: ?>
    <div class="retenciones">
        <div>No hay suficientes datos en las retenciones.</div>
    </div>
<? endif ?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
    
    $(".percepciones").change(function(){
        
        var sueldo = Number($("#sueldo").val());
        var comisiones = Number($("#comisiones").val());
        var prestamo = Number($("#prestamo").val());
        
        
        var suma = sueldo + comisiones + prestamo;
        
        $("#total_percepciones").val(suma);
        $("#final_percepciones").val(suma);
        
        var final_perc = Number($("#final_percepciones").val());
        var final_reten = Number($("#total_retenciones").val());
        var diferencia = final_perc - final_reten;
        
         $("#diferencia").val(diferencia);
        
    });
    
    });
</script>
