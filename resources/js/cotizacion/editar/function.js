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
              alertify.alert("Datos Editados Correctamente", function () {
                    window.location=getBaseURL()+"cotizacionesc/cotizacionesc";
                });
           }else{
           alertify.alert("Ha salido algo mal,por favor intente de nuevo", function () {
                    location.reload();
                }); 
           }
          }
     });
	}