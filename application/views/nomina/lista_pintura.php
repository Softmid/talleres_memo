<?php if ($this->session->flashdata('msg_success')): ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('msg_success'); ?>
	</div>
<?php endif ?>
<?php echo validation_errors(); ?>
<section class="contenedor">
    <div class="retenciones">
       <h2><? echo $empleado->nombre.' '.$empleado->apellidoPat.' '.$empleado->apellidoMat; ?><br> Area: <? echo $empleado->area; ?> <br> Puesto: <? echo $empleado->puesto; ?> </h2>
    <a href="nomina/agregar_pintura/<? echo $info['semana'].'/'.$info['year'].'/'.$info['id_empleado'].'/'.$info['fecha_ini'].'/'.$info['fecha_fin']; ?>" class="link-ajax link-boton">Agregar Pintura</a>
     <div>
         <br>
        <form action="" method="post">
          <input type="text" name="anticipo_trabajo" value="<? echo set_value('anticipo_trabajo',$retenciones->anticipo_trabajo); ?>" placeholder="Anticipo"  >
          <input type="text" name="prestamo_pintura" value="<? echo set_value('prestamo_pintura',$retenciones->prestamo_pintura); ?>" placeholder="Prestamo">
          <input type="submit" class="btn_pintura"> 
        </form>
         
     </div>
       <h2>Pintura</h2>
        <table id="tabla-despliegue" class="persist-area">
        	<thead>
                <tr class="persist-header header-tabla">
                    <th width="69">Orden</th>
                    <th width="136">Marca</th>
                    <th width="132">Modelo</th>
                    <th width="111">Color</th>
                    <th width="111">Piezas</th>
                    <th width="238">Menu</th>                
                </tr>
            </thead>
           
           <?php if ($pintura->num_rows()): ?>
           <? foreach($pintura->result() as $row):  ?>
               <tr>
                            <td align="center"><?php echo $row->clave?></td>
                            <td align="center"><?php echo $row->marca?></td>
                            <td align="center"><?php echo $row->modelo?></td>
                            <td align="center"><?php echo $row->color?></td>
                            <td align="center"><?php echo $row->piezas?></td>
                            <td align="center">
                                <a class="link-boton menu" href="nomina/editar_pintura/<?php echo $info['semana'].'/'.$info['year'].'/'.$info['id_empleado'].'/'.$info['fecha_ini'].'/'.$info['fecha_fin'].'/'.$row->id; ?>" >Editar</a>
                                <a class="link-boton menu" href="nomina/borrar_pintura/<?php echo $info['semana'].'/'.$info['year'].'/'.$info['id_empleado'].'/'.$info['fecha_ini'].'/'.$info['fecha_fin'].'/'.$row->id; ?>" >Borrar</a>
                            </td>
                        </tr>
            <? endforeach ?>
    
            <?php else: ?>

				<tr>
					<td class="text-center" colspan="7">No se encontraron resultados.</td>
				</tr>
    
			<?php endif ?>
        </table>
    </div>
</section>