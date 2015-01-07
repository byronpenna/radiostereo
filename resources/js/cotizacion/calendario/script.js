$(document).ready(function() {
	$(".conteCalendario").hide();
	
	$(document).on("click",".imagen",function() {
		fechaInicio = $(this).parents(".cuerpo").find(".txtFechaInicio").val();
		//console.log("la fecha de inicio es: ",fechaInicio);
		if (fechaInicio != "") {
			$("#contenedor1").show();
			getCalendar($(".calendar"),fechaInicio);//mando a llamar a la funcion q me muestra el calendario que esta en funchtion.js
			$("#contenedor1").bPopup({//codigo para el popup
		            easing: 'easeOutBack', //uses jQuery easing plugin
		            opacity: 0.6,
		            positionStyle: 'fixed' //'fixed' or 'absolute'
			});
			
		}else{
			alertify.alert("No se ha especificado inicio de pauta");
		}
	});  
})