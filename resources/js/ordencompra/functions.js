function guardarOrdenCompra(frm,encabezado){
	$.ajax({
		data:{
			frm: JSON.stringify(frm),
			encabezado: encabezado
		},
		url: getBaseURL() + "ordencompra/addFrecuencia",
		type: "POST",
		beforeSend: function(){
				// cargando
				$(".cont-loading").css("display","block");
			},
		success: function(data){
			// console.log("servidor",data);
			datos = jQuery.parseJSON(data);
			// console.log("datos",datos);
			$(".cont-loading").css("display","none");
			if(datos){
				alertify.success("Todo ha salido Bien !");
				setTimeout(function() {
                    location.reload();
                }, 1000);
			}else{
				alertify.error("Ha salido algo mal, intente de nuevo !");
			}
		}
	});
}


function validarFr(fr){
	tr 	= fr.parents("tr");
	fre = tr.find(".txtFrecuencia");
	sum  = 0;
	$(fre).each(function(i,val){
		if($(this).val()){
			sum += parseInt($(this).val());
		}
	});
	cantidad = tr.find(".Cantidad").val();
	if(sum>cantidad){
		alertify.alert("Se ha pasado del limite de pautas, su limite es "+cantidad+" !",function(){
			fr.val("");	
		});
	}
}


function getFrecuencias(frm){
	$.ajax({
		data:{
			frm: JSON.stringify(frm),
		},
		url: getBaseURL() + "ordencompra/getFrecuencias/",
		type: "POST",
		beforeSend: function(){
				// cargando
				$(".cont-loading").css("display","block");
			},
		success: function(data){
			// console.log("servidor",data);
			datos = jQuery.parseJSON(data);
			// console.log("datos",datos);
			$(".cont-loading").css("display","none");
			$(".txtFrecuencia").each(function(i,val){
				det = $(this).attr("detalle");
				fec = $(this).attr("name");
				if(det==datos.detalle[i] && fec==datos.fecha[i]){
					if(datos.fr[i]==0){
						$(this).val("  ");
					}else{
						$(this).val(datos.fr[i]);
					}
				}
			});
		}
	});
}




/*	$.ajax({
			data:{
				frm: JSON.stringify(frm)
			},
			url: getBaseURL() + "ordencompra/addFrecuencia",
			type: 'POST',
			beforeSend: function(){
				// cargando
				
			}
			success: function(data){
				// cargo imprimis
				$obj->nombre = "angel";
				echo JSON_encode($obj); // lado del php 

				datosObj = jQuery.parseJSON(data);
				datosObj.nombre;
			}
		});*/
