function addOption(selector){
	// txt = $("#inprod").val();
	txt 		= selector.parents(".contendorMultiple").find("#inprod").val();
	txtClear 	= selector.parents(".contendorMultiple").find("#inprod");
	console.log("el valor txt:",txt);
	if(txt != ""){
		optionAgregar = "<option value='"+txt+"'>"+txt+"</option>";
		selector.parents(".contendorMultiple").find("#addprod").append(optionAgregar);
		txtClear.val("");
	}else{
		alertify.error("rellene el campo por favor");
	}	
}
function removeOption(selector){
	// optionVal = $("#addprod option:selected");
	optionVal = selector.parents(".contendorMultiple").find("#addprod option:selected");
	optionVal1 = selector.parents(".contendorMultiple").find("#addprod option:selected").html();
	txtClear 	= selector.parents(".contendorMultiple").find("#inprod");
	// txtClear.val("Prueba");
	if(!(optionVal.val() == undefined)){
		txtClear.val(optionVal1);
		optionVal.remove();
	}else{
		alertify.error("Debe seleccionar una opcion");
	}
	
}
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
						<button class='btnGuardarPrograma btn btn-sm btn-success btnAddCot'><i class='glyphicon glyphicon-check'></i></button>\
						<button class='DeleteProgra btn btn-sm btn-danger'><i class='glyphicon glyphicon-trash'></i></button>\
						<button class='btn btn-sm btn-warning limpiar'><i class='glyphicon glyphicon-remove'></i></button>\
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
			beforeSend: function(){
          // cargando
	          $(".cont-loading").css("display","block");
	          },
			success: 	function(datos) {
				idPrograma = tr.find(".inputProgramId").val();//buscamos el id para construir la fila
				data = jQuery.parseJSON(datos);//convirtiendo datos
				$(".cont-loading").css("display","none");
				if (data.estado == false) {
					$(".mensaje").text(data.mensaje);
				}else if(data.estado == true){
					tr2 = "\
						<td style='display:none'>\
							<input name='txtidprograma' value='"+idPrograma+"' class='inputProgramId'>\
						</td>\
						<td class='tdProgramNombre'>"+data.dato+"</td>\
						<td>\
							<center><button class='btnEditar btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button></center>\
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
			beforeSend: function(){
          // cargando
	          $(".cont-loading").css("display","block");
	          },
			success: 	function(datos){
				// agregar el elemento a la tabla
				data = jQuery.parseJSON(datos);//convertimos los datos
				$(".cont-loading").css("display","none");
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
									<button class='btnEditar btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
								</center>\
							</td>\
						  </tr>"
					$(".vaciarinput").val("");
					$(".tbProgramas").prepend(tr);//ponemos el nuevo valor al principio	
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success: function(datos) {
				data = jQuery.parseJSON(datos);
				$(".cont-loading").css("display","none");
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
									<button class='btnEdtRadio btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
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
						<button class='btnGuardarRadio btn btn-sm btn-success btnAddCot'><i class='glyphicon glyphicon-check'></i></button>\
						<button class='DeleteRadio btn btn-sm btn-danger'><i class='glyphicon glyphicon-trash'></i></button>\
						<button class='btn btn-sm btn-warning limpiar'><i class='glyphicon glyphicon-remove'></i></button>\
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success: function(datos) {
				idradio = tr.find(".inputRadioId").val();
				data = jQuery.parseJSON(datos);//convirtiendo datos
				$(".cont-loading").css("display","none");	
				newtr = "\
						<td style='display:none'>\
							<input name='txtidRadio' value='"+idradio+"' class='inputRadioId'>\
						</td>\
						<td class='tdRadioNomb'>"+data.dato+"</td>\
						<td>\
							<center>\
								<button class='btnEdtRadio btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
							</center>\
						</td>";//creamos el nuevo fila
				tr.empty().append(newtr);
				//console.log(datos);
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success: 	function(datos){
				data = jQuery.parseJSON(datos);
				$(".cont-loading").css("display","none");
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
									<button class='btnEditPrecio btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
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
						<button class='btnGuardarPrecio btn btn-sm btn-success btnAddCot'><i class='glyphicon glyphicon-check'></i></button>\
						<button class='DeletePrecio btn btn-sm btn-danger'><i class='glyphicon glyphicon-trash'></i></button>\
						<button class='btn btn-sm btn-warning limpiar'><i class='glyphicon glyphicon-remove'></i></button>\
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success: function(datos) {
				idprecio = tr.find(".inputPrecioId").val();
				data = jQuery.parseJSON(datos);//convirtiendo datos
				$(".cont-loading").css("display","none");
				newtr = "\
						<td style='display:none'>\
							<input name='txtidprecio' value='"+idprecio+"' class='inputPrecioId'>\
						</td>\
						<td class='tdPrecio'>"+data.dato+"</td>\
						<td>\
							<center>\
								<button class='btnEditPrecio btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
							</center>\
						</td>";//creamos el nuevo fila
				tr.empty().append(newtr);
				//console.log(datos);
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success:    function(datos) {
				// agregar el elemento a la tabla
				data = jQuery.parseJSON(datos);//convertimos los datos
				$(".cont-loading").css("display","none");
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
									<button class='btnEdtserv btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
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
							<button class='btnGuardarServi btn btn-sm btn-success btnAddCot' ><i class='glyphicon glyphicon-check'></i></button>\
							<button class='DeleteServi btn btn-sm btn-danger'><i class='glyphicon glyphicon-trash'></i></button>\
							<button class='btn btn-sm btn-warning limpiar'><i class='glyphicon glyphicon-remove'></i></button>\
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success: function(datos) {
				idServi = tr.find(".inputServId").val();
				data = jQuery.parseJSON(datos);//convirtiendo datos
				$(".cont-loading").css("display","none");
				newtr = "\
						<td style='display:none'>\
							<input name='txtidservicio' value='"+idServi+"' class='inputServId'>\
						</td>\
						<td class='tdServicio'>"+data.dato+"</td>\
						<td><center><button class='btnEdtserv btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button></center>\
						</td>\
					  </tr>"
				//$(".vaciarinput").val("");
				$(".tbradio").prepend(tr);//ponemos el nuevo valor al principio
				tr.empty().append(newtr);
				//console.log(datos);
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success: function(datos) {
				console.log(datos);
				data = jQuery.parseJSON(datos);
				console.log(data);
				$(".cont-loading").css("display","none");
				if(data=="no"){
					$(".vaciarinput").val("");
					$("#addprod option").remove();
					alertify.error("Advertencia: El NIT y NRC ingresados ya existen.");
				}else{
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
						$(".vaciarinput").val("");
						$("#addprod option").remove();
					}else if(data.estado == true){
						tr = "<tr class='styleTR'>\
								<td style='display:none'>\
									<input name='txtidCliente' value='"+data.last_id+"' class='inputClienteId'>\
								</td>\
								<td class='tdNombCliente'>"+frm.txtnombcliente+"</td>\
								<td class='tdApellidoCliente'>"+frm.txtapellido+"</td>\
								<td class='tdNIT'>"+frm.txtNIT+"</td>\
								<td class='tdTitulo'>"+frm.txtTitulo+"</td>\
								<td class='tdNRC ocultar'>"+frm.txtNRC+"</td>\
								<td class='tdDireccion ocultar'>"+frm.txtDireccion+"</td>\
								<td class='tdTelefono ocultar'>"+frm.txtTelefono+"</td>\
								<td class='tdContacto ocultar'>"+frm.txtContacto+"</td>\
								<td class='tdCorreo ocultar'>"+frm.txtCorreo+"</td>\
								<td>\
										<button class='EditCliente btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
								</td>\
							  </tr>"
						$(".tbClientes").prepend(tr);//ponemos el nuevo valor al principio
						//console.log(frm);
						$(".vaciarinput").val("");
						$("#addprod option").remove();
						// para input .val("") val()
						// para divs .empty() text()
						alertify.success("Cliente ingresado con éxito.");
					}
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
					<input name='txtNIT' class='txtNIT form-control NumNit' pattern='\d{4}[\-]{1}\d{6}[/-]{1}\d{3}[/-]{1}\d{1}' value='"+data.nit+"' placeholder='0000-000000-000-0'>\
				</td>\
				<td>NRC</td><td>\
					<input name='txtNRC' class='txtNRC form-control NumNrc' value='"+data.nrc+"' placeholder='NRC'>\
				</td></tr>\
				<tr><td>Dirección:</td><td>\
					<input name='txtDireccion' class='txtDireccion form-control' value='"+data.direccion+"'>\
				</td>\
				<td>Teléfono</td><td>\
					<input name='txtTelefono' class='txtTelefono form-control NumTelefono' pattern='\d{4}[\-]{1}\d{4}' value='"+data.telefono+"'>\
				</td></tr>\
				<tr><td>Contacto</td><td>\
					<input name='txtContacto' class='txtContacto form-control' value='"+data.contacto+"'>\
				</td>\
				<td>Correo</td><td>\
					<input name='txtCorreo' class='txtCorreo form-control' value='"+data.correo+"'>\
				</td></tr>\
				<tr><td>Título de Contacto</td><td>\
					<input name='txtTitulo' class='txtTitulo form-control' value='"+data.titulo+"'>\
				</td>\
				<td>Giro</td><td>\
					<input name='txtGiro' class='txtGiro form-control' value='"+data.giro+"'>\
				</td></tr>\
				<tr>\
				<td>Categoria</td>\
				<td><select name='cat' class='input-sm cat form-control ' required>"+data.cat+"</select></td>\
				</tr>\
				<tr><td colspan='2'>\
					<center>\
						<input type='button' class='btnGuardarCliente btn btn-m btn-success btnAddCot' value='Guardar' />\
						<button class='DeleteClient btn btn-m btn-danger'>Eliminar</button>\
					</center>\
				</td></tr>\
				";
				//tr.empty().append(newtr);
				opciones = "";
				console.log("los productos son: ",data.productos);
				$.each(data.productos,function(i,val){
					opciones += "<option value='"+val.pro_id+"'>"+val.pro_nomb_producto+"</option>";
				});
				$(".modalContenedorMultiple").find("#addprod").empty().append(opciones);
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
				console.log(datos);
				data = jQuery.parseJSON(datos);//convirtiendo datos
				console.log(data);
				
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
							<button class='EditCliente btn btn-sm btn-primary'><i class='glyphicon glyphicon-edit'></i></button>\
						</td>";//creamos el nuevo fila
				$(".modificar").empty().append(newtr);
				//console.log(datos);
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
			beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
			success: function(datos) {
				data = jQuery.parseJSON(datos);
				$(".cont-loading").css("display","none");
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
		nomb = tr.find(".tdNomCompleto").text();
		psw = tr.find(".tdContraUser").text();
		newtr = "\
				<td style='display:none'>\
					<input name='txtIdUser' value='"+iduser+"' class='inputUserID'>\
				</td>\
				<td>\
					<input name='txtNombUser' class='txtNombUser form-control' value='"+user+"'>\
				</td>\
				<td>\
					<input name='txtNomCompleto' placeholder='Nombre Completo' class='txtNomCompleto form-control' value='"+nomb+"'>\
				</td>\
				<td>\
					<input type='password' placeholder='Contraseña' name='txtPsw' class='txtPsw form-control' value='"+psw+"'>\
				</td>\
				<td colspan='2'>\
					<button class='btnGuardarUser btn btn-sm btn-primary btnAddCot'><i class='glyphicon glyphicon-check'></i></button>\
					<button class='DeleteUser btn btn-sm btn-danger'><i class='glyphicon glyphicon-trash'></i></button>\
					<button class='btn btn-sm btn-warning limpiar'><i class='glyphicon glyphicon-remove'></i></button>\
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
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					iduser = tr.find(".inputUserID").val();
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
					newtr = "\
						<td style='display:none'>\
							<input name='txtIdUser' value='"+iduser+"' class='inputUserID'>\
						</td>\
						<td class='tdNombreUser'>"+data.dato1+"</td>\
						<td class='tdNomCompleto'>"+ data.dato4 + "</td>\
						<td class='tdNombreUser'></td>\
						<td>\
							<button class='EditUsuario btn btn-sm btn-primary'><i class='glyphicon glyphicon-pencil'></i></button>\
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
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
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
	nomb = tr.find(".tdNomCompleto").text();
	firma = tr.find(".tdAlgoUser").text();
	newtr = "\
				<td style='display:none'>\
					<textarea name='txtIdUser' cols='2' rows='1' class='form-control InputIdUser'>"+iduser+"</textarea>\
				</td>\
				<td>"+user+"</td>\
				<td><input name='txtNomCompleto' type='text' class='form-control' value='"+nomb+"'></td>\
				<td>\
					<textarea name='txtfirma' cols='20' rows='3' class='form-control'>"+firma+"</textarea>\
				</td>\
				<td>\
					<button class='btnGuardarFirma btn btn-m btn-success btnAddCot'> <i class='glyphicon glyphicon-check'></i></button>\
					<button class='btn btn-m btn-warning limpiar'><i class='glyphicon glyphicon-remove'></i></button>\
				</td>";
				tr.empty().append(newtr);
	//console.log("id-> ",iduser,user);
}


	

		function DeletePrograma (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/catalogosc/catalogosc/delete_programa",
				type: "POST",
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					//console.log(datos);
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
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







	function DeleteRadio (form,tr) {
		$.ajax({
				data:{
					form: JSON.stringify(form)
				},
				url: getBaseURL() + "index.php/radiosc/radiosc/delete_radio",
				type: "POST",
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
					}
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
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
					}
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
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						tr.empty();
					}
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
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
					if (data.estado == false) {
						$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
					}else if(data.estado == true){
						location.reload();
					}
				}
			});	
	}







function saveFirma (frm, tr) {
	$.ajax({
				data:{
					form: JSON.stringify(frm)
				},
				url: getBaseURL() + "index.php/usuario/perfilc/updatefirma",
				type: "POST",
				beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
				success: function(datos) {
					iduser = tr.find(".InputIdUser").val();
					data = jQuery.parseJSON(datos);//convirtiendo datos
					$(".cont-loading").css("display","none");
					newtr = "\
						<td style='display:none'>\
							<input name='txtIdUser' value='"+iduser+"' class='InputIdUser'>\
						</td>\
						<td class='tdNombreUser'>"+data.dato1+"</td>\
						<td class='tdNomCompleto'>"+data.dato3+"</td>\
						<td class='tdAlgoUser'>"+data.dato2+"</td>\
						<td><button class='EditFirma btn btn-primary'><i class='glyphicon glyphicon-pencil'></i></button></td>\
						";//creamos el nuevo fila
					tr.empty().append(newtr);
					// console.log(iduser);
				}
			});
}



		//funcion para asignar roles a usuarios
		function asignRol(frm) {
			$.ajax({
						data:{
							form: JSON.stringify(frm)
						},
						url: getBaseURL() + "index.php/usuario/roluserc/asignaRol",
						type: "POST",
						beforeSend: function(){
          // cargando
          $(".cont-loading").css("display","block");
          },
						success: function(datos) {
							var data = jQuery.parseJSON(datos);//convirtiendo datos
							$(".cont-loading").css("display","none");
							if(data==true){
								alertify.success("Los roles han sido asignados con exito");
					              setTimeout(function() {
					                location.reload();
					              }, 1500);
					          }else{
					          	alertify.error("Ha surgido algun problema inesperado, intente de nuevo");
					              setTimeout(function() {
					                location.reload();
					              }, 1500);
					          }
						}
					});
		}



		function getCat(){
			$.ajax({
						url: getBaseURL() + "index.php/clientesc/clientesc/getCat",
						success: function(datos) {
							console.log(datos);
							var data = jQuery.parseJSON(datos);//convirtiendo datos
							console.log(data);
							option = "";
							jQuery(data).each(function(i,val){
								option +="<option value='"+val.cat_id+"'>"+val.cat_categoria+"</option>";
							});

							$(".cat").empty().append(option);

						}
					});	
		}


//funcion q retorna el mensaje para delete catalogos
function Serializar (tr) {
	frm = tr.find("input,select");//encuentro el valor contenido en el input
	frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
	return frm;
}