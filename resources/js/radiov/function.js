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
				$(".tbprecios").prepend(tr);//ponemos el nuevo valor al principio
			}
		}
	});
}