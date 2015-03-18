//Esta funcion sirve para obtener la base de la url para poder redirigir de una manera mas eficiente
function getBaseURL() {
	var url = location.href;  // entire url including querystring - also: window.location.href;
	var baseURL = url.substring(0, url.indexOf('/', 14));
	if (baseURL.indexOf('http://www.gruporadiostereo.com.sv/') != -1) {
	    // Base Url for localhost
	    var url = location.href;  // window.location.href;
	    var pathname = location.pathname;  // window.location.pathname;
	    var index1 = url.indexOf(pathname);
	    var index2 = url.indexOf("/", index1 + 1);
	    var baseLocalUrl = url.substr(0, index2);

	    return baseLocalUrl + "/ventas/";
	}
	else {
	    // Root Url for domain name
	    return baseURL + "/ventas/";
	}
}

function scrollTop(){
     $('html, body').animate({ scrollTop: '0px'});
     return false;
}



//calcular los totales para los campos de las cotizaciones 
  function calcularTotal(tr,tabla){
    cantidad    = tr.find(".txtCantidad");
    duracion    = tr.find(".txtDuracion");
    select      = tr.find(".precios option:selected").html();
    subTotal    = tr.find(".subTotal");
    total       = tabla.find(".total");
    descuento   = tabla.find(".descuento");
    pventa      = tabla.find(".pventa");
    diarias     = tr.find(".txtDiaria");
    // diarias     = tabla.find(".txtDiarias");
    try{
        var valsin = select.replace("$","");
    }catch(err){
        valsin="";
    }
    if(cantidad.val()==0){
        cantidad.val("");
    }
    if(duracion.val()==0){
        duracion.val("");
    }
    if(diarias.length > 0){
      if(diarias.val()==0){
        diarias.val("");
      }
    }
    
    valCantidad = cantidad.val();
    valDuracion = duracion.val();
    console.log("las diarias son",diarias.length);
    if(diarias.length > 0){
      valDiarias  = diarias.val();
    }
    
    res=0;
    if(diarias.length > 0){
      res=valsin*valCantidad*valDuracion;
    }else{
      res=valsin*valCantidad*valDuracion;
    }
    if(res!=0){
        subTotal.val(res.toFixed(2));
    }
    //Calcular el Total
    sum     = 0;
    tabla.find(".subTotal").each(function(i,val){
        valor   = $(this).val();
        if(isNumber(valor)){
            sum += parseFloat(valor);
        }
    });
    if(sum){
          if(diarias.length>0){
            if(!diarias.val()){
              if(subTotal.val()){
                sum=sum-subTotal.val();
                subTotal.val("");
              }
            }
          }
          if(!valsin || !cantidad.val() || !duracion.val()){
            if(subTotal.val()){
              sum=sum-subTotal.val();
              subTotal.val("");
            }
          } 
        if(sum==0.00){
            total.val("");
        }else{
          total.val("$ "+sum.toFixed(2));
        }
        if(sum>=pventa.val()){
          if(pventa.val()){
          des=sum-pventa.val();
          descuento.val(des.toFixed(2));
        }else{
          descuento.val("");
        }
        }else{
          alertify.error("El precio de venta no puede ser mayor que el precio sin descuento");
                    pventa.val("");
                    descuento.val(""); 
        }
    }
}



// Validar los keypress 
	function probarExp(exp,texto){
		return exp.test(texto);
	}

	function getCharFromEvent(e){
		asccii 		= e.which;
		character 	=  String.fromCharCode(asccii);
		return character;
	}

	function testExpression(e,expresion){
		character = getCharFromEvent(e);
		return probarExp(expresion,character);
	}

//Funcion Para Matar la sesion 
function logOut(frm){
	console.log("la url es: ",getBaseURL());
	$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/welcome/logOut",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           window.location=getBaseURL()+"index.php/welcome";
         }
     });
}


	//Validar si es un numero
	function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}



	// validaciones Cotizaciones
    function validarCotizacion(header){
      retorno = new Object();
      retorno.estado = true;
      retorno.mensaje = "";
      header.each(function(){
              if(!$(this).val() && $(this).attr("name")!="txtValorAgregado"){
                  // alert("no puede dejar campos vacios");
                  $(this).css({'background-color' : 'rgba(246,71,71,0.2)'});
                  retorno.estado = false; 
                  retorno.mensaje = "No se pueden dejar campos vacios !"; 
              }
          });
          return retorno;
    }

    function validarDetalle(obj){
      
    }
	
function serializeToJson(a){
	var o = {};
	$.each(a, function() {
	   if (o[this.name]) {
	       if (!o[this.name].push) {
	           o[this.name] = [o[this.name]];
	       }
	       o[this.name].push(this.value || '');
	   } else {
	       o[this.name] = this.value || '';
	   }
	});
	return o;
}
