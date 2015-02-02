function guardarOrdenCompra(frm,encabezado){
	$.ajax({
		data:{
			frm: JSON.stringify(frm),
			encabezado: encabezado
		},
		url: getBaseURL() + "ordencompra/addFrecuencia",
		type: "POST",
		success: function(data){
			console.log("servidor",data);
			datos = jQuery.parseJSON(data);
			console.log("datos",datos);
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
