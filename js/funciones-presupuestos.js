$(function(){
	$('.link-ajax').click(function(){
		var seccion_open = $(this).attr('data-open');
		var seccion_ajax = $(this).attr('data-ajax');
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var idOrden = $(this).attr('data-idOrden');
		$('body').scrollTop(0);
		$('#'+seccion_ajax+'').load(url, {id: id,idOrden: idOrden}, function(){});
		$('#vehiculo').hide();
		$('#'+seccion_open+'').show();
	});

	$('.regresar').click(function(){
		var oculto = $(this).attr('data-oculto');
		var visible = $(this).attr('data-visible');
		var seccion_ajax = $(this).attr('data-ajax');
		$('#'+seccion_ajax+'').html('');
		$('#'+ oculto +'').hide();
		$('#'+ visible +'').show();
	});
});

$(function(){
	$('.link-agregar').click(function(){
		var oculto = $(this).attr('data-oculto');
		var visible = $(this).attr('data-visible');
		$('#'+ oculto +'').hide();
		$('#'+ visible +'').show();
	});
});

$(function(){

	$('.btnAutorizar').click(function()
    {
	
		var idOrden = $(this).attr('data-idOrden');
		var idVehiculo = $(this).attr('data-id');

		var r=confirm("Esta seguro que desea autorizar el presupuesto?");
		
		if (r==true)
		{
			
			$.post('index.php/presupuestos/autorizar',{idVehiculo:idVehiculo,idOrden:idOrden},
			function(data)
			{
				alert("Autorizado correctamente orden #"+data);
				 location.reload();	 
			});
		}
		
	});

	$('.btnCancelar').click(function()
    {
	
		var idOrden = $(this).attr('data-idOrden');

		var r=confirm("Esta seguro que desea cancelar el presupuesto?");
		
		if (r==true)
		{

			$.post('index.php/presupuestos/cancelar',{idOrden:idOrden},
			function(data)
			{
					
				alert("Presupuesto cancelado Correctamente.!")
					
				location.reload();	 
			});

		}	
		
	});
	
	$('#vin').change(function()
    {
	
		var vin = $('#vin').val();
			
			$.post('index.php/vehiculo/fillFormaAgregar',{vin:vin},
			function(data)
			{	
				var obj = $.parseJSON(data);
				
				
				$("#marca").val(obj.marca);
				$("#modelo").val(obj.modelo);
				$("#year").val(obj.year);
				$("#color").val(obj.color);
				$("#placas").val(obj.placas);
				$("#tipoVehiculo").val(obj.tipoVehiculo);
				$("#idVehiculo").val(obj.idVehiculo);
		
				
						 
				
			});
		
	});
	
	
	
	$("#fechaPromesa").datetimepicker({
			addSliderAccess: true,
			dateFormat: "yy-mm-dd",
			sliderAccessArgs: { touchonly: false }
		});
	
		
    $("#form_vehiculo").validate({
		  rules: 
		 	{
				marca: 
				{
					required: true
				},
				modelo: 
				{
					required: true
				},
				placas: 
				{
					required: true
				},
				vin: 
				{
					required: true
				},
				empresa: 
				{
					required: true
				},
				telefono: 
				{
					required: true
				},
				cliente: 
				{
					required: true
				},
				color: 
				{
					required: true
				},
				year:
				{
					required: true
				}
		 	}//rules
	});//validate

$("#btnFormVehiculo").click(function()
{

	if($("#form_vehiculo").valid())
	{
		

		$.post("index.php/presupuestos/agregarPresupuesto",$("#form_vehiculo").serialize(),
		function(data)
		{

			var obj = $.parseJSON(data);

			alert("El registro se ha ingresado correctamente");

            var url = "caracteristicas/verMod";
            var id = obj.idVehiculo;
            var idOrden = obj.idOrden;

            $('#form-agregar-carro').load(url,{id:id,idOrden:idOrden});
		});
	}
});

$(".btnMenu").click(function()
	{
		var id = $(this).attr("data-id");
		
		$(".padre[data-id="+id+"]").fadeOut().hide();
		$(".hijo[data-id="+id+"]").fadeIn().show();
		
	});
	
		$(".btnCloseMenu").click(function()
	{
		var id = $(this).attr("data-id");
		
		$(".padre[data-id="+id+"]").fadeIn().show();
		$(".hijo[data-id="+id+"]").fadeOut().hide();	
		
	});
	
	

});//ready



		




