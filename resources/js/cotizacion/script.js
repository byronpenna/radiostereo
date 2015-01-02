//Evento para calcular el total de las filas tomando precio,cantidad y duracion.Cotizacion
    $(document).on("blur",".blur",function(){
        tr          = $(this).parents("tr");
        tabla       = $(this).parents("table");
        cantidad    = tr.find(".txtCantidad");
        duracion    = tr.find(".txtDuracion");
        select      = tr.find(".precios option:selected").html();
        subTotal    = tr.find(".subTotal");
        total       = tabla.find(".total");
        try{
            var valsin = select.replace("$","");
        }catch(err){
            console.log(err.message);
            valsin="";
        }
        if(cantidad.val()==0){
            cantidad.val("");
        }
        if(duracion.val()==0){
            duracion.val("");
        }
        valCantidad = cantidad.val();
        valDuracion = duracion.val();
        res=0;
        res=valsin*valCantidad*valDuracion;
        if(res!=0){
            subTotal.val(res.toFixed(2));
        }
        //Calcular el Total
        sum     = 0;
        tabla.find(".subTotal").each(function(i,val){
            valor   = $(this).val();
            if(isNumber(valor)){
                sum += parseFloat(valor);
            }
        })
        if(sum.toFixed(2)!=0.00){
            total.val(sum.toFixed(2));
        }
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
            alertify.alert(valHeader.mensaje, function () { 
                });
        }
    });