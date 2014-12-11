function login(frm){
	//console.log("entro");
	$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  "welcome/obtenerDatosLogin",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           //alert(datos.mensaje);
           
          if(datos.validacion==true){
          	window.location="main";
          	//console.log(datos.mensaje);
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