function agregarservicio(form) {//funcion que manda los datos del servicio al controlador
	$.ajax({
		data:{
			form: JSON.stringify(form)
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/insert_servicio",
		type: 	"POST",
		success:    function(datos) {
			// agregar el elemento a la tabla
			data = jQuery.parseJSON(datos);//convertimos los datos
			if (data.estado == false) {
				$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
			}else if(data.estado == true){
				tr = "<tr>\
						<td style='display:none'>\
							<input name='txtidServicio' value='"+data.last_id+"' class='inputServId'>\
						</td>\
						<td class='tdServicio'>"+form.servicio+"</td>\
						<td><button class='btnEdtserv'>Editar</button></td>\
					  </tr>"
				$(".tbservicio").prepend(tr);//ponemos el nuevo valor al principio
				
			}
		}
	});
}
	//funciones para editar servicios
	function createEditServicio(tr){
		idservicio = tr.find(".inputServId").val();
		nombservicio = tr.find(".tdServicio").text();
		newtr = "\
				<td style='display:none'>\
					<input name='txtidservicio' value='"+idservicio+"' class='inputServId'>\
				</td>\
				<td>\
					<input name='txtServicio' class='tdServicio' value='"+nombservicio+"'>\
				</td>\
				<td>\
					<input type='button' class='btnGuardarServi' value='Guardar' />\
				</td>";
		tr.empty().append(newtr);
	}
function savenewServicio (frm,tr) {
	$.ajax({
		data:{
			form: JSON.stringify(frm)
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/update_servicio",
		type: "POST",
		success: function(datos) {
			idServi = tr.find(".inputServId").val();
			data = jQuery.parseJSON(datos);//convirtiendo datos
			newtr = "\
					<td style='display:none'>\
						<input name='txtidservicio' value='"+idServi+"' class='inputServId'>\
					</td>\
					<td class='tdServicio'>"+data.dato+"</td>\
					<td>\
						<button class='btnEdtserv'>Editar</button>\
					</td>";//creamos el nuevo fila
			tr.empty().append(newtr);
			//console.log(datos);
		}
	});
}
