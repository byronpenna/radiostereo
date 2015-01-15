//funciones para el catalogo programa
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
					<center>\
						<input type='button' class='btnGuardarPrograma btn btn-sm btn-success btnAddCot' value='Guardar' />\
						<button class='DeleteProgra btn btn-sm btn-danger'>Eliminar</button>\
					</center>\
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
							<center><button class='btnEditar btn btn-sm btn-primary'>Editar</button></center>\
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
							<td>\
								<center>\
									<button class='btnEditar btn btn-sm btn-primary'>Editar</button>\
								</center>\
							</td>\
						  </tr>"
					$(".vaciarinput").val("");
					$(".tbProgramas").prepend(tr);//ponemos el nuevo valor al principio	
				}
			}
		});
	}
	function DeletePrograma (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/catalogosc/catalogosc/delete_programa",
				type: "POST",
				success: function(datos) {
					//console.log(datos);
					data = jQuery.parseJSON(datos);//convirtiendo datos
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
						//console.log(data);
						// para input .val("") val()
						// para divs .empty() text()
					}
				}
			});	
	}

//funciones para el catalogo radios
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
							<td>\
								<center>\
									<button class='btnEdtRadio btn btn-sm btn-primary'>Editar</button>\
								</center>\
							</td>\
						  </tr>"
					$(".vaciarinput").val("");
					//console.log(tr)
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
					<center>\
						<input type='button' class='btnGuardarRadio btn btn-sm btn-success btnAddCot' value='Guardar' />\
						<button class='DeleteRadio btn btn-sm btn-danger'>Eliminar</button>\
					</center>\
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
							<center>\
								<button class='btnEdtRadio btn btn-sm btn-primary'>Editar</button>\
							</center>\
						</td>";//creamos el nuevo fila
				tr.empty().append(newtr);
				//console.log(datos);
			}
		});
	}
	function DeleteRadio (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/radiosc/radiosc/delete_radio",
				type: "POST",
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
					}
				}
			});	
	}
//funciones para el catalogo precios
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
							<td>\
								<center>\
									<button class='btnEditPrecio btn btn-sm btn-primary'>Editar</button>\
								</center>\
							</td>\
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
					<input name='txtPrecio' class='txtPrecio NumPunto form-control' value='"+precio+"'>\
				</td>\
				<td>\
					<center>\
						<input type='button' class='btnGuardarPrecio btn btn-sm btn-success btnAddCot' value='Guardar' />\
						<button class='DeletePrecio btn btn-sm btn-danger'>Eliminar</button>\
					</center>\
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
							<center>\
								<button class='btnEditPrecio btn btn-sm btn-primary'>Editar</button>\
							</center>\
						</td>";//creamos el nuevo fila
				tr.empty().append(newtr);
				//console.log(datos);
			}
		});
	}
	function DeletePrecio (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/preciosc/preciosc/delete_precio",
				type: "POST",
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
					}
				}
			});	
	}
//funciones para el catalogo servicio
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
							<td>\
								<center>\
									<button class='btnEdtserv btn btn-sm btn-primary'>Editar</button>\
								</center>\
							</td>\
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
						<center>\
							<input type='button' class='btnGuardarServi btn btn-sm btn-success btnAddCot' value='Guardar' />\
							<button class='DeleteServi btn btn-sm btn-danger'>Eliminar</button>\
						</center>\
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
						<td><center><button class='btnEdtserv btn btn-sm btn-primary'>Editar</button></center>\
						</td>\
					  </tr>"
				//$(".vaciarinput").val("");
				$(".tbradio").prepend(tr);//ponemos el nuevo valor al principio
				tr.empty().append(newtr);
				//console.log(datos);
			}
		});
	}
	function DeleteServicio (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/servicioc/servicioc/delete_servicio",
				type: "POST",
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
					}
				}
			});	
	}
//funciones para el catalogo cliente
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
							<td class='tdNIT'>"+frm.txtNIT+"</td>\
							<td class='tdNRC ocultar'>"+frm.txtNRC+"</td>\
							<td class='tdDireccion ocultar'>"+frm.txtDireccion+"</td>\
							<td class='tdTelefono ocultar'>"+frm.txtTelefono+"</td>\
							<td class='tdContacto ocultar'>"+frm.txtContacto+"</td>\
							<td class='tdCorreo ocultar'>"+frm.txtCorreo+"</td>\
							<td>\
									<button class='EditCliente btn btn-sm btn-primary'>Editar</button>\
							</td>\
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
	function createEditCliente (idcliente,tr) {
		
		$.ajax({
			data:{
				id: JSON.stringify(idcliente)
			},
			url: getBaseURL() + "index.php/catalogosc/catalogosc/get_Cliente",
			type: "POST",
			success: function(datos) {
				data = jQuery.parseJSON(datos);//convirtiendo datos
				//console.log(data);
				newtr = "<tr>\
				<td class='ocultar'>\
					<input name='txtidcliente' value='"+data.idcliente+"' class='inputClienteId'>\
				</td>\
				<td>Nombre:</td><td>\
					<input name='txtNombre' class='txtNombre form-control' value='"+data.nombre+"'>\
				</td>\
				<td>Razón Social</td><td>\
					<input name='txtApellido' class='txtApellido form-control' value='"+data.razonsocial+"'>\
				</td></tr>\
				<tr><td>NIT:</td><td>\
					<input name='txtNIT' class='txtNIT form-control SoloNumero NumNit' value='"+data.nit+"' placeholder='0000-000000-000-0'>\
				</td>\
				<td>NRC</td><td>\
					<input name='txtNRC' class='txtNRC form-control SoloNumero NumNrc' value='"+data.nrc+"' placeholder='000000-0'>\
				</td></tr>\
				<tr><td>Dirección:</td><td>\
					<input name='txtDireccion' class='txtDireccion form-control' value='"+data.direccion+"'>\
				</td>\
				<td>Telefono</td><td>\
					<input name='txtTelefono' class='txtTelefono form-control NumTelefono SoloNumero' value='"+data.telefono+"'>\
				</td></tr>\
				<tr><td>Contacto</td><td>\
					<input name='txtContacto' class='txtContacto form-control' value='"+data.contacto+"'>\
				</td>\
				<td>Correo</td><td>\
					<input name='txtCorreo' class='txtCorreo form-control' value='"+data.correo+"'>\
				</td></tr>\
				<tr><td colspan='2'>\
					<center>\
						<input type='button' class='btnGuardarCliente btn btn-m btn-success btnAddCot' value='Guardar' />\
						<button class='DeleteClient btn btn-m btn-danger'>Eliminar</button>\
					</center>\
				</td></tr>";
				//tr.empty().append(newtr);
				$(".modificar").empty().append(newtr);
			}
		});	
	}
	function saveEditCliente (form,tr) {
		$.ajax({
			data:{
				form: JSON.stringify(form)
			},
			url: getBaseURL() + "index.php/catalogosc/catalogosc/update_cliente",
			type: "POST",
			success: function(datos) {
				idcliente = tr.find(".inputClienteId").val();
				data = jQuery.parseJSON(datos);//convirtiendo datos
				newtr = "\
						<td style='display:none'>\
							<input name='txtidRadio' value='"+idcliente+"' class='inputClienteId'>\
						</td>\
						<td class='tdNombCliente'>"+data.dato1+"</td>\
						<td class='tdApellidoCliente'>"+data.dato2+"</td>\
						<td class='tdNRC ocultar'>"+data.dato3+"</td>\
						<td class='tdNIT'>"+data.dato4+"</td>\
						<td class='tdDireccion ocultar'>"+data.dato5+"</td>\
						<td class='tdTelefono ocultar'>"+data.dato6+"</td>\
						<td class='tdContacto ocultar'>"+data.dato7+"</td>\
						<td class='tdCorreo ocultar'>"+data.dato8+"</td>\
						<td>\
							<button class='EditCliente btn btn-sm btn-primary'>Editar</button>\
						</td>";//creamos el nuevo fila

				$(".modificar").empty().append(newtr);
				//console.log(datos);
			}
		});
	}
	function DeleteCliente (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/clientesc/clientesc/delete_cliente",
				type: "POST",
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						location.reload();
					}
				}
			});	
	}
//funciones para el usuarios
	function agregarusuario (frm) {
		$.ajax({
			data:{
				form: JSON.stringify(frm)
			},
			url:  getBaseURL() + "index.php/usuario/usuarioc/insert_user",
			type: 	"POST",
			success: function(datos) {
				data = jQuery.parseJSON(datos);
				if (data.estado == false) {
					$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
				}else if(data.estado == true){
					location.reload();
					// tr = "<tr class='styleTR'>\
					// 		<td style='display:none'>\
					// 			<input name='txtIdUser' value='"+data.last_id+"' class='inputUserID'>\
					// 		</td>\
					// 		<td class='tdNombreUser'>"+frm.txtuser+"</td>\
					// 		<td class='tdContraUser'>"+frm.txtpassword+"</td>\
					// 		<td style='display:none' class='tdCopaniaId'>"+frm.txtIdCompania+"</td>\
					// 		<td><button class='EditUsuario btn btn-sm btn-primary'>Editar</button></td>\
					// 	  </tr>"
					// $(".tbUsuario").prepend(tr);//ponemos el nuevo valor al principio
					// //console.log(datos);
					// $(".vaciarinput").val("");
					// para input .val("") val()
					// para divs .empty() text()
				}
			}
		});
	}
	function CreateEdtUser (tr) {
		iduser = tr.find(".inputUserID").val();
		user = tr.find(".tdNombreUser").text();
		psw = tr.find(".tdContraUser").text();
		newtr = "\
				<td style='display:none'>\
					<input name='txtIdUser' value='"+iduser+"' class='inputUserID'>\
				</td>\
				<td>\
					<input name='txtNombUser' class='txtNombUser form-control' value='"+user+"'>\
				</td>\
				<td>\
					<input name='txtPsw' class='txtPsw form-control' value='"+psw+"'>\
				</td>\
				<td colspan='2'>\
					<input type='button' class='btnGuardarUser btn btn-sm btn-success btnAddCot' value='Guardar' />\
					<button class='DeleteUser btn btn-sm btn-danger'>Eliminar</button>\
				</td>";
				//console.log(idcliente,nombre,apellido);
				tr.empty().append(newtr);
	}
	function saveEditUser (form,tr) {
			$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/usuario/usuarioc/update_user",
				type: "POST",
				success: function(datos) {
					iduser = tr.find(".inputUserID").val();
					data = jQuery.parseJSON(datos);//convirtiendo datos
					newtr = "\
						<td style='display:none'>\
							<input name='txtIdUser' value='"+iduser+"' class='inputUserID'>\
						</td>\
						<td class='tdNombreUser'>"+data.dato1+"</td>\
						<td class='tdContraUser'>"+data.dato2+"</td>\
						<td class='tdFirmaUser'>"+data.dato3+"</td>\
						<td>\
							<button class='EditUsuario btn btn-sm btn-primary'>Editar</button>\
						</td>";//creamos el nuevo fila
					tr.empty().append(newtr);
					console.log(datos);
				}
			});
	}
	function DeleteUser (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/usuario/usuarioc/delete_user",
				type: "POST",
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
						//console.log(data);
						// para input .val("") val()
						// para divs .empty() text()
					}
				}
			});	
	}

function createEditFirma (tr) {
	iduser = tr.find(".InputIdUser").val();
	user = tr.find(".tdNombreUser").text();
	firma = tr.find(".tdAlgoUser").text();
	newtr = "\
				<td style='display:none'>\
					<textarea name='txtIdUser' cols='2' rows='1' class='form-control InputIdUser'>"+iduser+"</textarea>\
				</td>\
				<td>"+user+"</td>\
				<td>\
					<textarea name='txtfirma' cols='20' rows='3' class='form-control'>"+firma+"</textarea>\
				</td>\
				<td>\
					<input type='button' class='btnGuardarFirma btn btn-m btn-success btnAddCot' value='Guardar' />\
				</td>";
				tr.empty().append(newtr);
	//console.log("id-> ",iduser,user);
}
function saveFirma (frm, tr) {
	$.ajax({
				data:{
					form: JSON.stringify(frm)
				},
				url: getBaseURL() + "index.php/usuario/perfilc/updatefirma",
				type: "POST",
				success: function(datos) {
					iduser = tr.find(".InputIdUser").val();
					data = jQuery.parseJSON(datos);//convirtiendo datos
					newtr = "\
						<td style='display:none'>\
							<input name='txtIdUser' value='"+iduser+"' class='InputIdUser'>\
						</td>\
						<td class='tdNombreUser'>"+data.dato1+"</td>\
						<td class='tdAlgoUser'>"+data.dato2+"</td>\
						<td><button class='EditFirma btn btn-sm btn-primary'>Editar</button></td>\
						";//creamos el nuevo fila
					tr.empty().append(newtr);
					// console.log(iduser);
				}
			});
}
//funcion q retorna el mensaje para delete catalogos
function Serializar (tr) {
	frm = tr.find("input");//encuentro el valor contenido en el input
	frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
	return frm;
}