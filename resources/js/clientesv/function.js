function agregarcliente(frm) {
	$.ajax({
		data:{
			form: JSON.stringify(frm)
		},
		url:  getBaseURL() + "index.php/catalogosc/catalogosc/insert_cliente",
		type: 	"POST",
		success: function(datos) {
			data = jQuery.parseJSON(datos);
			if (data.estado == false) {
				$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
			}else if(data.estado == true){
				tr = "<tr>\
						<td style='display:none'>\
							<input name='txtidCliente' value='"+data.last_id+"' class='inputClienteId'>\
						</td>\
						<td class='tdNombCliente'>"+frm.txtnombcliente+"</td>\
						<td class='tdApellidoCliente'>"+frm.txtapellido+"</td>\
						<td><button class='EditCliente'>Editar</button></td>\
					  </tr>"
				$(".tbClientes").prepend(tr);//ponemos el nuevo valor al principio
			}
		}
	});
}
function createEditCliente (tr) {
	idcliente = tr.find(".inputClienteId").val();
	nombre = tr.find(".tdNombCliente").text();
	apellido = tr.find(".tdApellidoCliente").text();
	newtr = "\
			<td style='display:none'>\
				<input name='txtidcliente' value='"+idcliente+"' class='inputPrecioId'>\
			</td>\
			<td>\
				<input name='txtNombre' class='txtNombre soloNumeros' value='"+nombre+"'>\
			</td>\
			<td>\
				<input name='txtApellido' class='txtNombre soloNumeros' value='"+apellido+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarCliente' value='Guardar' />\
			</td>";
			//console.log(newtr);
			tr.empty().append(newtr);
}
function saveEditCliente (form,tr) {
	$.ajax({
		data:{
			form: JSON.stringify(form)
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/update_cliente",
		type: "POST",
		success: function(datos) {
			idradio = tr.find(".inputPrecioId").val();
			data = jQuery.parseJSON(datos);//convirtiendo datos
			newtr = "\
					<td style='display:none'>\
						<input name='txtidRadio' value='"+idradio+"' class='inputPrecioId'>\
					</td>\
					<td class='tdNombCliente'>"+data.dato+"</td>\
					<td class='tdApellidoCliente'>"+data.dato+"</td>\
					<td>\
						<button class='EditCliente'>Editar</button>\
					</td>";//creamos el nuevo fila
			//tr.empty().append(newtr);
			console.log(datos);
		}
	});
}