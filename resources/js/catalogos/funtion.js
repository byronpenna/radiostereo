function serializeToJson(a){
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
	//Esta funcion sirve para obtener la base de la url para poder redirigir de una manera mas eficiente
function getBaseURL() {
	var url = location.href;  // entire url including querystring - also: window.location.href;
	var baseURL = url.substring(0, url.indexOf('/', 14));

	if (baseURL.indexOf('http://localhost') != -1) {
	    // Base Url for localhost
	    var url = location.href;  // window.location.href;
	    var pathname = location.pathname;  // window.location.pathname;
	    var index1 = url.indexOf(pathname);
	    var index2 = url.indexOf("/", index1 + 1);
	    var baseLocalUrl = url.substr(0, index2);
	    return baseLocalUrl + "/";
	}
	else {
	    // Root Url for domain name
	    return baseURL + "/";
	}
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
						<button class='btnEditar'>Editar</button>\
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