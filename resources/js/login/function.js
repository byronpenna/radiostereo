$(document).ready(function(){
	$('#hide').fadeIn("slow");
	}
);
function login(frm){
	$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/welcome/obtenerDatosLogin",
         type:   "POST",

         success: function(data){
           var datos = jQuery.parseJSON(data);
           
            if(datos.validacion==true){
          	 $('#hide').fadeOut( "fast",function(){
          		window.location="main/main";	
          	 });
            }else{
          	 $("#msj").empty().append(datos.mensaje);
          	 $('#msj').show( "fast");
          	 setTimeout(function() {
      			 $('#msj').hide( "fast");
			     }, 4000);
            }
          }
     });
}