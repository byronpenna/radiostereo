//Funcion para datos datos de la tabla cotizaciones
	function editCotizacion(frm){
		$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/cotizacionesc/cotizacionesc/recibeDatosEdit",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           if(datos.header && datos.encBloq && datos.detBloq){
              alertify.success("Datos Editados Correctamente");
               setTimeout(function() {
                    window.location=getBaseURL()+"cotizacionesc/cotizacionesc";
                }, 1000);
           }else{
           alertify.error("Ha salido algo mal,por favor intente de nuevo");
                    setTimeout(function() {
                      location.reload(); 
                }, 1000);
           }
          }
     });
	}