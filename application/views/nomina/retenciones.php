
<section class="contenedor">
    <div class="retenciones">
       <h2><? echo $empleado->nombre.' '.$empleado->apellidoPat.' '.$empleado->apellidoMat; ?></h2>
        <form action="" method="post" onsubmit="return confirm('Estas Seguro que Quieres Actualizar');" >
           <h2>Prestamo Personal</h2>
            <input type="checkbox" name="print_personal" value="1" <? if($retencion->print_personal == 1){ echo "checked";  } ?> >
            <label for="saldo_anterior">Saldo Anterior</label>
            <input type="text" class="prestamo" name="saldo_anterior" id="saldo_anterior" value="<? echo set_value('saldo_anterior',$retencion->saldo_anterior); ?>"  />
            <label for="prestamo_personal">Prestamo</label>
            <input type="text" class="prestamo" name="prestamo_personal" id="prestamo_personal"  value="<? echo set_value('prestamo_personal',$retencion->prestamo_personal,2); ?>" />
            <label for="abono">Abono</label>
            <input type="text" class="prestamo" name="abono" id="abono" value="<? echo set_value('abono',$retencion->abono,2); ?>" />
            <label for="saldo_actual">Saldo Actual</label>
            <input type="text" readonly name="saldo_actual" id="saldo_actual" value="<? echo set_value('saldo_actual',$retencion->saldo_actual,2); ?>" />
            
        
        
           <h2>Anticipo Semanal</h2>
           <input type="checkbox" name="print_anticipo" value="1" <?  if($retencion->print_anticipo == 1){ echo "checked"; } ?>>
            <label for="prestamo_anticipo">Prestamo</label>
            <input type="text" name="prestamo_anticipo" value="<? echo number_format($retencion->prestamo_anticipo,2); ?>" />
            
        
           <h2>Descuentos Fijos</h2>
           
            <input type="checkbox" name="print_limpieza" value="1" <?  if($retencion->print_limpieza == 1){ echo "checked"; }   ?>>
            <label for="limpieza">Limpieza</label>
            <input type="text" name="limpieza" value="<? echo number_format($retencion->limpieza,2); ?>" />
            
            <input type="checkbox" name="print_imss" value="1" <?  if($retencion->print_imss == 1){ echo "checked";  } ?>>
            <label for="imss">Imss</label>
            <input type="text" name="imss" value="<? echo number_format($retencion->imss,2); ?>" />
            
            <input type="checkbox" name="print_infonavit" value="1" <?  if($retencion->print_infonavit == 1){ echo "checked"; } ?>>
            <label for="infonavit">Infonavit</label>
            <input type="text" name="infonavit" value="<? echo number_format($retencion->infonavit,2); ?>" />
            
            <input type="checkbox" name="print_retardos" value="1" <?  if($retencion->print_retardos == 1){ echo "checked"; } ?>>
            <label for="retardos">retardos</label>
            <input type="text" name="retardos" value="<? echo number_format($retencion->retardos,2); ?>" />
            
            <input type="checkbox" name="print_faltas" value="1" <?  if($retencion->print_faltas == 1){ echo "checked"; } ?>>
            <label for="faltas">Faltas</label>
            <input type="text" name="faltas" value="<? echo number_format($retencion->faltas,2); ?>" />
        
            <h2>Otros Descuentos</h2>
            <button id="add">Add Field</button>
            <div id="items">
                
            </div>
            <input type="submit" value="Guardar"  />
        </form>

        <div>
        <h2>Otros Descuentos</h2>
            <table id="tabla-despliegue">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Monto</th>
                        <th>Visible</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                
            <?
                    foreach ($nomina_descuentos->result() as $key => $value) {
                        if($value->visible==1){$check = "checked";}else{$check="";}
                      echo '<tr>
                            <td>'.$value->concepto.'</td>
                            <td>'.$value->valor.'</td>
                            <td><input type="checkbox" '.$check.' data-id="'.$value->id.'" class="chk_nomina"  value="1"></td>
                            <td><input type="button"  class="borrar" value="Borrar" data-id="'.$value->id.'" ></td></tr>';
                    }
                ?>
                
                </tbody>
            </table>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(function (){

        //when the Add Field button is clicked
        $("#add").click(function (e) {
            e.preventDefault();
            //Append a new row of code to the "#items" div
            $("#items").append('<div><input type="text" name="concepto[]" placeHolder="Concepto"><input type="text" placeHolder="Valor" name="valor[]"><button  class="delete">Delete</button></div>');
        });

        $("body").on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent("div").remove();
        });
        
        $("body").on("click", ".borrar", function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var r = confirm("Estas seguro que quieres Borrar el Registro")
            if(r==true)
            {
                $.post('nomina/borrar/nomina_retenciones_descuentos/'+id);
                location.reload();            }
           
        });

         $("body").on("change", ".chk_nomina", function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var flag = $(this).prop('checked');
            var valor = 0;

            if(flag==true){valor=1}else{valor=0}

            $.post('nomina/actualizar/nomina_retenciones_descuentos/'+id+'/'+valor);
    
        });

        $('.prestamo').change(
            function(){
                var saldo_ant = parseFloat($('#saldo_anterior').val() || 0);
                var abono = parseFloat($('#abono').val() || 0);
                var prestamo_personal = parseFloat($('#prestamo_personal').val() || 0);
                
                
                var saldo_actual = saldo_ant + prestamo_personal - abono;
                
                
                $("#saldo_actual").val(saldo_actual);
            }
        );
        
    });
</script>