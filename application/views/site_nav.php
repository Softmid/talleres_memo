<?
function active($a, $b)
{
	if($a == $b)
	{
		echo 'class="active"';
	}
}


?>
<header class="container-fluid">
    <div class="row">
        <h1 id="titulo" class="col-md-4">Sistema Talleres Memo</h1>
    <nav id="header-panel">
        <ul>
            <li <?php active($pagina, 'vehiculos')?>><a href="index.php/vehiculo/ver_vehiculo">Vehiculo</a></li>
            <?php if($this->session->userdata('privilegios')==1) { ?><li <?php active($pagina, 'usuarios')?>><a href="index.php/usuario/ver_usuario">Usuario</a></li><? } ?>
            <li <?php active($pagina, 'empleados')?>><a href="index.php/empleado/ver">Empleados</a></li>
            <li <?php active($pagina, 'gastosFijos')?>><a href="index.php/gastos/ver_gastos">Gastos</a></li>
            <?php if($this->session->userdata('privilegios')==1) { ?><li <?php active($pagina, 'reportes')?>><a href="index.php/reportes/C_ver_reportesFechas">Reportes</a></li> <? } ?>
            <li <?php active($pagina, 'presupuestos')?>><a href="index.php/presupuestos/ver_presupuestos">Presupuestos</a></li>
            <?php if($this->session->userdata('privilegios')==1) { ?><li <?php active($pagina, 'nomina')?>><a href="index.php/nomina/ver">Nomina</a></li> <? } ?>
            
            
        </ul>
    </nav>
    <aside id="left-datos">
    	<aside id="datos">
            <h3 id="admin">Administrador: <?php echo $this->session->userdata('usuario')?></h3>
            <span id="clock1"></span>
        </aside>
        <a href="index.php/login/cerrarSesion" id="cerrar"><span>X</span>Cerrar Sesión</a>
    </aside>
    </div>
	
</header>
<script type="text/javascript">
	$(function () {  
	  $("#clock1").clock({"langSet":"es","format":"12"});												   
	});
</script>