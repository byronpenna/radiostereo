function serializeToJson(a){//convierte el form a un objeto jason
		var o = {};
		$.each(a, function() {
		   if (o[this.name]) {
		       if (!o[this.name].push) {
		           o[this.name] = [o[this.name]];
		       }
		       o[this.name].push(this.value || '');
		   } else {
		       o[this.name] = this.value || '';
		   }
		});
		return o;
	}
function createControlsEdit(tr){//funcion que me cargara el dato a editar
	idPrograma = tr.find(".inputProgramId").val();//busca el id del programa por medio de una clase y se encuentra en la vista
	nombrePrograma = tr.find(".tdProgramNombre").text();//busca el nombre del programa por medio de una clase y " "
	htmlTr = "\
			<td style='display:none'>\
				<input name='txtidprograma' value='"+idPrograma+"' class='inputProgramId'>\
			</td>\
			<td>\
				<input name='txtNombrePrograma' class='txtNombrePrograma' value='"+nombrePrograma+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarPrograma' value='Guardar' />\
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
		url: <?php echo "'".URLLOCAL."catalogosc/catalogosc/update_programa"."'" ?>,
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
						<button class='btnEditar'>Editar</button>\
					</td>";//creamos el nuevo fila
				tr.empty().append(tr2);
			}
			//console.log(data);
		}
	});
}
function createEditPrecio (tr) {//funcion para cargar el form de editar
	idprecio = tr.find("inputPrecioId").val();
	precio = tr.find("tdPrecio").text();
	newtr = "\
			<td style='display:none'>\
				<input name='txtidprecio' value='"+idprecio+"' class='inputProgramId'>\
			</td>\
			<td>\
				<input name='nombpro' class='inputPrecioId' value='"+precio+"'>\
			</td>\
			<td>\
				<input type='button' class='btnGuardarPrecio' value='Guardar' />\
			</td>";
			console.log(newtr);
			//tr.empty().append(newtr);
}
//aqui comienza las funciones ajax para agregar catalogos
function agregarPrograma(frm){//funcion que manda los datos al controlador
	$.ajax({
		data:{
			form: JSON.stringify(frm)//convierte el objeto jason a string
		},
		url: <?php echo "'".URLLOCAL."catalogosc/catalogosc/insert_programa"."'" ?>,
		type: 		"POST",
		success: 	function(datos){
			// agregar el elemento a la tabla 
			//console.log(data.mensaje);
				data = jQuery.parseJSON(datos);//convertimos los datos
				if (data.estado == false) {
					$(".mensaje").text(data.mensaje);//despues del punto accedo a cada valor
				}else if(data.estado == true){
					tr = "<tr>\
						<td style='display:none'>\
							<input name='txtidprograma' value='"+data.last_id+"' class='inputProgramId'>\
						</td>\
						<td class='tdProgramNombre'>"+frm.nombpro+"</td>\
						<td><button class='btnEditar'>Editar</button></td>\
					  </tr>"
					$(".tbProgramas").prepend(tr);//ponemos el nuevo valor al principio
				}
		}
	});
}
function agregarPrecio(form2) {//funcion que manda los datos de precio al controlador
	$.ajax({
		data:{
			form2: JSON.stringify(form2)//convierte el objeto jason a string
		},
		url: <?php echo "'".URLLOCAL."catalogosc/catalogosc/insert_precio"."'" ?>,
		type: 		"POST",
		success: 	function(datos){
			data = jQuery.parseJSON(datos);
			$(".mensaje").text(data.mensaje);
			//alert(datos);//muestra el mensaje
			//console.log(datos);
		}
	});
}
function agregarservicio(form3) {//funcion que manda los datos del servicio al controlador
	$.ajax({
		data:{
			form3: JSON.stringify(form3)
		},
		url: <?php echo "'".URLLOCAL."catalogosc/catalogosc/insert_servicio"."'" ?>,
		type: 	"POST",
		success:    function(datos) {
			data = jQuery.parseJSON(datos);
			$(".mensaje").text(data.mensaje);
			//console.log(datos);
		}
	});
}
function agregarradio(frm4) {//funcion que manda los datos de radio al controlador
	$.ajax({
		data:{
			form4: JSON.stringify(frm4)
		},
		url: <?php echo "'".URLLOCAL."catalogosc/catalogosc/insert_radio"."'" ?>,
		type: 	"POST",
		success: function(datos) {
			data = jQuery.parseJSON(datos);
			$(".mensaje").text(data.mensaje);
			//console.log(datos);
		}
	});
}
function agregarcliente(frm5) {
	$.ajax({
		data:{
			form5: JSON.stringify(frm5)
		},
		url: <?php echo "'".URLLOCAL."catalogosc/catalogosc/insert_cliente"."'" ?>,
		type: 	"POST",
		success: function(datos) {
			data = jQuery.parseJSON(datos);
			$(".mensaje").text(data.mensaje);
			//console.log(datos);
		}
	});
}
