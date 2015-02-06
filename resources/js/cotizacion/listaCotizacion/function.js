function eliminarCot(id){
		$.ajax({
         data:{
           id: id
         },
         url:  getBaseURL()+"cotizacionesc/cotizacionesc/eliminarCotizacion",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           if(datos){
           		location.reload();
           }
          }
     });
	}