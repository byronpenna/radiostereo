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
function createEditRadio (tr) {
	idradio = tr.find(".inputRadioId").val();
	radio = tr.find(".tdRadioNomb").text();
	newtr = "\
			<td style='display:none'>\
				<input name='txtidRadio' value='"+idradio+"' class='inputRadioId'>\
			</td>\
			<td>\
				<input name='txtRadio' class='txtRadio' value='"+radio+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarRadio' value='Guardar' />\
			</td>";
			//console.log(newtr);
			tr.empty().append(newtr);
}
function savenewRadio (form,tr) {
	$.ajax({
		data:{
			form: JSON.stringify(form)
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/update_radio",
		type: "POST",
		success: function(datos) {
			idradio = tr.find(".inputRadioId").val();
			data = jQuery.parseJSON(datos);//convirtiendo datos
			newtr = "\
					<td style='display:none'>\
						<input name='txtidRadio' value='"+idradio+"' class='inputRadioId'>\
					</td>\
					<td class='tdRadioNomb'>"+data.dato+"</td>\
					<td>\
						<button class='btnEdtRadio'>Editar</button>\
					</td>";//creamos el nuevo fila
			tr.empty().append(newtr);
			//console.log(datos);
		}
	});
}