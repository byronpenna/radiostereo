$(document).ready(function(){

	$("select").prop('selectedIndex', -1);
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
	$(document).on("keypress",".NumPunto",function(e){//evento para validar si es un numero
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


	$(document).on("keypress",".SoloNumero",function(e){//evento para validar si es un numero
		el 			= $(this).val();
		exp 		= /[0-9]/;
		caracter 	=getCharFromEvent(e);
		if(!testExpression(e, exp)){
			e.preventDefault();
		}
	});

	//Evento para evitar copiar,pegar y cortar dentro de un TextBox
	$('*').bind("cut copy paste",function(e) {
      	e.preventDefault();
    });

    $('.blur').blur(function(){
    	tr 			= $(this).parents("tr");
    	tabla		= $(this).parents("table");
    	cantidad 	= tr.find(".txtCantidad");
    	duracion 	= tr.find(".txtDuracion");
    	select 		= tr.find(".precios option:selected").html();
    	subTotal	= tr.find(".subTotal");
    	total 		= tabla.find(".total");
    	try{
    		var valsin = select.replace("$","");
    	}catch(err){
    		console.log(err.message);
    		valsin="";
    	}
    	
    	valCantidad = cantidad.val();
    	valDuracion = duracion.val();
    	res=0;
    	res=valsin*valCantidad*valDuracion;
    	if(res!=0){
    		subTotal.val(res.toFixed(2));
    	}
    	//Calcular el Total
    	sum 	= 0;
    	tabla.find(".subTotal").each(function(i,val){
    		valor 	= $(this).val();
    		if(isNumber(valor)){
    			sum += parseFloat(valor);
    		}
    	})
    	if(sum.toFixed(2)!=0.00){
    		total.val(sum.toFixed(2));
    	}
    });
});