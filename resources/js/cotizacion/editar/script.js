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

        // con esta funcion verificamos el estado de la cotizacion para poder mandar la alerta indicando que no 
        // se puede modificar
        frmGlobal   = new Object();
        headerCot = serializeToJson($(".headerCot :input").serializeArray());
        frmGlobal.headerCot = headerCot;
        scrollTop();
            // console.log(frmGlobal);
            setTimeout(function() {
                    getEstadoCot(frmGlobal);
                }, 1000);
        
    });


    $(document).on("click",".fc-event",function(){
        td      = $(this).parents("td");
        console.log("has dado click en el evento",td.index());
        tabla   = $(this).parents(".fc-content-skeleton");
        console.log(tabla.attr("class")) ;
        valor = tabla.find(".fc-day-number").eq(td);
        console.log("valor",valor);
        


        
        /*
        $(".calendar").fullCalendar('removeEvents',"2015-02-10");
        $(".txtEvents").each(function(i,val){
            // console.log("valor de eventos",stt);
            
        });*/
        
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
            // console.log("txt events",secCot.txtEvents);
            
            // seccc = secCot[3].txtEvents;
            // console.log("eventos ",seccc.length);
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
            console.log(frmGlobal);
            setTimeout(function() {
                    editCotizacion(frmGlobal);
                }, 1000);
                }else{
                    alertify.alert("Es Obligatorio llenar ingresar el precio de venta y el fin de pauta para poder continuar !");
                }    
            }
            // scrollTop();
            // console.log(frmGlobal);
            // setTimeout(function() {
            //         editCotizacion(frmGlobal);
            //     }, 1000);
        }else{
            alertify.alert(valHeader.mensaje, function () { 
                var pathname = window.location.pathname;
                //alert(pathname);
                //alert(window.location);
                $(location).attr('href', pathname+'#cotHeader');
                });
        }
    });