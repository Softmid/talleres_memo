<?php 
		$ordenResult = $orden->row();
		$vehiculoResult = $vehiculo->row();
        $this->load->model('Procesos_Servicios');
?>

<article class="imprecionOrden clear">
    <section class="header">
        <img src="images/logo_imprecion.png" id="logo-imprecion">

        <aside id="num-orden">
            <h1 id="titulo">ORDEN DE SERVICIO</h1>
            <h1 id="n-titulo">Nº</h1>
            <p id="numero"><? echo $ordenResult->clave; ?></p>
        </aside>
    </section>
    <section class="datos-taller">
        <aside id="texto">
            <p>MIGUEL ANGEL CANUL CATZIN</p>
            <p>R.F.C. CACM-620518-MN3</p>
            <p>CALLE 39 N° 323 x 20 COL. PEDREGALES DE TANLUM</p>
            <p>MERIDA,YUC.  CP. 97210</p>
        </aside>
    </section>
    
    <section class="datos-cliente clear">
        <ul class="clear">
            <li class="clear">
                <p class="grande"><span>Cliente: </span><?php echo $ordenResult->cliente; ?></p>
            </li>
            <li class="clear">
                <p class="grande"><span>Direccion: </span><?php echo $ordenResult->direccion; ?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>RFC: </span><?php echo $ordenResult->rfc; ?></p>
                <p class="chico"><span>Telefono: </span><?php echo $ordenResult->telefono; ?></p>
                <p class="schico"><span>Celular: </span><?php echo $ordenResult->celular; ?></p>
            </li>
            <li class="clear">
                <p class="sschico"><span>Marca: </span><?php echo $vehiculoResult->marca?></p>
                <p class="sschico"><span>Modelo: </span><?php echo $vehiculoResult->modelo?></p>
                <p class="sschico"><span>Año: </span><?php echo $vehiculoResult->year?></p>
                <p class="sschico"><span>Color: </span><?php echo $vehiculoResult->color?></p>
                <p class="sschico"><span>Placa: </span><?php echo $vehiculoResult->placas?></p>
            </li>
            <li class="clear">
                <p class="grande"><span>Nº de VIN: </span><?php echo $vehiculoResult->num_VIN?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>Fecha de entrada: </span><?php echo $ordenResult->fecha_hora?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>Fecha promesa de salida: </span><?php echo $ordenResult->fechaPromesa?></p>
            </li>
        </ul>
    </section>

    <section class="tabla-corbata clear">


                        <table class="corbata">
                            <thead>
                                <tr>
                                    <th width="44%">Vehiculo</th>
                                    <? 
                                    foreach ($categorias->result() as $data) 
                                    {   
                                        
                                        if($data->nombre=="Pintura"||$data->nombre=="pintura")
                                        {
                                            //echo '<th width="8%" id="categoria" data-id="'.$data->idCategorias.'">'.$data->nombre.'</th>';
                                            
                                            $data_result['sub_cat_nombrePintura'] = $this->Procesos_Servicios->subCategorias($data->idCategorias);
                                            
                                           
                                            
                                            foreach($data_result['sub_cat_nombrePintura']->result() as $data_nombrePintura)
                                            {   
                                                
                                                echo '<th width="8%" id="categoria" data-id="'.$data_nombrePintura->idSubcategorias.'">'.$data_nombrePintura->nombre.'</th>';
                                            }
                                            
                                                                                  
                                        }
                                        else
                                        {
                                             echo '<th width="8%" id="categoria" data-id="'.$data->idCategorias.'">'.$data->nombre.'</th>';

                                        }
                                       
                                    }//categorias
                                    ?>         
                                </tr>

                        
                            </thead>
                           <tbody>
                                    <?
                                    foreach ($servicios->result() as $data) 
                                    {
                                        echo '<tr>';
                                            
                                            echo '<td>'.$data->concepto.'</td>';
                                            
                                            foreach ($categorias->result() as $data2) 
                                            {
                                                if($data2->nombre=="Pintura"||$data2->nombre=="pintura")
                                                {   
                                                    
                                                    
                                                    $data_result['sub_cat_pintura'] = $this->Procesos_Servicios->subCategorias($data2->idCategorias);
                                                    
                                                     foreach ($data_result['sub_cat_pintura']->result() as $data_sub) 
                                                    {
                                                    
                                                    
                                                    $query['sub'] = $this->Procesos_Servicios->monto_subcategoria($data2->idCategorias,$ordenResult->idOrdenes,$data->id,$data_sub->idSubcategorias);
                                                    
                                                    $var = $query['sub']->row();

                                                    if($query['sub']->num_rows()>0)

                                                    {   
                                                                                                            
                                                        if($var->monto_subcat>0)
                                                        {
                                                            echo '<td width="8%">X</td>';

                                                        }
                                                        else
                                                        {
                                                            echo '<td width="8%"></td>';
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo '<td width="8%"></td>';
                                                    }
                                                    
                                                    }//foreach subcategorias de pintura    

                                                    
                                                }
                                                
                                                else
                                                {
                                                
                                                    $data_result['suma'] = $this->Procesos_Servicios->suma_monto_categoria($data2->idCategorias,$ordenResult->idOrdenes,$data->id);                          
                                                    $suma = $data_result['suma']->row();

                                                    if($suma->monto_categoria>0)
                                                    {
                                                        echo '<td width="8%">X</td>';

                                                    }
                                                    else
                                                    {
                                                        echo '<td width="8%"></td>';
                                                    }
                                                }
                                               

                                               
                                                

                                            }//categorias

                                        echo '</tr>';
                                    }//categorias
                                    ?>
                           </tbody>
                        </table>

        <table class="porcentaje">
            <thead>
                <tr>
                    <th colspan="10">Porcentaje</th>
                                       
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="10%">20%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">40%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">60%</td>
            		<td width="10%"></td>
    
            		<td width="10%">80%</td>
            		<td width="10%"></td>
                    
                    <td width="10%">100%</td>
            		<td width="10%"></td>
                </tr>
            </tbody>
        </table>

        <table class="briciado">
            <thead>
                <tr>
                    <th colspan="4">Briciado</th>
                                       
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="25%">SI</td>
                    <td width="25%"></td>
                    <td width="25%">NO</td>
                    <td width="25%"></td>
                </tr>
            </tbody>
        </table>

    </section>
    
</article>





<? foreach ($categorias->result() as $data_cat) 
{   
                                        
    if($data_cat->nombre == "Pintura"||$data_cat->nombre == "pintura"){
?> 
        <article class="imprecionOrden clear">
	<section class="header">
		<img src="images/logo_imprecion.png" id="logo-imprecion">

		<aside id="num-orden">
			<h1 id="titulo">ORDEN DE SERVICIO</h1>
			<h1 id="n-titulo">Nº</h1>
			<p id="numero"><? echo $ordenResult->clave; ?></p>
		</aside>
	</section>
	<section class="datos-taller">
		<aside id="texto">
			<p>MIGUEL ANGEL CANUL CATZIN</p>
			<p>R.F.C. CACM-620518-MN3</p>
			<p>CALLE 39 N° 323 x 20 COL. PEDREGALES DE TANLUM</p>
			<p>MERIDA,YUC.  CP. 97210</p>
		</aside>
	</section>
	
	<section class="datos-cliente clear">
		<ul class="clear">
			<li class="clear">
				<p class="grande"><span>Cliente: </span><?php echo $ordenResult->cliente; ?></p>
			</li>
			<li class="clear">
				<p class="grande"><span>Direccion: </span><?php echo $ordenResult->direccion; ?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>RFC: </span><?php echo $ordenResult->rfc; ?></p>
				<p class="chico"><span>Telefono: </span><?php echo $ordenResult->telefono; ?></p>
				<p class="schico"><span>Celular: </span><?php echo $ordenResult->celular; ?></p>
			</li>
			<li class="clear">
				<p class="sschico"><span>Marca: </span><?php echo $vehiculoResult->marca?></p>
				<p class="sschico"><span>Modelo: </span><?php echo $vehiculoResult->modelo?></p>
				<p class="sschico"><span>Año: </span><?php echo $vehiculoResult->year?></p>
				<p class="sschico"><span>Color: </span><?php echo $vehiculoResult->color?></p>
				<p class="sschico"><span>Placa: </span><?php echo $vehiculoResult->placas?></p>
			</li>
			<li class="clear">
				<p class="grande"><span>Nº de VIN: </span><?php echo $vehiculoResult->num_VIN?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>Fecha de entrada: </span><?php echo $ordenResult->fecha_hora?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>Fecha promesa de salida: </span><?php echo $ordenResult->fechaPromesa?></p>
			</li>
		</ul>
	</section>

	<section class="tabla-corbata clear">


		<table class="corbata">
        	<thead>
                <tr>

                    <th width="44%"><? echo $data_cat->nombre; ?></th>
                    <?
                        $this->load->model('Procesos_Servicios');
                        $data_result['sub_cat'] = $this->Procesos_Servicios->subCategorias($data_cat->idCategorias);

                        foreach ($data_result['sub_cat']->result() as $data_sub) {
                            echo '<th width="44%">'.$data_sub->nombre.'</th>';
                        }
                    ?>
                                   
                </tr>

        
            </thead>
            <?
                    foreach ($servicios->result() as $data) 
                    {
                        echo '<tr>';
                            
                            echo '<td>'.$data->concepto.'</td>';
                            
                            foreach ($data_result['sub_cat']->result() as $data2) 
                            {
                               
                                $query['sub'] = $this->Procesos_Servicios->monto_subcategoria($data_cat->idCategorias,$ordenResult->idOrdenes,$data->id,$data2->idSubcategorias);

                                $var = $query['sub']->row();

                                if($query['sub']->num_rows()>0)

                                {
                                    if($var->monto_subcat>0)
                                    {
                                        echo '<td width="8%">X</td>';
                                        
                                    }
                                    else
                                    {
                                        echo '<td width="8%"></td>';
                                    }
                                }
                                else
                                {
                                    echo '<td width="8%"></td>';
                                }

                            }//categorias

                        echo '</tr>';
                    }//categorias
                    ?>
        </table>

        <table class="porcentaje">
        	<thead>
                <tr>
                    <th colspan="10">Porcentaje</th>
                                       
                </tr>
            </thead>
            <tbody>
            	<tr>
            		<td width="10%">20%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">40%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">60%</td>
            		<td width="10%"></td>
    
            		<td width="10%">80%</td>
            		<td width="10%"></td>
                    
                    <td width="10%">100%</td>
            		<td width="10%"></td>
            	</tr>
            </tbody>
        </table>

        <table class="briciado">
        	<thead>
                <tr>
                    <th colspan="4">Briciado</th>
                                       
                </tr>
            </thead>
            <tbody>
            	<tr>
            		<td width="25%">SI</td>
            		<td width="25%"></td>
            		<td width="25%">NO</td>
            		<td width="25%"></td>
            	</tr>
            </tbody>
        </table>

	</section>
	
</article>
    
        <? //laboratorio ?>
        <article class="imprecionOrden clear">
    <section class="header">
        <img src="images/logo_imprecion.png" id="logo-imprecion">

        <aside id="num-orden">
            <h1 id="titulo">ORDEN DE SERVICIO</h1>
            <h1 id="n-titulo">Nº</h1>
            <p id="numero"><? echo $ordenResult->clave; ?></p>
        </aside>
    </section>
    <section class="datos-taller">
        <aside id="texto">
            <p>MIGUEL ANGEL CANUL CATZIN</p>
            <p>R.F.C. CACM-620518-MN3</p>
            <p>CALLE 39 N° 323 x 20 COL. PEDREGALES DE TANLUM</p>
            <p>MERIDA,YUC.  CP. 97210</p>
        </aside>
    </section>
    
    <section class="datos-cliente clear">
        <ul class="clear">
            <li class="clear">
                <p class="grande"><span>Cliente: </span><?php echo $ordenResult->cliente; ?></p>
            </li>
            <li class="clear">
                <p class="grande"><span>Direccion: </span><?php echo $ordenResult->direccion; ?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>RFC: </span><?php echo $ordenResult->rfc; ?></p>
                <p class="chico"><span>Telefono: </span><?php echo $ordenResult->telefono; ?></p>
                <p class="schico"><span>Celular: </span><?php echo $ordenResult->celular; ?></p>
            </li>
            <li class="clear">
                <p class="sschico"><span>Marca: </span><?php echo $vehiculoResult->marca?></p>
                <p class="sschico"><span>Modelo: </span><?php echo $vehiculoResult->modelo?></p>
                <p class="sschico"><span>Año: </span><?php echo $vehiculoResult->year?></p>
                <p class="sschico"><span>Color: </span><?php echo $vehiculoResult->color?></p>
                <p class="sschico"><span>Placa: </span><?php echo $vehiculoResult->placas?></p>
            </li>
            <li class="clear">
                <p class="grande"><span>Nº de VIN: </span><?php echo $vehiculoResult->num_VIN?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>Fecha de entrada: </span><?php echo $ordenResult->fecha_hora?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>Fecha promesa de salida: </span><?php echo $ordenResult->fechaPromesa?></p>
            </li>
        </ul>
    </section>

    <section class="tabla-corbata clear">


        <table class="corbata">
            <thead>
                <tr>

                    <th width="44%">Laboratorio</th>
                    <?
                        $this->load->model('Procesos_Servicios');
                        $data_result['sub_cat'] = $this->Procesos_Servicios->subCategorias($data_cat->idCategorias);

                        foreach ($data_result['sub_cat']->result() as $data_sub) {
                            echo '<th width="44%">'.$data_sub->nombre.'</th>';
                        }
                    ?>
                                   
                </tr>

        
            </thead>
            <?
                    foreach ($servicios->result() as $data) 
                    {
                        echo '<tr>';
                            
                            echo '<td>'.$data->concepto.'</td>';
                            
                            foreach ($data_result['sub_cat']->result() as $data2) 
                            {
                               
                                $query['sub'] = $this->Procesos_Servicios->monto_subcategoria($data_cat->idCategorias,$ordenResult->idOrdenes,$data->id,$data2->idSubcategorias);

                                $var = $query['sub']->row();

                                if($query['sub']->num_rows()>0)

                                {
                                    if($var->monto_subcat>0)
                                    {
                                        echo '<td width="8%">X</td>';
                                        
                                    }
                                    else
                                    {
                                        echo '<td width="8%"></td>';
                                    }
                                }
                                else
                                {
                                    echo '<td width="8%"></td>';
                                }

                            }//categorias

                        echo '</tr>';
                    }//categorias
                    ?>
        </table>

        <table class="porcentaje">
            <thead>
                <tr>
                    <th colspan="10">Porcentaje</th>
                                       
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td width="10%">20%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">40%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">60%</td>
            		<td width="10%"></td>
    
            		<td width="10%">80%</td>
            		<td width="10%"></td>
                    
                    <td width="10%">100%</td>
            		<td width="10%"></td>
                </tr>
            </tbody>
        </table>

        <table class="briciado">
            <thead>
                <tr>
                    <th colspan="4">Briciado</th>
                                       
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="25%">SI</td>
                    <td width="25%"></td>
                    <td width="25%">NO</td>
                    <td width="25%"></td>
                </tr>
            </tbody>
        </table>

    </section>
    
</article>
<?    }// Pintura
    else {}
                                        
    if($data_cat->nombre == "Herreria"||$data_cat->nombre == "Pintura"||$data_cat->nombre == "pintura"){}
    else{
?>

<article class="imprecionOrden clear">
	<section class="header">
		<img src="images/logo_imprecion.png" id="logo-imprecion">

		<aside id="num-orden">
			<h1 id="titulo">ORDEN DE SERVICIO</h1>
			<h1 id="n-titulo">Nº</h1>
			<p id="numero"><? echo $ordenResult->clave; ?></p>
		</aside>
	</section>
	<section class="datos-taller">
		<aside id="texto">
			<p>MIGUEL ANGEL CANUL CATZIN</p>
			<p>R.F.C. CACM-620518-MN3</p>
			<p>CALLE 39 N° 323 x 20 COL. PEDREGALES DE TANLUM</p>
			<p>MERIDA,YUC.  CP. 97210</p>
		</aside>
	</section>
	
	<section class="datos-cliente clear">
		<ul class="clear">
			<li class="clear">
				<p class="grande"><span>Cliente: </span><?php echo $ordenResult->cliente; ?></p>
			</li>
			<li class="clear">
				<p class="grande"><span>Direccion: </span><?php echo $ordenResult->direccion; ?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>RFC: </span><?php echo $ordenResult->rfc; ?></p>
				<p class="chico"><span>Telefono: </span><?php echo $ordenResult->telefono; ?></p>
				<p class="schico"><span>Celular: </span><?php echo $ordenResult->celular; ?></p>
			</li>
			<li class="clear">
				<p class="sschico"><span>Marca: </span><?php echo $vehiculoResult->marca?></p>
				<p class="sschico"><span>Modelo: </span><?php echo $vehiculoResult->modelo?></p>
				<p class="sschico"><span>Año: </span><?php echo $vehiculoResult->year?></p>
				<p class="sschico"><span>Color: </span><?php echo $vehiculoResult->color?></p>
				<p class="sschico"><span>Placa: </span><?php echo $vehiculoResult->placas?></p>
			</li>
			<li class="clear">
				<p class="grande"><span>Nº de VIN: </span><?php echo $vehiculoResult->num_VIN?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>Fecha de entrada: </span><?php echo $ordenResult->fecha_hora?></p>
			</li>
			<li class="clear">
				<p class="chico"><span>Fecha promesa de salida: </span><?php echo $ordenResult->fechaPromesa?></p>
			</li>
		</ul>
	</section>

	<section class="tabla-corbata clear">


		<table class="corbata">
        	<thead>
                <tr>

                    <th width="44%"><? echo $data_cat->nombre; ?></th>
                    <?
                        $this->load->model('Procesos_Servicios');
                        $data_result['sub_cat'] = $this->Procesos_Servicios->subCategorias($data_cat->idCategorias);

                        foreach ($data_result['sub_cat']->result() as $data_sub) {
                            echo '<th width="44%">'.$data_sub->nombre.'</th>';
                        }
                    ?>
                                   
                </tr>

        
            </thead>
            <?
                    foreach ($servicios->result() as $data) 
                    {
                        echo '<tr>';
                            
                            echo '<td>'.$data->concepto.'</td>';
                            
                            foreach ($data_result['sub_cat']->result() as $data2) 
                            {
                               
                                $query['sub'] = $this->Procesos_Servicios->monto_subcategoria($data_cat->idCategorias,$ordenResult->idOrdenes,$data->id,$data2->idSubcategorias);

                                $var = $query['sub']->row();

                                if($query['sub']->num_rows()>0)

                                {
                                    if($var->monto_subcat>0)
                                    {
                                        echo '<td width="8%">X</td>';
                                        
                                    }
                                    else
                                    {
                                        echo '<td width="8%"></td>';
                                    }
                                }
                                else
                                {
                                    echo '<td width="8%"></td>';
                                }

                            }//categorias

                        echo '</tr>';
                    }//categorias
                    ?>
        </table>

        <table class="porcentaje">
        	<thead>
                <tr>
                    <th colspan="10">Porcentaje</th>
                                       
                </tr>
            </thead>
            <tbody>
            	<tr>
            		<td width="10%">20%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">40%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">60%</td>
            		<td width="10%"></td>
    
            		<td width="10%">80%</td>
            		<td width="10%"></td>
                    
                    <td width="10%">100%</td>
            		<td width="10%"></td>
            	</tr>
            </tbody>
        </table>

        <table class="briciado">
        	<thead>
                <tr>
                    <th colspan="4">Briciado</th>
                                       
                </tr>
            </thead>
            <tbody>
            	<tr>
            		<td width="25%">SI</td>
            		<td width="25%"></td>
            		<td width="25%">NO</td>
            		<td width="25%"></td>
            	</tr>
            </tbody>
        </table>

	</section>
	
</article>

<?  
    }// else
}//foreach categoria ?>




<?
    foreach ($categorias->result() as $data_cat) 
{   
    if($data_cat->nombre == "Pintura"||$data_cat->nombre == "pintura"){}
    if($data_cat->nombre == "Herreria"){
?>


<article class="imprecionOrden clear">
    <section class="header">
        <img src="images/logo_imprecion.png" id="logo-imprecion">

        <aside id="num-orden">
            <h1 id="titulo">ORDEN DE SERVICIO</h1>
            <h1 id="n-titulo">Nº</h1>
            <p id="numero"><? echo $ordenResult->clave; ?></p>
        </aside>
    </section>
    <section class="datos-taller">
        <aside id="texto">
            <p>MIGUEL ANGEL CANUL CATZIN</p>
            <p>R.F.C. CACM-620518-MN3</p>
            <p>CALLE 39 N° 323 x 20 COL. PEDREGALES DE TANLUM</p>
            <p>MERIDA,YUC.  CP. 97210</p>
        </aside>
    </section>
    
    <section class="datos-cliente clear">
        <ul class="clear">
            <li class="clear">
                <p class="grande"><span>Cliente: </span><?php echo $ordenResult->cliente; ?></p>
            </li>
            <li class="clear">
                <p class="grande"><span>Direccion: </span><?php echo $ordenResult->direccion; ?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>RFC: </span><?php echo $ordenResult->rfc; ?></p>
                <p class="chico"><span>Telefono: </span><?php echo $ordenResult->telefono; ?></p>
                <p class="schico"><span>Celular: </span><?php echo $ordenResult->celular; ?></p>
            </li>
            <li class="clear">
                <p class="sschico"><span>Marca: </span><?php echo $vehiculoResult->marca?></p>
                <p class="sschico"><span>Modelo: </span><?php echo $vehiculoResult->modelo?></p>
                <p class="sschico"><span>Año: </span><?php echo $vehiculoResult->year?></p>
                <p class="sschico"><span>Color: </span><?php echo $vehiculoResult->color?></p>
                <p class="sschico"><span>Placa: </span><?php echo $vehiculoResult->placas?></p>
            </li>
            <li class="clear">
                <p class="grande"><span>Nº de VIN: </span><?php echo $vehiculoResult->num_VIN?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>Fecha de entrada: </span><?php echo $ordenResult->fecha_hora?></p>
            </li>
            <li class="clear">
                <p class="chico"><span>Fecha promesa de salida: </span><?php echo $ordenResult->fechaPromesa?></p>
            </li>
        </ul>
    </section>

    <section class="tabla-corbata clear">


        <table class="corbata">
            <thead>
                <tr>

                    <th width="44%"><? echo $data_cat->nombre; ?></th>
                    <?
                        $this->load->model('Procesos_Servicios');
                        $data_result['sub_cat'] = $this->Procesos_Servicios->subCategorias($data_cat->idCategorias);

                        foreach ($data_result['sub_cat']->result() as $data_sub) {
                            echo '<th width="44%">'.$data_sub->nombre.'</th>';
                        }
                    ?>
                                   
                </tr>

        
            </thead>
            <?
                    foreach ($servicios->result() as $data) 
                    {
                        echo '<tr>';
                            
                            echo '<td>'.$data->concepto.'</td>';
                            
                            foreach ($data_result['sub_cat']->result() as $data2) 
                            {
                               
                                $query['sub'] = $this->Procesos_Servicios->monto_subcategoria($data_cat->idCategorias,$ordenResult->idOrdenes,$data->id,$data2->idSubcategorias);

                                $var = $query['sub']->row();

                                if($query['sub']->num_rows()>0)

                                {
                                    if($var->monto_subcat>0)
                                    {
                                        echo '<td width="8%">X</td>';
                                        
                                    }
                                    else
                                    {
                                        echo '<td width="8%"></td>';
                                    }
                                }
                                else
                                {
                                    echo '<td width="8%"></td>';
                                }

                            }//categorias

                        echo '</tr>';
                    }//categorias
                    ?>
        </table>

        <table class="porcentaje">
            <thead>
                <tr>
                    <th colspan="10">Porcentaje</th>
                                       
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="10%">20%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">40%</td>
            		<td width="10%"></td>
            	
            		<td width="10%">60%</td>
            		<td width="10%"></td>
    
            		<td width="10%">80%</td>
            		<td width="10%"></td>
                    
                    <td width="10%">100%</td>
            		<td width="10%"></td>
            </tbody>
        </table>

        <table class="briciado">
            <thead>
                <tr>
                    <th colspan="4">Briciado</th>
                                       
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="25%">SI</td>
                    <td width="25%"></td>
                    <td width="25%">NO</td>
                    <td width="25%"></td>
                </tr>
            </tbody>
        </table>

    </section>
    
</article>

<?
    }// Herreria
    else{}

?>

<? }//Categorias ?>

<style type="text/css" media="print">
@page{
   margin: 0;
}
</style>

<script type="text/javascript">
    $(document).ready(function(){
        var aux = $('.imprecionOrden').height();
        if(aux <= 570)
        {
            $('.imprecionOrden').height('600');
        }
        else
        {
            $('.imprecionOrden').height('1100');
        }
    });
</script>