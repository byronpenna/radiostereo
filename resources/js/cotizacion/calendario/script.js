$(document).ready(function() {
	$(".conteCalendario").hide();
	
	$(document).on("click",".imagen",function() {
		cuerpo 		= $(this).parents(".cuerpo");
		fechaInicio = cuerpo.find(".txtFechaInicio").val();
		contenedor 	= cuerpo.find(".conteCalendario");
		txtEventos 	= cuerpo.find(".txtEvents");//localizo los eventos guardados en el textbox
		// eventos 	= eventos.split(",");//separar los en forma de arreglo x comas
		
		// var eventosCalendar;
		// if(cuerpo.find(".txtEvents").val() != ""){
		// 	eventosCalendar = putEvents(eventos);
		// }else{
		// 	eventosCalendar = null;
		// }
		// txtEvento = cuerpo.find(".txtEvents");
		// //console.log("la fecha de inicio es: ",fechaInicio);
		if (fechaInicio != "") {
			$("#contenedor1").show();
			getCalendar($(".calendar"),fechaInicio,txtEventos);//mando a llamar a la funcion q me muestra el calendario que esta en funchtion.js
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