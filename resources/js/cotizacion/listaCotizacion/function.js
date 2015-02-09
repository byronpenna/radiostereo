function eliminarCot(id){
		$.ajax({
         data:{
           id: id
         },
         url:  getBaseURL()+"cotizacionesc/cotizacionesc/eliminarCotizacion",
         type:   "POST",
         beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
         success: function(data){
           var datos = jQuery.parseJSON(data);
           $(".cont-loading").css("display","none");
           if(datos){
           		location.reload();
           }
          }
     });
	}