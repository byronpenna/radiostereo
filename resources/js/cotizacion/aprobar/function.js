function obtenerDatosAprobados(frm){
		$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/cotizacionesc/cotizacionesc/recibeAprobados",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           if(datos==true){
              alertify.alert("Se han Aprobado las cotizaciones seleccionadas", function () {
                    location.reload();
                });
           }else{
           alertify.alert("Ha salido algo mal,por favor intente de nuevo", function () {
                    location.reload();
                }); 
           }
          }
     });
	}