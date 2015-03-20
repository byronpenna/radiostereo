//Funcion para datos datos de la tabla cotizaciones
	function editCotizacion(frm){
		$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/cotizacionesc/cotizacionesc/recibeDatosEdit",
         type:   "POST",
         beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
         success: function(data){
          console.log(data);
           var datos = jQuery.parseJSON(data);
           console.log(datos);
           $(".cont-loading").css("display","none");
           if(datos.header && datos.encBloq && datos.detBloq && datos.fecha){
              if(datos.cliInfo == 1){
                alertify.alert("Debe Ingresar Todos los Datos del Cliente para poder generar la Orden de Compra !");
                window.location=getBaseURL()+"cotizacionesc/cotizacionesc";
              }else if(datos.cliInfo == 2 || datos.cliInfo==0){
                alertify.success("Datos Editados Correctamente");
               setTimeout(function() {
                    window.location=getBaseURL()+"cotizacionesc/cotizacionesc";
                }, 1000);  
              }
           }else{
           alertify.error("Ha salido algo mal,por favor intente de nuevo");
                    setTimeout(function() {
                      location.reload(); 
                }, 1000);
           }
          }
     });
	}


// funcion para obtener el estado de la cotizacion en el inicio
  function getEstadoCot(frm){
    $.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/cotizacionesc/cotizacionesc/getEstadoCot",
         type:   "POST",
         beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
         success: function(data){
            var datos = jQuery.parseJSON(data);
            $(".cont-loading").css("display","none");
            if(datos.est_id==3 || datos.est_id==4){
              alertify.alert("Esta cotización esta <b>"+datos.est_estado+"</b> por lo tanto no se puede editar");
            }
          }
     });
  }

