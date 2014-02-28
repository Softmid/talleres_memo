$(function(){
	$('.link-ajax').click(function(){
		var seccion_open = $(this).attr('data-open');
		var seccion_ajax = $(this).attr('data-ajax');
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var idOrden = $(this).attr('data-idOrden');
		$('body').scrollTop(0);
		$('#'+seccion_ajax+'').load(url, {id: id, idOrden: idOrden});
		$('#vehiculo').hide();
		$('#'+seccion_open+'').show();
		
	});

	$('.regresar').click(function(){
		// var oculto = $(this).attr('data-oculto');
		// var visible = $(this).attr('data-visible');
		// var seccion_ajax = $(this).attr('data-ajax');
		// $('#'+seccion_ajax+'').html('');
		// $('#'+ oculto +'').hide();
		// $('#'+ visible +'').show();
		location.reload();
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
	
	
	$("#fechaPromesa").datetimepicker({
			addSliderAccess: true,
			dateFormat: "yy-mm-dd",
			sliderAccessArgs: { touchonly: false }
		});
	
	$("#fechaSiniestro").datetimepicker({
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
			correo: 
			{
				email: true
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
			},
			monto:
			{
				required: true,
				number: true
			}
		  }//rules
	});//validate
	$("#form_categorias").validate({
		  rules: 
		  {
			categoria: 
			{
				required: true
			}
		  }//rules
	});//validate
	$("#form_subCategorias").validate({
		  rules: 
		  {
			categoria: 
			{
				required: true
			},
			subCategoria: 
			{
				required: true
			}
		  }//rules
	});//validate
});//ready

function enviarRegistro()
{
	if($("#form_vehiculo").valid())
	{
		
		$.post("index.php/vehiculo/C_Agregar_vehiculo",$("#form_vehiculo").serialize(),
		function(data)
		{
            var obj = $.parseJSON(data);

			alert("El registro se ha ingresado correctamente");

            var url = "caracteristicas/verMod";
            var id = obj.idVehiculo;
            var idOrden = obj.idOrden;

            $('#form-agregar-carro').load(url,{id:id,idOrden:idOrden});
            
			
		}
		);
	}//validacion	
}

$("#monto").change(function()
{
	$('#monto').number( true, 3 );
}
);

$('#factura').change(function(){
    var c = this.checked;
	var monto = $("#monto").val();
	var iva = 0;
	
	$('#iva').number( true, 3 );
	
   if(c && (monto!=""||monto!=null))
   {
	   
	   
	   iva = monto *.16;
	   
	   $("#iva").val(iva);
	   $("#iva").prop('disabled',false);
	   $("#num_factura").prop('disabled',false);
   }
   else
   {
	   var iva = $("#iva").val();
	   monto = 0;
	   $("#monto").val(monto);
	   $("#iva").val(null);
	   $("#num_factura").val(null);
	   $("#iva").prop('disabled',true);
	   $("#num_factura").prop('disabled',true);
	}  
	
});

function eliminar (id,url,seccion)
	{
		$('#'+seccion).dialog({
			resizable: false,
			height:200,
			modal: true,
			buttons: {
				"Continuar": function() {
					$.post(url,{id:id},
					function(data)
					{
				  			location.reload();	
					}
					);
					
				  	
				},
				Cancel: function() {
				  $( this ).dialog( "close" );
				  
				  
				}
			}
		});
		//Link
		$('.link-abrir-cuadro').after(function () {
			$('#'+seccion).dialog('open');
			return false;
		});
	}
	
	$('.link-boton-finalizar').click(function (){
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var seccion = $(this).attr('data-open');
		eliminar(id,url,seccion);
	});





