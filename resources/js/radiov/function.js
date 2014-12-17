function agregarradio(frm) {//funcion que manda los datos de radio al controlador
	$.ajax({
		data:{
			form: JSON.stringify(frm)
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/insert_radio",
		type: 	"POST",
		success: function(datos) {
			data = jQuery.parseJSON(datos);
			if (data.estado == false) {
				$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
			}else if(data.estado == true){
				tr = "<tr>\
						<td style='display:none'>\
							<input name='txtidRadio' value='"+data.last_id+"' class='inputRadioId'>\
						</td>\
						<td class='tdRadioNomb'>"+frm.txtnombradio+"</td>\
						<td><button class='btnEdtRadio'>Editar</button></td>\
					  </tr>"
				$(".tbradio").prepend(tr);//ponemos el nuevo valor al principio
			}
		}
	});
}