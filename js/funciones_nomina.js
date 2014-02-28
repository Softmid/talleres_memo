 
$(function() {

	$("#btn_guardar").click(function(){

		$.post("index.php/nomina/agregar_nomina",$("#form_nomina").serialize(),
		function(data)
		{
			alert(data);
        }
		);

	});


 $("#form_nomina").validate({
		  rules: 
		  {
			
		  }//rules
	});//validate
 
});





