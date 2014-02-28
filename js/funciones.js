$(function (){
	
	function abrir_from (link_open, section_open, tamanio)
	{
		$('#'+section_open+'').dialog({
			autoOpen: false,
			width: tamanio,
			modal:true,
			buttons: {
				"Cerrar": function () {
					$(this).dialog("close");
					location.reload();
				}
			}
		});
		//Link
		$('.'+link_open+'').after(function () {
			$('#'+section_open+'').dialog('open');
			return false;
		});
	}
	
	$('.link-abrir').click(function (){
		var link_open = $(this).attr('data-link');
		var section_open = $(this).attr('data-open');
		var tamanio = $(this).attr('data-width');
		abrir_from (link_open, section_open, tamanio);
	});
	
	
	function abrir_from_post (link_open, section_open, tamanio, id, url,idOrden)
	{
		
		$('#'+section_open+'').dialog({
			autoOpen: false,
			width: tamanio,
			modal:true,
			position: ['center',80],
			buttons: {
				"Cerrar": function () {
					$(this).dialog("close");
					location.reload();
				}
			}
		});
		//Link
		$('.'+link_open+'').after(function () {
			$.post(url, {id : id,idOrden:idOrden},  function(data){
			$('#'+section_open+'').html(data);});
			$('#'+section_open+'').dialog('open');
			return false;
		});
	}
	
	$('.link-abrir-post').click(function (){
		var link_open = $(this).attr('data-link');
		var section_open = $(this).attr('data-open');
		var tamanio = $(this).attr('data-width');
		var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		var idOrden = $(this).attr('data-idOrden');

		abrir_from_post (link_open, section_open, tamanio, id, url,idOrden);
	});
	
	
	
	/* eliminar un vehiculo */
	
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
	
		jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}
	
	/* validacion default */
	
	jQuery.validator.setDefaults({
		debug: true,
		success: "valid",
		errorClass: "form-error",
		errorElement: "span"
	});
	
	/* Cuadro de Exito */
	$('#cuadro_modificar').dialog({
		autoOpen: false,
		width: 400,
		modal:true,
		buttons: {
			"OK": function() {
			  $( this ).dialog( "close" );
			}
		},
		beforeClose: function( event, ui ) 
		{
			 location.reload();
		}
	});
	
	$('#cuadro_procesoExito').dialog({
		autoOpen: false,
		width: 400,
		modal:true,
		buttons: {
			"OK": function() {
			  $( this ).dialog( "close" );
			}
		}
	});
	
	/* tabla header */
	
	function UpdateTableHeaders() {
       $(".persist-area").each(function() {
       
           var el             = $(this),
               offset         = el.offset(),
               scrollTop      = $(window).scrollTop(),
               floatingHeader = $(".floatingHeader", this)
           
           if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
               floatingHeader.css({
                "visibility": "visible"
               });
           } else {
               floatingHeader.css({
                "visibility": "hidden"
               });      
           };
       });
    }
	
	
	function enviar_form(idForm,urlPost,mensaje)
	{
		if($("#"+form).valid())
		{
		
		$.post(urlPost,$("#"+idForm).serialize(),
		function(data)
		{
			alert(mensaje);
			$("#"+idForm).reset();	
		}
		);
		}
	}
	
	$('.postForm').click(function (){
		var idForm = $(this).attr('data-idForm');
		var urlPost = $(this).attr('data-urlPost');
		var mensaje = $(this).attr('data-mensaje');
		enviar_form (idForm,urlPost,mensaje);
	});
	
	
	
    
    // DOM Ready      
    $(function() {
		
		$('.opcion-tab').click(function (){

			
			var opcion = $(this).attr('data-opcion');
			var url = $(this).attr('data-url');

			if(opcion==2||opcion==1)
			{
				
			}
			else
			{	
				$(".opcion-tab").removeClass("active");
				$(this).addClass("active");
				$('.cont-tab').hide();
				$('.cont-tab[data-opcion='+opcion+']').show();

			}
			
		});
    
       var clonedHeaderRow;
    
       $(".persist-area").each(function() {
           clonedHeaderRow = $(".persist-header", this);
           clonedHeaderRow
             .before(clonedHeaderRow.clone())
             .css("width", clonedHeaderRow.width())
             .addClass("floatingHeader");
             
       });
       
       $(window)
        .scroll(UpdateTableHeaders)
        .trigger("scroll");
       
    });


	
});