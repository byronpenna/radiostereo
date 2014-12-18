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
				tr = "<tr class='styleTR'>\
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