function agregarPrecio(frm) {//funcion que manda los datos de precio al controlador
	$.ajax({
		data:{
			form: JSON.stringify(form)//convierte el objeto jason a string
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/insert_precio",
		type: 		"POST",
		success: 	function(datos){
			data = jQuery.parseJSON(datos);
			if (data.estado == false) {
				$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
			}else if(data.estado == true){
				tr = "<tr>\
						<td style='display:none'>\
							<input name='txtidprecio' value='"+data.last_id+"' class='inputPrecioId'>\
						</td>\
						<td class='tdPrecio'>"+frm.precio+"</td>\
						<td><button class='btnEditPrecio'>Editar</button></td>\
					  </tr>"
				$(".vaciarinput").val("");
				$(".tbprecios").prepend(tr);//ponemos el nuevo valor al principio
			}
		}
	});
}
//funciones para modificar precio
function createEditPrecio (tr) {//funcion para cargar el form de editar
	idprecio = tr.find(".inputPrecioId").val();
	precio = tr.find(".tdPrecio").text();
	newtr = "\
			<td style='display:none'>\
				<input name='txtidprecio' value='"+idprecio+"' class='inputPrecioId'>\
			</td>\
			<td>\
				<input name='txtPrecio' class='txtPrecio soloNumeros' value='"+precio+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarPrecio' value='Guardar' />\
			</td>";
			//console.log(newtr);
			tr.empty().append(newtr);
}
function savenewPrecio(form,tr) {
	$.ajax({
		data:{
			form: JSON.stringify(form)
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/update_precio",
		type: "POST",
		success: function(datos) {
			idprecio = tr.find(".inputPrecioId").val();
			data = jQuery.parseJSON(datos);//convirtiendo datos
			newtr = "\
					<td style='display:none'>\
						<input name='txtidprecio' value='"+idprecio+"' class='inputPrecioId'>\
					</td>\
					<td class='tdPrecio'>"+data.dato+"</td>\
					<td>\
						<button class='btnEditPrecio'>Editar</button>\
					</td>";//creamos el nuevo fila
			tr.empty().append(newtr);
			//console.log(datos);
		}
	});
}