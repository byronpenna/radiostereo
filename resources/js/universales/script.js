$(document).ready(function(){

	$(".selectBlanco").prop('selectedIndex', -1);
	var f = new Date();
    var fActual=f.getFullYear()+"-"+(f.getMonth() +1) + "-" +f.getDate();
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


    //Date Picker
    $(function () {
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$(".datepicker").datepicker({
		firstDay: 1,
        dateFormat: 'yy-mm-dd' 
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
        if($.datepicker.parseDate('yy-mm-dd', fechaSeleccionada)<$.datepicker.parseDate('yy-mm-dd', fActual)){
            alertify.alert("La fecha de inicio no puede ser menor que la fecha actual", function () {
                    fi.val(fActual);        
                });
        }
        if(ffin.val()){
            if($.datepicker.parseDate('yy-mm-dd', fechaSeleccionada)>$.datepicker.parseDate('yy-mm-dd', ffin.val())){
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
            if($.datepicker.parseDate('yy-mm-dd', fechaSeleccionada) < $.datepicker.parseDate('yy-mm-dd', fechaInicio)){
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

    //validar numero telefonico
        $(document).on("keypress",".NumTelefono",function(e){
            //console.log($(this).val().length);
            if($(this).val().length >= 8){
                e.preventDefault();
            }
        });
         $(document).on("blur",".NumTelefono",function(e){
            //console.log($(this).val().length);
            if($(this).val().length < 8){
                alertify.alert("Advertencia: El campo Telefono debe contener 8 dígitos exactos");
            }
        });
    //validar numero nit
        $(document).on("keypress",".NumNit",function(e){
            //console.log($(this).val().length);
            if($(this).val().length >= 14){
                e.preventDefault();
            }
        });
        $(document).on("blur",".NumNit",function(e){
            //console.log($(this).val().length);
            if($(this).val().length < 14){
                alertify.alert("Advertencia: El campo NIT debe contener 14 dígitos exactos");
            }
        });
    //validar numero nrc
        $(document).on("keypress",".NumNrc",function(e){
            //console.log($(this).val().length);
            if($(this).val().length >= 7){
                e.preventDefault();
            }
        });  
        $(document).on("blur",".NumNrc",function(e){
            //console.log($(this).val().length);
            if($(this).val().length < 7){
                alertify.alert("Advertencia: El campo NRC debe contener 7 dígitos exactos");
            }
        });
});