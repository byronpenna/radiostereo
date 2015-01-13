//Evento para calcular el total de las filas tomando precio,cantidad y duracion.Cotizacion
    $(document).on("blur",".blur",function(){
        tr          = $(this).parents("tr"); 
        tabla       = $(this).parents(".Tcalculo");
        calcularTotal(tr,tabla);  
    });

    
//obtener datos de cotizacion
    $(document).on("click","#guardarCot",function(){
        frmGlobal   = new Object();
        headerCot = serializeToJson($(".headerCot :input").serializeArray());
        valHeader = validarCotizacion($(".headerCot :input"));
        if(valHeader.estado){
            var secCot  = [];
            $(".conProgra").each(function(i,val){
                secCot[i]   =   serializeToJson($(this).find("input,select").serializeArray());
            });
            frmGlobal.secCot    = secCot;
            frmGlobal.headerCot = headerCot;
            addCotizacion(frmGlobal);
        }else{
            alertify.error(valHeader.mensaje);
                var pathname = window.location.pathname;
                $(location).attr('href', pathname+'#cotHeader');
        }
    });