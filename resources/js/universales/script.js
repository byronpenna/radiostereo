$(document).ready(function(){

	var f = new Date();
	console.log(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
	$("#fechaCreacion").val(f.getFullYear()+"-"+(f.getMonth() +1) + "-" + f.getDate());


	$(document).on('submit','#frmLogout',function(e){
		e.preventDefault();
		var frmlout= serializeToJson($(this).serializeArray());
		console.log(frmlout);
		logOut(frmlout);
	});


	//keypress
	$(document).on("keypress",".soloNumeros",function(e){//evento para validar si es un numero
		el 			= $(this).val();
		exp 		= /[0-9 \.]/;
		caracter 	=getCharFromEvent(e);
		if(testExpression(e, exp)){
			if(el.indexOf('.')!=-1){
				if(caracter=="."){
					e.preventDefault();
				}
			}
		}else{
			e.preventDefault();
		}
	});


	//Evento para evitar copiar,pegar y cortar dentro de un TextBox
		
	$('*').bind("cut copy paste",function(e) {
      	e.preventDefault();
    });



});