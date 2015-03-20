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
            padre=undefined;
            $(".total").each(function(i,val){
                if($(this).val()){
                    padre = $(this).parents(".conProgra");
                }
            });

            
            if(padre==undefined){
                alertify.alert("Debe Ingresar al menos un detalle para poder guardar !");
            }else{
                pventa = padre.find(".pventa");
                ffin = padre.find(".ffin");
                if(pventa.val() && ffin.val()){
                    console.log("ambos estan llenos");
                      scrollTop();
                        setTimeout(function() {
                                addCotizacion(frmGlobal);
                            }, 1000);
                }else{
                    alertify.alert("Es Obligatorio llenar ingresar el precio de venta y el fin de pauta para poder continuar !");
                }    
            }
            

            // scrollTop();
            // setTimeout(function() {
            //         addCotizacion(frmGlobal);
            //     }, 1000);
        }else{
            alertify.error(valHeader.mensaje);
                var pathname = window.location.pathname;
                $(location).attr('href', pathname+'#cotHeader');
        }
    });