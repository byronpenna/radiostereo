//Funcion para agregar datos a la tabla cotizaciones
	function addCotizacion(frm){
		$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/cotizacion/cotizacion/recibeDatosAdd",
         type:   "POST",
         beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
         success: function(data){
           var datos = jQuery.parseJSON(data);
           $(".cont-loading").css("display","none");
           if(datos.header && datos.encBloq && datos.detBloq){
              alertify.success("Datos Ingresados Correctamente");
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