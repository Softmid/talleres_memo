 <?
    date_default_timezone_set('Mexico/General');
    $date = new DateTime('NOW');
    $dateTime = $date->format('Y');     
?>

<a class="link-ajax link-boton" data-open="vista-agregar-carro" data-link="agregar-vehiculo" data-ajax="form-agregar-carro" data-url="vehiculo/verFormParticular" 
data-visible="form-agregar-carro">Vehiculo Particular</a>

 <form method="post" accept-charset="utf-8" id="form_vehiculo">
    <ul id="datos">
        <li><h2>Datos de la Aseguradora <span>>></span></h2></li>
        <li>
            <select name="empresa">
                <option value="mapfre">Mapfre</option>
                <option value="qualitas">Qualitas</option>
            </select>
        </li>
        <li><input type="text" name="dedusible" value="" id="dedusible" placeholder="Desdusible"/></li>
        <li><input type="text" name="fechaSiniestro" value="" id="fechaSiniestro" placeholder="Fecha del Siniestro"/></li>
        <li><input type="text" name="numeroPoliza" value="" id="numeroPoliza" placeholder="Numero de Poliza"/></li>
        <li><input type="text" name="numeroReporte" value="" id="numeroReporte" placeholder="Numero de Reporte del Siniestro"/></li>
        <li><h2>Datos del Vehiculo <span>>></span></h2></li>
        <li><input type="text" name="vin" value="" id="vin" placeholder="VIN del Vehiculo"/></li>
        <li><input type="text" name="marca" value="" id="marca" placeholder="Marca del Vehiculo" /></li>
        <li><input type="text" name="modelo" value="" id="modelo" placeholder="Modelo del Vehiculo" /></li>
        <li><select name="year" id="year">
            <option value="">Selecciona el año</option>
            <? for($i=$dateTime+1;$i>=1950;$i--)
            {  
                    echo "<option value=\"$i\">$i</option>";
            } ?>
            
        </select></li>
        <li><input type="text" name="color" value="" id="color" placeholder="Color del Vehiculo" /></li>
        <li><input type="text" name="placas" value="" id="placas" placeholder="Placas del Vehiculo"/></li>
        <li><h2>Datos del cliente <span>>></span></h2></li>
        <li><input type="text" name="cliente" value="" id="cliente" placeholder="Cliente"/></li>
        <li><input type="text" name="telefono" value="" id="telefono" placeholder="Telefono"/></li>
        <li><input type="text" name="correo" value="" id="correo" placeholder="Correo Electronico"/></li>
        <li><input type="text" name="rfc" value="" id="rfcº" placeholder="RFC"/></li>
        <li><input type="text" name="direccion" value="" id="direccion" placeholder="Dirección"/></li>
        <li><input type="text" name="celular" value="" id="celular" placeholder="Celular"/></li>
        
        <li><h2>Datos de Factura <span>>></span></h2></li>
        <li><input type="text" name="fechaPromesa"  id="fechaPromesa" placeholder="Fecha Promesa"/></li>
        <li><input type="hidden" id="idVehiculo" name="idVehiculo" value="0" /></li>
        <li><input type="hidden" id="tipoVehiculo" name="tipoVehiculo" value="0" /></li>
        <li><input type="hidden" id="aseguradora" name="aseguradora" value="1" /></li>
        <li><input type="submit" name="btnFormVehiculo" value="Agregar Vehiculo"  onclick="enviarRegistro()" id="btnFormVehiculo"  /></li>
    </ul>
</form>

<script type="text/javascript" src="js/funciones-vehiculo.js"></script>