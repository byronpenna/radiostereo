//Funcion para agregar datos a la tabla cotizaciones
	function addCotizacion(frm){
		$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/cotizacion/cotizacion/recibeDatosAdd",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           if(datos.header && datos.encBloq && datos.detBloq){
              alertify.alert("Datos Ingresados Correctamente", function () {
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