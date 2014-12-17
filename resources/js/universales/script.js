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
		// exp 					= /[0-9 \.]/; // expresion regular y buscar codigo asccii
		// ascciiCaracterIngresado = e.which;//which obtiene el codigo ascii del el evento keypress
		// caracter 				= String.fromCharCode(ascciiCaracterIngresado); //obtenemos el caracter ingresado
		// el 						= $(this).val();
		// if(exp.test(caracter)){
		// 	if(el.indexOf('.')!=-1){
		// 		if(caracter=="."){
		// 			e.preventDefault();//evitamos que se ejecute la accion
		// 		}
		// 	}
		// }else{
		// 	e.preventDefault();//evitamos que se ejecute la accion
		// }
		el 						= $(this).val();
		exp = /[0-9 \.]/;
		caracter=getCharFromEvent(e);
		if(testExpression(e, exp)==false){
			if(el.indexOf('.')!=-1){
				e.preventDefault();//evitamos que se ejecute la accion		
			}else{
				e.preventDefault();//evitamos que se ejecute la accion
			}
		}
	});


	//Evento para evitar copiar,pegar y cortar dentro de un TextBox
		
	$('*').bind("cut copy paste",function(e) {
      	e.preventDefault();
    });



});