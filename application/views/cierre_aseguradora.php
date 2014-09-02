<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');
    
    $datos_cierre = $ver_cierre->row();
    $datos_vehiculo = $datos->row();
    $datos_orden = $orden->row();
    

    $balance = ($datos_cierre->valuacion_TOT + $datos_cierre->valuacion_refacciones + $datos_cierre->valuacion_mecanica + $datos_cierre->valuacion_estetica + $datos_cierre->valuacion_HP)-($datos_cierre->total_valuacion);
      

?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<form class="form-horizontal" method="post" role="form">
  <div class="form-group">
    
    <label for="orden" class="col-sm-2 control-label">Orden</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" readonly id="orden" value="<? echo $datos_orden->clave; ?>" name="orden" placeholder="Orden">
    </div>
    
    
    <label for="Marca" class="col-sm-2 control-label">Marca</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" readonly id="marca" name="marca" value="<? echo $datos_vehiculo->marca;  ?>" placeholder="marca">
    </div>
      
    <label for="color" class="col-sm-2 control-label">color</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" readonly id="color" name="color" value="<? echo $datos_vehiculo->color;  ?>" placeholder="color">
    </div>
      
    <label for="modelo" class="col-sm-2 control-label">modelo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" readonly id="modelo" name="modelo" value="<? echo $datos_vehiculo->modelo; ?>" placeholder="modelo">
    </div>
      
    <label for="company" class="col-sm-2 control-label">Compañia</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" readonly id="company" name="company" value="<? echo $datos_orden->empresa; ?>" placeholder="Compañia">
    </div>
      
    <label for="observaciones" class="col-sm-2 control-label">Observaciones</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="observaciones"  autofocus name="observaciones" value="<? echo $datos_cierre->observaciones; ?>" placeholder="Observaciones">
    </div>
      
    <label for="total_valuacion" class="col-sm-2 control-label">Total Valuación</label>
    <div class="col-sm-10">
        <input type="text" class="form-control no-margin" id="total_valuacion" readonly name="total_valuacion" value="<? echo $datos_cierre->total_valuacion; ?>"  placeholder="Total Valuación">
    </div>
      
    <label for="comision" class="col-sm-2 control-label">Comisión</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="comision" name="comision" value="<? echo $datos_cierre->comision; ?>" placeholder="Comisión">
    </div>
      
    <label for="valuacion_refacciones" class="col-sm-2 control-label">Valuacion de Refacciones</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="valuacion_refacciones" name="valuacion_refacciones" readonly value="<? echo $datos_cierre->valuacion_refacciones; ?>" placeholder="Valuacion de Refacciones">
    </div>
      
    <label for="pago_refacciones" class="col-sm-2 control-label">Pago de Refacciones</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin pago" id="pago_refacciones" name="pago_refacciones" value="<? echo $datos_cierre->pago_refacciones; ?>" placeholder="Pago de Refacciones">
    </div>
      
    <label for="valuacion_TOT" class="col-sm-2 control-label">Valuacion T.O.T.</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="valuacion_TOT" name="valuacion_TOT" readonly value="<? echo $datos_cierre->valuacion_TOT;  ?>" placeholder="Valuacion T.O.T.">
    </div>
      
    <label for="pago_TOT" class="col-sm-2 control-label">Pago T.O.T.</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin pago" id="pago_TOT" name="pago_TOT" value="<? echo $datos_cierre->pago_TOT; ?>" placeholder="Pago T.O.T.">
    </div>

    <label for="valuacion_hyp" class="col-sm-2 control-label">Valuacion H-P-M-H</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="valuacion_hyp" name="valuacion_hyp" readonly value="<? echo $datos_cierre->valuacion_HP; ?>" placeholder="Valuacion HyP">
    </div>
      
    <label for="HP_30" class="col-sm-2 control-label">30% H-P-M-H</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="HP_30" name="HP_30" readonly value="<? echo $datos_cierre->HP_30; ?>" placeholder="30% HyP">
    </div>
      
    <label for="total_piezas" class="col-sm-2 control-label">Total de Piezas</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="total_piezas" name="total_piezas" readonly value="<? echo $datos_cierre->total_piezas;  ?>" placeholder="Total de Piezas">
    </div>
      
    <label for="pago_pintura" class="col-sm-2 control-label">Pago Pintura</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="pago_pintura" name="pago_pintura" readonly value="<? echo $datos_cierre->pago_pintura; ?>" placeholder="Pago Pintura">
    </div>
      
    <label for="pago_pulida" class="col-sm-2 control-label">Pago Pulida</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="pago_pulida" name="pago_pulida" readonly value="<? echo $datos_cierre->pago_pulida; ?>" placeholder="Pago Pulida">
    </div>
     
     <label for="sugerencia_herreria" class="col-sm-2 control-label">Sugerencia Herreria</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin pago" id="sugerencia_herreria" required value="<? echo $datos_cierre->sugerencia_herreria; ?>" name="sugerencia_herreria" placeholder="Sugerencia Herreria">
    </div>
      
    <label for="pago_herreria" class="col-sm-2 control-label">Pago Herreria</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin pago" id="pago_herreria" required value="<? echo $datos_cierre->pago_herreria; ?>" name="pago_herreria" placeholder="Pago Herreria">
    </div>
     
     <label for="sugerencia_mecanica" class="col-sm-2 control-label">Sugerencia Mecanica</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin pago" id="sugerencia_mecanica" required value="<? echo $datos_cierre->sugerencia_mecanica; ?>" name="sugerencia_mecanica" placeholder="Sugerencia Mecanica">
    </div>
      
    <label for="hojalateria" class="col-sm-2 control-label">Hojalateria</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="hojalateria" name="hojalateria" readonly value="<? echo $datos_cierre->hojalateria; ?>" placeholder="Hojalateria">
    </div>
    
    <label for="pago_hojalateria_aseguradora" class="col-sm-2 control-label">Pago Hojalateria</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin pago" id="pago_hojalateria_aseguradora" name="pago_hojalateria_aseguradora" value="<? echo $datos_cierre->pago_hojalateria_aseguradora; ?>" placeholder="Pago Hojalateria">
    </div>
      
    <label for="valuacion_estetica" class="col-sm-2 control-label">Valuacion Estetica</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="valuacion_estetica" name="valuacion_estetica" readonly value="<? echo $datos_cierre->valuacion_estetica; ?>" placeholder="Valuacion Estetica">
    </div>
      
    <label for="estetica_30" class="col-sm-2 control-label">30% Estetica</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="estetica_30" name="estetica_30" readonly value="<? echo $datos_cierre->estetica_30; ?>" placeholder="30% Estetica">
    </div>
      
    <label for="pago_estetica" class="col-sm-2 control-label">Pago Estetica</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin pago" id="pago_estetica" name="pago_estetica" value="<? echo $datos_cierre->pago_estetica; ?>"  placeholder="Pago Estetica">
    </div>
      
    <label for="suma_total" class="col-sm-2 control-label">Suma Pago Total</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="suma_total" name="suma_total" value="<? echo $datos_cierre->suma_total; ?>" placeholder="Suma Pago Total">
    </div>
      
    <label for="utilidad" class="col-sm-2 control-label">Utilidad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="utilidad" name="utilidad" value="<? echo $datos_cierre->utilidad; ?>" placeholder="Utilidad">
    </div>
      
    <label for="percent_utilidad" class="col-sm-2 control-label">% Utilidad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="percent_utilidad" name="percent_utilidad" value="<? echo $datos_cierre->percent_utilidad; ?>" placeholder="% Utilidad">
    </div>
      
    <label for="final" class="col-sm-2 control-label">Balance</label>
    <div class="col-sm-10">
      <input type="text" class="form-control no-margin" id="final" name="final" readonly value="<? echo $balance; ?>" placeholder="Final">
    </div>
    
    <input type="hidden" class="form-control no-margin pago" id="pago_mecanica" name="pago_mecanica" value="<? echo $datos_cierre->pago_mecanica; ?>" placeholder="Pago Mecanica">
    
        <? if($datos_cierre->guardado==0) { ?>

            <input type="submit" class="btn btn-default" value="Guardar">
    
      <? }  ?>
      
  </div>
</form>

<script type="text/javascript">
    $(function (){
        
        $('#pago_herreria').change(function(){

            var HP_30 = parseFloat($('#HP_30').val());
            var pago_pintura = parseFloat($('#pago_pintura').val());
            var pago_pulida = parseFloat($('#pago_pulida').val());
            var pago_herreria = parseFloat($('#pago_herreria').val());
            var pago_mecanica = parseFloat($('#pago_mecanica').val());
            
            var hojalateria = (HP_30)-(pago_pintura + pago_pulida + pago_herreria + pago_mecanica);
            
            $('#hojalateria').val(hojalateria);
            $('#pago_hojalateria_aseguradora').val(hojalateria);
        
        });
        
        $('.pago').change(function(){
            
            var pago_total = 0;
            var pago_hojalateria = parseFloat($('#pago_hojalateria_aseguradora').val() || 0);
            var pago_pintura = parseFloat($('#pago_pintura').val() || 0);
            var pago_pulida = parseFloat($('#pago_pulida').val() || 0);
            var pago_herreria = parseFloat($('#pago_herreria').val() || 0);
            var pago_estetica = parseFloat($('#pago_estetica').val() || 0);
            var pago_TOT = parseFloat($('#pago_TOT').val() || 0);
            var pago_mecanica = parseFloat($('#pago_mecanica').val() || 0);
            var pago_refacciones = parseFloat($('#pago_refacciones').val() || 0);
            var total_valuacion = parseFloat($('#total_valuacion').val());
            
            
            pago_total = (pago_pintura + pago_pulida + pago_herreria + pago_estetica + pago_TOT + pago_mecanica + pago_refacciones + pago_hojalateria);
            
            var utilidad = total_valuacion - pago_total;
            var percent_utilidad = (utilidad*100)/total_valuacion;

            $('#suma_total').val(pago_total);    
            $('#utilidad').val(utilidad)
            $('#percent_utilidad').number(true,2).val(percent_utilidad); 
            
        });
    });
</script>



