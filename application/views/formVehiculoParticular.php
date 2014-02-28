<?
    date_default_timezone_set('Mexico/General');
    $date = new DateTime('NOW');
    $dateTime = $date->format('Y');     
?>

<a class="link-ajax link-boton" data-open="vista-agregar-carro" data-link="agregar-vehiculo" data-ajax="form-agregar-carro" data-url="vehiculo/verFormAseguradora" 
data-visible="form-agregar-carro">Vehiculo Aseguradora</a>

<form method="post" accept-charset="utf-8" id="form_vehiculo">
            <ul id="datos">
                
                <li><h2>Datos del Vehiculo<span>>></span></h2></li>
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
                <li>
                    <select name="empresa">
                        <option value="particular">Particular</option>
                    </select>
                </li>
                <li><input type="text" name="cliente" value="" id="cliente" placeholder="Cliente"/></li>
                <li><input type="text" name="telefono" value="" id="telefono" placeholder="Telefono"/></li>
                <li><input type="text" name="correo" value="" id="correo" placeholder="Correo Electronico"/></li>
                <li><input type="text" name="rfc" value="" id="rfc" placeholder="RFC"/></li>
                <li><input type="text" name="direccion" value="" id="direccion" placeholder="Dirección"/></li>
                <li><input type="text" name="celular" value="" id="celular" placeholder="Celular"/></li>
                
                <li><h2>Datos de Factura <span>>></span></h2></li>
                <li><input type="text" name="fechaPromesa"  id="fechaPromesa" placeholder="Fecha Promesa"/></li>
                <li><input type="hidden" id="idVehiculo" name="idVehiculo" value="0" /></li>
                <li><input type="hidden" id="aseguradora" name="aseguradora" value="0" /></li>
                <li><input type="hidden" id="tipoVehiculo" name="tipoVehiculo" value="0" /></li>
                <li><input type="submit" name="btnFormVehiculo" value="Agregar Vehiculo"  onclick="enviarRegistro()" id="btnFormVehiculo"  /></li>
            </ul>
</form>

<script type="text/javascript" src="js/funciones-vehiculo.js"></script>


<!-- <section class="contenedor" id="form-agregar-carro" style="display:none;">
    <section id="form-agregar-carro" title="Formulario Agregar Vehiculo">
        
        <section class="tabs clear">

        <aside id="menu-opciones" class="clear">
            <a class="link-boton regresar" data-oculto="form-agregar-carro" data-visible="vehiculo">Regresar</a>
        </aside>

        <nav>
            <ul>
                <li><a class="opcion-tab active" data-url="" data-opcion="3">Particular</a></li>
                <li><a class="opcion-tab" data-url="" data-opcion="4">Aseguradora</a></li>
            </ul>
        </nav>

        <nav class="nav">
            <ul>
                <li><a class="opcion-tab active" data-url="vehiculo/verFormParticular" data-opcion="1">Paso 1</a></li>
                <li><a class="opcion-tab" data-url="caracteristicas/verMod" data-opcion="2">Paso 2</a></li>
            </ul>
        </nav>


        <aside class="cont-tab clear" data-opcion="1">
            
        </aside>
        <aside class="cont-tab clear" data-opcion="2"  style="display:none;">
       
        </aside>
        <aside class="cont-tab clear" data-opcion="4"  style="display:none;">
       
        </aside>
        </section>
    </section>   
</section> -->