$(document).ready(function(){
	$('#hide').fadeIn("slow");
	}
);

function login(frm){
	$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  "welcome/obtenerDatosLogin",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
          if(datos.validacion==true){
          	$('#hide').fadeOut( "fast",function(){
          		window.location="main";	
          	});
          }else{
          	$("#msj").empty().append(datos.mensaje);
          	$('#msj').show( "fast");
          	setTimeout(function() {
      			$('#msj').hide( "fast");
			}, 2000);
          }
         }
     });
}

function logOut(frm){
	$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  "welcome/logOut",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           window.location="welcome";
         }
     });
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