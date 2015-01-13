function obtenerDatosAprobados(frm){
		$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/cotizacionesc/cotizacionesc/recibeAprobados",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           if(datos.res==true){
            if(datos.contador<=1){
              alertify.success("Se ha Aprobado <b>"+datos.contador+"</b> cotizacion seleccionada");
              setTimeout(function() {
                location.reload();
              }, 2000);
            }else{
              alertify.success("Se han Aprobado <b>"+datos.contador+"</b> cotizaciones seleccionadas");
              setTimeout(function() {
                location.reload();
              }, 2000);
            }
           }else{
           alertify.error("Ha salido algo mal,por favor intente de nuevo");
           setTimeout(function() {
                location.reload();
           }, 2000);
           }
          }
     });
	}