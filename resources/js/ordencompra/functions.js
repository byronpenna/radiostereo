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
				console.log("cargando");
			},
		success: function(data){
			console.log("servidor",data);
			datos = jQuery.parseJSON(data);
			console.log("datos",datos);
		}
	});
}


function getFrecuencias(frm){
	$.ajax({
		data:{
			frm: JSON.stringify(frm),
		},
		url: getBaseURL() + "ordencompra/getFrecuencias/",
		type: "POST",
		success: function(data){
			console.log("servidor",data);
			datos = jQuery.parseJSON(data);
			console.log("datos",datos);
			$(".txtFrecuencia").each(function(i,val){
				det = $(this).attr("detalle");
				fec = $(this).attr("name");
				if(det==datos.detalle[i] && fec==datos.fecha[i]){
						$(this).val(datos.fr[i]);
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
