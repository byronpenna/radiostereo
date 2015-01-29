function guardarOrdenCompra(frm){
	$.ajax({
		data:{
			frm: JSON.stringify(frm)
		},
		url: getBaseURL()+"ordencompra/addFrecuencia",
		type: "POST",
		success: function(data){
			console.log("servidor",data);
			datos = jQuery.parseJSON(data);
			console.log("datos",datos);
		}
	});
}