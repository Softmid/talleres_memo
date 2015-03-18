<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

   

   <style type="text/css">
    header
    {
        display:none;
    }
    p
   {
       font-size:1em;
   }
   hr
   {
       border-top:1px solid #000;
       height:1px;
       width:75%;
       
   }
</style>


<? 
$total_retenciones = 0 ; 
$total_retenciones = $retenciones->saldo_actual + $retenciones->prestamo_anticipo + $retenciones->descuentos_fijos + $retenciones->otros_descuentos;

?>
<div class="container">
<div class="row">
<div class="panel panel-default visable-print">
    <div class="panel-heading">Impresion Admin</div>
    <div class="panel-body">
        <div class="row">
           <div class="col-xs-11 col-xs-offset-1">
               <p class="col-xs-3">Semana: <? echo $this->uri->segment(3); ?></p>
               <p class="col-xs-3">Fecha: <? echo $retenciones->fecha_inicio; ?></p>
               <p class="col-xs-3">Al: <? echo $retenciones->fecha_final; ?></p>
           </div>
        </div>
        <div class="colaborador row">
            <div class="col-xs-11 col-xs-offset-1">
               <p class="col-xs-3">Nombre: <? echo $empleado->nombre; ?><br>Puesto: <? echo $empleado->puesto; ?><br>Area: <? echo $empleado->area; ?></p>
               <p class="col-xs-3"></p>
            </div>
        </div>
        <div class="percepciones row">
            <div class="col-xs-5 col-xs-offset-1">
            <h2>Percepciones</h2>
            <p>Sueldo: <? echo $retenciones->sueldo; ?></p>
            <p>Comision: <? echo $retenciones->comisiones; ?></p>
            <p>Prestamo: <? echo $retenciones->prestamo; ?></p>
            <p>Total: <? echo $retenciones->total_percepciones; ?></p>
            </div>
            <div class="col-xs-5 col-xs-offset-1">
                <h2>A Recibir</h2>
                <p>Percepciones: <? echo $retenciones->total_percepciones; ?></p>
                <p>Retenciones: <? echo $total_retenciones; ?></p>
                <p>Diferencia: <? echo $retenciones->total_percepciones - $total_retenciones; ?></p>
             </div>
        </div>
        <div class="descuentos row">
        <h2 class="text-center">Descuentos</h2>
           <div class="col-xs-5 col-xs-offset-1">
                
                <p> 
                   <ul class="list-unstyled">
                    <li><strong>Prestamo Personal: <? echo $retenciones->saldo_actual; ?></strong></li>
                        <? if($retenciones->print_personal==1) { ?>
                        <ul>
                            <li>Sueldo Anterior: <? echo $retenciones->saldo_anterior; ?></li>
                            <li>Prestamo: <? echo $retenciones->prestamo_personal; ?></li>
                            <li>Abono: <? echo $retenciones->abono; ?></li>
                            <li>Saldo Actual: <? echo $retenciones->saldo_actual; ?></li>
                        </ul>
                        <? } ?>
                    </ul>
                </p>
                <p>
                   <ul class="list-unstyled">
                       <li><strong>Anticipo Semanal: <? echo $retenciones->prestamo_anticipo; ?></strong></li>
                   </ul>
                </p>
            </div>
            <div class="col-xs-5 col-xs-offset-1">
                <p>
                       <ul class="list-unstyled">
                        <li><strong>Descuentos Fijos: <? echo $retenciones->descuentos_fijos; ?></strong></li>
                        <? 
                            $retardos = $retenciones->retardos * 50;
                            $faltas = $retenciones->faltas * 150;
                        ?>   
                           <ul>
                            <? if($retenciones->print_imss==1){ echo "<li>Imss: ".$retenciones->imss."</li>"; } ?>
                            <? if($retenciones->print_limpieza==1){ echo "<li>Limpieza: ".$retenciones->limpieza."</li>"; } ?>
                            <? if($retenciones->print_infonavit==1){ echo "<li>infonavit: ".$retenciones->infonavit."</li>"; } ?>
                            <? if($retenciones->print_retardos==1){ echo "<li>retardos: ".$retardos."</li>"; } ?>
                            <? if($retenciones->print_faltas==1){ echo "<li>faltas: ".$faltas."</li>"; } ?>
                        </ul>
                        <?  ?>
                    </ul>
                    
                </p>
                <p>
                     <ul class="list-unstyled">
                        <li><strong>Otros Descuentos: <? echo $retenciones->otros_descuentos; ?></strong></li>
                        <ul>
                             <?
                              foreach ($nomina_descuentos->result() as $key => $value) {
                                if($value->visible == true) { echo '<li>'.$value->concepto.': '.$value->valor.'</li>'; } 
                              }
                            ?>
                        </ul>
                    </ul>
                </p>
            </div>
            
        </div>
        
    </div>
    <div class="panel-footer">
        <div class="col-xs-offset-8">
            <p>Firma</p>
            <hr align="left"></div>
        </div>
    </div>
</div>
</div>