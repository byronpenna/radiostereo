//funciones para insert y update del catalogo programa
function createControlsEdit(tr){//funcion que me cargara el dato a editar
	idPrograma = tr.find(".inputProgramId").val();//busca el id del programa por medio de una clase y se encuentra en la vista
	nombrePrograma = tr.find(".tdProgramNombre").text();//busca el nombre del programa por medio de una clase y " "
	htmlTr = "\
			<td style='display:none'>\
				<input name='txtidprograma' value='"+idPrograma+"' class='inputProgramId'>\
			</td>\
			<td>\
				<input name='txtNombrePrograma' class='txtNombrePrograma form-control' value='"+nombrePrograma+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarPrograma btn btn-m btn-success btnAddCot' value='Guardar' />\
			</td>\
			";//creo nuevo html para modificar
	tr.empty().append(htmlTr);//con empty vacio el tr y le coloco el nuevo elemento creado
	//en el archivo script el el primer evento click
}
//aqui comienzan las funciones ajax q me pasaran los datos a modificar al modelo
function saveEditPrograma(update,tr){
	$.ajax({
		data:{
			form:JSON.stringify(update)
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/update_programa",
		type: 	"POST",
		success: 	function(datos) {
			idPrograma = tr.find(".inputProgramId").val();//buscamos el id para construir la fila
			data = jQuery.parseJSON(datos);//convirtiendo datos
			if (data.estado == false) {
				$(".mensaje").text(data.mensaje);
			}else if(data.estado == true){
				tr2 = "\
					<td style='display:none'>\
						<input name='txtidprograma' value='"+idPrograma+"' class='inputProgramId'>\
					</td>\
					<td class='tdProgramNombre'>"+data.dato+"</td>\
					<td>\
						<button class='btnEditar btn btn-sm btn-primary'>Editar</button>\
						<button class='btn btn-sm btn-danger'>Eliminar</button>\
					</td>";//creamos el nuevo fila
				tr.empty().append(tr2);
			}
			//console.log(data);
		}
	});
}
function agregarPrograma(frm){//funcion que manda los datos al controlador
	$.ajax({
		data:{
			form: JSON.stringify(frm)//convierte el objeto jason a string
		},
		url: getBaseURL() + "index.php/catalogosc/catalogosc/insert_programa",
		type: 		"POST",
		success: 	function(datos){
			// agregar el elemento a la tabla
			data = jQuery.parseJSON(datos);//convertimos los datos
			if (data.estado == false) {
				$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
			}else if(data.estado == true){
				tr = "<tr class='styleTR alt'>\
						<td style='display:none'>\
							<input name='txtidprograma' value='"+data.last_id+"' class='inputProgramId'>\
						</td>\
						<td class='tdProgramNombre'>"+frm.nombpro+"</td>\
						<td><button class='btnEditar btn btn-sm btn-primary'>Editar</button></td>\
					  </tr>"
				$(".vaciarinput").val("");
				$(".tbProgramas").prepend(tr);//ponemos el nuevo valor al principio	
			}
		}
	});
}
//funciones para insert y update del catalogo precio
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
				tr = "<tr class='styleTR'>\
						<td style='display:none'>\
							<input name='txtidprecio' value='"+data.last_id+"' class='inputPrecioId'>\
						</td>\
						<td class='tdPrecio'>"+frm.precio+"</td>\
						<td><button class='btnEditPrecio btn btn-sm btn-primary'>Editar</button></td>\
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
				<input name='txtPrecio' class='txtPrecio soloNumeros form-control' value='"+precio+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarPrecio btn btn-m btn-success btnAddCot' value='Guardar' />\
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
						<button class='btnEditPrecio btn btn-sm btn-primary'>Editar</button>\
						<button class='btn btn-sm btn-danger'>Eliminar</button>\
					</td>";//creamos el nuevo fila
			tr.empty().append(newtr);
			//console.log(datos);
		}
	});
}
//funciones para insert y update del catalogo radio
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
				tr = "<tr class='styleTR'>\
						<td style='display:none'>\
							<input name='txtidRadio' value='"+data.last_id+"' class='inputRadioId'>\
						</td>\
						<td class='tdRadioNomb'>"+frm.txtnombradio+"</td>\
						<td><button class='btnEdtRadio btn btn-sm btn-primary'>Editar</button></td>\
					  </tr>"
				$(".vaciarinput").val("");
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
				<input name='txtRadio' class='txtRadio form-control' value='"+radio+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarRadio btn btn-m btn-success btnAddCot' value='Guardar' />\
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
						<button class='btnEdtRadio btn btn-sm btn-primary'>Editar</button>\
						<button class='btn btn-sm btn-danger'>Eliminar</button>\
					</td>";//creamos el nuevo fila
			tr.empty().append(newtr);
			//console.log(datos);
		}
	});
}
//funciones para insert y update del catalogo servicio
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
				tr = "<tr class='styleTR'>\
						<td style='display:none'>\
							<input name='txtidServicio' value='"+data.last_id+"' class='inputServId'>\
						</td>\
						<td class='tdServicio'>"+form.servicio+"</td>\
						<td><button class='btnEdtserv btn btn-sm btn-primary'>Editar</button></td>\
					  </tr>"
				$(".vaciarinput").val("");
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
					<input name='txtServicio' class='tdServicio form-control' value='"+nombservicio+"'>\
				</td>\
				<td>\
					<input type='button' class='btnGuardarServi btn btn-m btn-success btnAddCot' value='Guardar' />\
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
						<button class='btnEdtserv btn btn-sm btn-primary'>Editar</button>\
						<button class='btn btn-sm btn-danger'>Eliminar</button>\
					</td>";//creamos el nuevo fila
			tr.empty().append(newtr);
			//console.log(datos);
		}
	});
}
//funciones para insert y update del catalogo clientes
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
				tr = "<tr class='styleTR'>\
						<td style='display:none'>\
							<input name='txtidCliente' value='"+data.last_id+"' class='inputClienteId'>\
						</td>\
						<td class='tdNombCliente'>"+frm.txtnombcliente+"</td>\
						<td class='tdApellidoCliente'>"+frm.txtapellido+"</td>\
						<td><button class='EditCliente btn btn-sm btn-primary'>Editar</button></td>\
					  </tr>"
				$(".tbClientes").prepend(tr);//ponemos el nuevo valor al principio
				//console.log(frm);
				$(".vaciarinput").val("");
				// para input .val("") val()
				// para divs .empty() text()
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
				<input name='txtidcliente' value='"+idcliente+"' class='inputClienteId'>\
			</td>\
			<td>\
				<input name='txtNombre' class='txtNombre form-control' value='"+nombre+"'>\
			</td>\
			<td>\
				<input name='txtApellido' class='txtNombre form-control' value='"+apellido+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarCliente btn btn-m btn-success btnAddCot' value='Guardar' />\
			</td>";
			//console.log(idcliente,nombre,apellido);
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
			idradio = tr.find(".inputClienteId").val();
			data = jQuery.parseJSON(datos);//convirtiendo datos
			newtr = "\
					<td style='display:none'>\
						<input name='txtidRadio' value='"+idradio+"' class='inputClienteId'>\
					</td>\
					<td class='tdNombCliente'>"+data.dato1+"</td>\
					<td class='tdApellidoCliente'>"+data.dato2+"</td>\
					<td>\
						<button class='EditCliente btn btn-sm btn-primary'>Editar</button>\
						<button class='btn btn-sm btn-danger'>Eliminar</button>\
					</td>";//creamos el nuevo fila
			tr.empty().append(newtr);
			//console.log(datos);
		}
	});
}