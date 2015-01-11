//Evento para calcular el total de las filas tomando precio,cantidad y duracion.Cotizacion
    $(document).on("blur",".blur",function(){
        tr          = $(this).parents("tr"); 
        tabla       = $(this).parents(".Tcalculo");
        calcularTotal(tr,tabla);  
    });
    $(document).ready(function(){
        $(".Tcalculo").each(function(i,val){
             trs    = $(this).find("tr");
             tabla  = $(this);
             $.each(trs,function(ii,value){
                calcularTotal($(this), tabla);
             });  
        });

        $(".vacEditCot :input").each(function(i,val){
            if($(this).val()==0 || $(this).val()==""){
                $(this).val(" ");
            }
        });
    });

    //obtener datos de cotizacion para editar
    $(document).on("click","#editCot",function(){
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
            editCotizacion(frmGlobal);
        }else{
            alertify.alert(valHeader.mensaje, function () { 
                var pathname = window.location.pathname;
                //alert(pathname);
                //alert(window.location);
                $(location).attr('href', pathname+'#cotHeader');
                });
        }
    });