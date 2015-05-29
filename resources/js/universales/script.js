$(document).ready(function(){

	$(".selectBlanco").prop('selectedIndex', -1);
	var f = new Date();
    var fActual=f.getFullYear()+"-"+(f.getMonth() +1) + "-" +f.getDate();
	$(".fechaCreacion").val(fActual);
    

    //Recargar pagina
    $(document).on("click","#limpiar",function(){
        location.reload();
    });
    
    $(document).on("click",".limpiar",function(){
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
        console.log("estoy adentro");
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
        // if($.datepicker.parseDate('yy-mm-dd', fechaSeleccionada)<$.datepicker.parseDate('yy-mm-dd', fActual)){
        //     alertify.error("La fecha de inicio no puede ser menor que la fecha actual");
        //             fi.val(fActual);
        // }
        if(ffin.val()){
            if($.datepicker.parseDate('yy-mm-dd', fechaSeleccionada)>$.datepicker.parseDate('yy-mm-dd', ffin.val())){
                alertify.error("Ha cambiado la fecha de inicio, por lo tanto la fecha de fin debe cambiar");
                    ffin.val("");   
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
                alertify.error("La fecha de fin no puede ser menor que la fecha de inicio");
                    hijo.val("");
            }
        }
    });

    //Boton cancelar de la parte de agregar cotizacion 
    $(".cancel").click(function(){
        history.back()
    });

    //validar numero telefonico
        $(document).on("keypress",".NumTelefono",function(e){
            var telVal = $(this).val()

            if($(this).val().length == 4) {
                $(this).val(telVal + "-");
            } 
            //console.log($(this).val().length);
            if($(this).val().length >= 9){
                e.preventDefault();
            }
        });
         $(document).on("blur",".NumTelefono",function(e){
            //console.log($(this).val().length);
            if($(this).val().length < 9){
                alertify.error("Advertencia: El campo Telefono debe contener 8 dígitos exactos");
            }
        });


    //validar numero nit
        $(document).on("keypress",".NumNit",function(e){
            var nitVal = $(this).val();
                                    
            if ($(this).val().length == 4) {
                $(this).val(nitVal + "-");
            };
            if ($(this).val().length == 11) {
                
                $(this).val(nitVal + "-");
            };
            if ($(this).val().length == 15) {
                $(this).val(nitVal + "-");
            };



            if($(this).val().length >= 17){
                e.preventDefault();
            }
        });
        $(document).on("blur",".NumNit",function(e){
            if($(this).val().length < 17){
                alertify.error("Advertencia: El campo NIT debe contener sus dígitos exactos");
            }
        });

});