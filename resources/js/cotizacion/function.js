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
           alertify.alert("Datos Ingresados Correctamente", function () {
                    location.reload();
                });
          }
     });
	}



  // validaciones 
    function validarCotizacion(header){
      retorno = new Object();
      retorno.estado = true;
      retorno.mensaje = "";
      header.each(function(){
              if(!$(this).val() && $(this).attr("name")!="txtValorAgregado"){
                  // alert("no puede dejar campos vacios");
                  // $(this).css({'background-color' : 'orange'});
                  retorno.estado = false; 
                  retorno.mensaje = "No se pueden dejar campos vacios !"; 
              }
          });
          return retorno;
    }