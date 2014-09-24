<?
	date_default_timezone_set('Mexico/General');
	$date = new DateTime('NOW');
	$dateTime = $date->format('Y');
    
    $datos_cierre = $ver_cierre->row();
    $datos_vehiculo = $datos->row();
    $datos_orden = $orden->row();
    

    $balance = ($datos_cierre->valuacion_TOT + $datos_cierre->valuacion_refacciones + $datos_cierre->valuacion_mecanica + $datos_cierre->valuacion_estetica + $datos_cierre->valuacion_HP)-($datos_cierre->total_valuacion);
      

?>

<section class="contenedor" id="vehiculo">  
	<aside id="menu-opciones" class="clear">
    <section class="despliegue-vehiculo clear">
<form method="post" accept-charset="utf-8" id="form_vehiculo">
            <ul id="datos">
                
                <li>
                    <label for="orden" class=" control-label">Orden</label>
                    <input type="text" class="form-control" readonly id="orden" value="<? echo $datos_orden->clave; ?>" name="orden" placeholder="Orden"></li>
                <li>
                    <label for="Marca" class=" control-label">Marca</label>
                    <input type="text" class="form-control" readonly id="marca" name="marca" value="<? echo $datos_vehiculo->marca;  ?>" placeholder="marca">
                </li>
                <li>
                    <label for="color" class=" control-label">color</label>
                    <input type="text" class="form-control no-margin" readonly id="color" name="color" value="<? echo $datos_vehiculo->color;  ?>" placeholder="color">
                </li>
                <li>
                    <label for="modelo" class=" control-label">modelo</label>
                    <input type="text" class="form-control no-margin" readonly id="modelo" name="modelo" value="<? echo $datos_vehiculo->modelo; ?>" placeholder="modelo">
                </li>
                <li>
                    <label for="company" class=" control-label">Compañia</label>
    <input type="text" class="form-control no-margin" readonly id="company" name="company" value="<? echo $datos_orden->empresa; ?>" placeholder="Compañia">
                </li>
                <li>
                    <label for="observaciones" class=" control-label">Observaciones</label>
    
      <input type="text" class="form-control no-margin" id="observaciones" autofocus name="observaciones" value="<? echo $datos_cierre->observaciones; ?>" placeholder="Observaciones">
                </li>
                <li> <label for="total_valuacion" class=" control-label">Total Valuación</label>
    
        <input type="text" class="form-control no-margin" id="total_valuacion" readonly name="total_valuacion" value="<? echo $datos_cierre->total_valuacion; ?>"  placeholder="Total Valuación">
               </li>
                <li>
                <label for="comision" class=" control-label">Comisión</label>
    
      <input type="text" class="form-control no-margin" id="comision" name="comision" value="<? echo $datos_cierre->comision; ?>" placeholder="Comisión">
               </li>
                <li>
                     <label for="comision" class=" control-label">Comisión</label>
    
      <input type="text" class="form-control no-margin" id="comision" name="comision" value="<? echo $datos_cierre->comision; ?>" placeholder="Comisión">
                </li>
                <li>
                    <label for="valuacion_refacciones" class=" control-label">Valuacion de Refacciones</label>
    
      <input type="text" class="form-control no-margin" id="valuacion_refacciones" name="valuacion_refacciones" readonly value="<? echo $datos_cierre->valuacion_refacciones; ?>" placeholder="Valuacion de Refacciones">
                </li>
                <li>
                     <label for="pago_refacciones" class=" control-label">Pago de Refacciones</label>
    
      <input type="text" class="form-control no-margin pago" id="pago_refacciones" name="pago_refacciones" value="<? echo $datos_cierre->pago_refacciones; ?>" placeholder="Pago de Refacciones">
                </li>
                <li>
                     <label for="valuacion_TOT" class=" control-label">Valuacion T.O.T.</label>
    
      <input type="text" class="form-control no-margin" id="valuacion_TOT" name="valuacion_TOT" readonly value="<? echo $datos_cierre->valuacion_TOT;  ?>" placeholder="Valuacion T.O.T.">
                </li>
                <li>
                     <label for="pago_TOT" class=" control-label">Pago T.O.T.</label>
    
      <input type="text" class="form-control no-margin pago" id="pago_TOT" name="pago_TOT" value="<? echo $datos_cierre->pago_TOT; ?>" placeholder="Pago T.O.T.">
                </li>
                
                <li>
                    <label for="valuacion_hyp" class="col-sm-2 control-label">Valuacion H-P-M-H</label>
    
      <input type="text" class="form-control no-margin" id="valuacion_hyp" name="valuacion_hyp" readonly value="<? echo $datos_cierre->valuacion_HPMH; ?>" placeholder="Valuacion HyP">
                </li>
                <li>
                    <label for="HP_30" class="col-sm-2 control-label">30% H-P-M-H</label>
    
      <input type="text" class="form-control no-margin" id="HP_30" name="HP_30" readonly value="<? echo $datos_cierre->HPMH_30; ?>" placeholder="30% HyP">
                </li>
                <li>
                    <label for="total_piezas" class=" control-label">Total de Piezas</label>
    
      <input type="text" class="form-control no-margin" id="total_piezas" name="total_piezas" readonly value="<? echo $datos_cierre->total_piezas;  ?>" placeholder="Total de Piezas">
                </li>
                <li>
                     <label for="pago_pintura" class=" control-label">Pago Pintura</label>
    
      <input type="text" class="form-control no-margin" id="pago_pintura" name="pago_pintura" readonly value="<? echo $datos_cierre->pago_pintura; ?>" placeholder="Pago Pintura">
                </li>
                <li>
                     <label for="pago_pulida" class=" control-label">Pago Pulida</label>
    
      <input type="text" class="form-control no-margin" id="pago_pulida" name="pago_pulida" readonly value="<? echo $datos_cierre->pago_pulida; ?>" placeholder="Pago Pulida">
                </li>
                <li>
                    <label for="sugerencia_herreria" class="col-sm-2 control-label">Sugerencia Herreria</label>
    
      <input type="text" class="form-control no-margin pago" id="sugerencia_herreria" required value="<? echo $datos_cierre->sugerencia_herreria; ?>" name="sugerencia_herreria" placeholder="Sugerencia Herreria">
                </li>
                <li>
                    <label for="pago_herreria" class="col-sm-2 control-label">Pago Herreria</label>
    
      <input type="text" class="form-control no-margin pago" id="pago_herreria" required value="<? echo $datos_cierre->pago_herreria; ?>" name="pago_herreria" placeholder="Pago Herreria">
                </li>
                <li>
                    <label for="sugerencia_mecanica" class="col-sm-2 control-label">Sugerencia Mecanica</label>
    
      <input type="text" class="form-control no-margin pago" id="sugerencia_mecanica" required value="<? echo $datos_cierre->sugerencia_mecanica; ?>" name="sugerencia_mecanica" placeholder="Sugerencia Mecanica">
                </li>
                 <li>
                    <label for="pago_mecanica" class=" control-label">Pago Mecanica</label>
    
      <input type="text" class="form-control no-margin pago" id="pago_mecanica" name="pago_mecanica" value="<? echo $datos_cierre->pago_mecanica; ?>" placeholder="Pago Mecanica">
                </li>
                <li>
                    <label for="hojalateria" class=" control-label">Hojalateria</label>
    
      <input type="text" class="form-control no-margin" id="hojalateria" name="hojalateria" readonly value="<? echo $datos_cierre->hojalateria; ?>" placeholder="Hojalateria">
                </li>
                <li>
                      <label for="pago_hojalateria_aseguradora" class=" control-label">Pago Hojalateria</label>
    
      <input type="text" class="form-control no-margin pago" id="pago_hojalateria_aseguradora" name="pago_hojalateria_aseguradora" value="<? echo $datos_cierre->pago_hojalateria_aseguradora; ?>" placeholder="Pago Hojalateria">
                </li>
                <li>
                      <label for="valuacion_estetica" class=" control-label">Valuacion Estetica</label>
    
      <input type="text" class="form-control no-margin" id="valuacion_estetica" name="valuacion_estetica" readonly value="<? echo $datos_cierre->valuacion_estetica; ?>" placeholder="Valuacion Estetica">
    
                </li>
                <li>
                     <label for="estetica_30" class=" control-label">30% Estetica</label>
    
      <input type="text" class="form-control no-margin" id="estetica_30" name="estetica_30" readonly value="<? echo $datos_cierre->estetica_30; ?>" placeholder="30% Estetica">
                </li>
                <li>
                     <label for="pago_estetica" class=" control-label">Pago Estetica</label>
    
      <input type="text" class="form-control no-margin pago" id="pago_estetica" name="pago_estetica" value="<? echo $datos_cierre->pago_estetica; ?>"  placeholder="Pago Estetica">
                </li>
                <li>
                     <label for="suma_total" class=" control-label">Suma Pago Total</label>
    
      <input type="text" class="form-control no-margin" id="suma_total" name="suma_total" value="<? echo $datos_cierre->suma_total; ?>" placeholder="Suma Pago Total">
                </li>
                <li>
                     <label for="utilidad" class=" control-label">Utilidad</label>
    
      <input type="text" class="form-control no-margin" id="utilidad" name="utilidad" value="<? echo $datos_cierre->utilidad; ?>" placeholder="Utilidad">
                </li>
                <li>
                     <label for="percent_utilidad" class=" control-label">% Utilidad</label>
    
      <input type="text" class="form-control no-margin" id="percent_utilidad" name="percent_utilidad" value="<? echo $datos_cierre->percent_utilidad; ?>" placeholder="% Utilidad">
                </li>
                <li> <label for="final" class=" control-label">Balance</label>
    
      <input type="text" class="form-control no-margin" id="final" name="final" readonly value="<? echo $balance; ?>" placeholder="Final">
               </li>
                <li>
                     <? 
        
        if($this->session->userdata('privilegios') > 1) {
        
        if($datos_cierre->guardado==0) { ?>

            <input type="submit" class="btn btn-default" value="Guardar">
    
      <? } }
        else
        {
            echo '<input type="submit" class="btn btn-default" value="Guardar">';
        }   
                    ?>
                </li>
            </ul>
</form>

</section>
</aside>
</section>
    


<script type="text/javascript">
    $(function (){
        
        $('#sugerencia_herreria').change(function(){

            var HP_30 = parseFloat($('#HP_30').val() || 0);
            var pago_pintura = parseFloat($('#pago_pintura').val() || 0);
            var pago_pulida = parseFloat($('#pago_pulida').val() || 0);
            var pago_herreria = parseFloat($('#sugerencia_herreria').val() || 0);
            var pago_mecanica = parseFloat($('#pago_mecanica').val() || 0);
            
            var hojalateria = (HP_30)-(pago_pintura + pago_pulida + pago_herreria + pago_mecanica);
            
            $('#hojalateria').number(true,4).val(hojalateria);
            $('#pago_hojalateria_aseguradora').number(true,4).val(hojalateria);
        
        });
        
        $('.pago').change(function(){
            
            
            var pago_total = 0;
            var pago_hojalateria = parseFloat($('#pago_hojalateria_aseguradora').val() || 0);
            var pago_pintura = parseFloat($('#pago_pintura').val() || 0);
            var pago_pulida = parseFloat($('#pago_pulida').val() || 0);
            var pago_herreria = parseFloat($('#sugerencia_herreria').val() || 0);
            var pago_estetica = parseFloat($('#pago_estetica').val() || 0);
            var pago_TOT = parseFloat($('#pago_TOT').val() || 0);
            var pago_mecanica = parseFloat($('#pago_mecanica').val() || 0);
            var pago_refacciones = parseFloat($('#pago_refacciones').val() || 0);
            var total_valuacion = parseFloat($('#total_valuacion').val());
            
            
            pago_total = (pago_pintura + pago_pulida + pago_herreria + pago_estetica + pago_TOT + pago_mecanica + pago_refacciones + pago_hojalateria);
            
            var utilidad = total_valuacion - pago_total;
            var percent_utilidad = (utilidad*100)/total_valuacion;
            

            $('#suma_total').val(pago_total);    
            $('#utilidad').number(true,4).val(utilidad);
            $('#percent_utilidad').number(true,2).val(percent_utilidad); 
            
        });
    });
</script>



