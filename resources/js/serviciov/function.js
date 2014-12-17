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
							<input name='txtidServicio' value='"+data.last_id+"' class='inputProgramId'>\
						</td>\
						<td class='tdServicioNombre'>"+form.servicio+"</td>\
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
					<input name='txtServicio' class='txtServi' value='"+nombservicio+"'>\
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
