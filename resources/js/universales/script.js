$(document).ready(function(){

	$("select").prop('selectedIndex', -1);
	var f = new Date();
    var fActual=f.getDate()+"-"+(f.getMonth() +1) + "-" +f.getFullYear() ;
	$("#fechaCreacion").val(fActual);
	$(".fi").val(fActual);

    //Recargar pagina
    $("#limpiar").click(function(){
        location.reload();
    });


	$(document).on('submit','#frmLogout',function(e){
		e.preventDefault();
		var frmlout= serializeToJson($(this).serializeArray());
		logOut(frmlout);
	});

    //obtener datos de el encabezado
    $("#guardarCot").click(function(){
        headerCot                   = serializeToJson($(".headerCot :input").serializeArray());
        programasCot                = serializeToJson($(".programasCot :input").serializeArray());
        cuniasCot                   = serializeToJson($(".cuniasCot :input").serializeArray());
        entrevistasCot              = serializeToJson($(".entrevistasCot :input").serializeArray());
        produccionesCot             = serializeToJson($(".produccionesCot :input").serializeArray());
        frmGlobal                   = new Object();
        frmGlobal.headerCot         = headerCot;
        frmGlobal.programasCot      = programasCot;
        frmGlobal.cuniasCot         = cuniasCot;
        frmGlobal.entrevistasCot    = entrevistasCot;
        frmGlobal.produccionesCot   = produccionesCot;
        console.log(produccionesCot);
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


    //Evento para calcular el total de las filas tomando precio,cantidad y duracion.
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
        if(cantidad.val()==0){
            cantidad.val("");
        }
        if(duracion.val()==0){
            duracion.val("");
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

    //Date Picker
    $(function () {
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$(".datepicker").datepicker({
		firstDay: 1,
        dateFormat: 'dd-mm-yy' 
	   });
    });

    //Dropdown del menu de catalogos
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );


    //capturar fechas de agregar cotizacion y manipularlas
    $(".fi").change(function(){
        padre=$(this).parents(".fechasFooter");
        var fi = padre.find(".fi");
        var ffin = padre.find(".ffin");
        var fechaSeleccionada = fi.val(); 
        if($.datepicker.parseDate('dd-mm-yy', fechaSeleccionada)<$.datepicker.parseDate('dd-mm-yy', fActual)){
            alertify.alert("La fecha de inicio no puede ser menor que la fecha actual", function () {
                    fi.val(fActual);        
                });
        }
        if(ffin.val()){
            if($.datepicker.parseDate('dd-mm-yy', fechaSeleccionada)>$.datepicker.parseDate('dd-mm-yy', ffin.val())){
                alertify.alert("Ha cambiado la fecha de inicio, por lo tanto la fecha de fin debe cambiar",function(){
                    ffin.val("");   
                });
            }
        }
    });

    $(".ffin").change(function(){
        padre=$(this).parents(".fechasFooter");
        var hijo = padre.find(".ffin");
        var hijoo = padre.find(".fi");
        var fechaSeleccionada = hijo.val();
        var fechaInicio = hijoo.val()
    	if(fechaInicio){
        	if($.datepicker.parseDate('dd-mm-yy', fechaSeleccionada) < $.datepicker.parseDate('dd-mm-yy', fechaInicio)){
            	alertify.alert("La fecha de fin no puede ser menor que la fecha de inicio",function(){
                    hijo.val("");
                });
        	}
    	}
    });

    //Boton cancelar de la parte de agregar cotizacion 
    $(".cancel").click(function(){
        history.back()
    });
});