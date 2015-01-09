$(document).ready(function() {
	$(".conteCalendario").hide();
	
	$(document).on("click",".imagen",function() {
		fechaInicio = $(this).parents(".cuerpo").find(".txtFechaInicio").val();
		fechaFin = $(this).parents(".cuerpo").find(".txtFechaFin").val();
		//fi = $.datepicker.parseDate('YYYY-MM-DD', fechaInicio );
		ff = Date.parse(fechaFin);
		eventos = $(this).parents(".cuerpo").find(".txtEvents").val()
		var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		var diasSemana = new Array("D","L","M","M","J","V","S");
		for (var i = 0; i <= diasSemana.length-1; i++) {
			txtEvento.val(txtEvento.val().replace(diasSemana[i]));
		};
		eventos = $(this).parents(".cuerpo").find(".txtEvents").val();//localizo los eventos guardados en el textbox
		//fechaInicio = fechaInicio.split(",");//separar los en forma de arreglo x comas
		txtEvento= $(this).parents(".cuerpo").find(".txtEvents");
		console.log(eventos);
		//console.log("la fecha de inicio es: ",fi, " y la fecha fin es: ",ff);
		if (fechaInicio != "") {
			
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