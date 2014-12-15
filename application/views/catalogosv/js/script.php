$(document).ready(function () {
	// eventos
		// click
			$(document).on("click",".btnEditar",function(){//funcion para obtener la fila y editarla
				tr = $(this).parents("tr");//obtengo toda la fila del tr padre en mi vista
				createControlsEdit(tr);//paso todo la fila obtenida a la funcion createControlsEdit
										//ubicada en el archivo functio.php
			});
			$(document).on("click",".btnGuardarPrograma",function(){//funcion q me controla el evento onclik ala hora de modificar
				tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
				frm = tr.find("input");//encuentro el valor contenido en el input
				frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
				//console.log(frm);
				saveEditPrograma(frm,tr);
			});
			//funciones para editar precio
			$(document).on("click",".btnEditPrecio",function() {//obtiene la fila con los datos
				tr = $(this).parents("tr");
				//console.log(tr);
				createEditPrecio(tr);
			});
			$(document).on("click",".btnGuardarPrecio",function () {
				tr = $(this).parents("tr");
				frm = tr.find("input");
				frm = serializeToJson(frm.serializeArray());
				//console.log(frm);
				savenewPrecio(frm,tr);
			});
			//funciones para editar servicios
			$(document).on("click",".btnEdtserv",function() {//obtiene la fila con los datos
				tr = $(this).parents("tr");
				createEditServicio(tr);
			});
			$(document).on("click",".btnGuardarServi",function () {
				tr = $(this).parents("tr");
				frm = tr.find("input");
				frm = serializeToJson(frm.serializeArray());
				//console.log(frm);
				savenewServicio(frm,tr);
			});
		//keypress
			$(document).on("keypress","#txtPrecio",function(e){//evento para validar si es un numero
				exp 					= /[0-9 ,\.]/; // expresion regular y buscar codigo asccii
				ascciiCaracterIngresado = e.which;//which obtiene el codigo ascii del el evento keypress
				caracter 				= String.fromCharCode(ascciiCaracterIngresado); //obtenemos el caracter ingresado
				console.log("Ingresaste el caracter: ",caracter);
				if(exp.test(caracter)){
					if (caracter.indexOf('.')) {
						console.log(caracter);
					};
					
				}else{
					e.preventDefault();//evitamos que se ejecute la accion
					//console.log("no es un numero");
				}
			});
		// submit
			$(document).on("submit","#frmPrograma",function(e){
				e.preventDefault();
				frm = serializeToJson($(this).serializeArray());//se encuentra en funtion.php
				agregarPrograma(frm);//se encuentra en el archivo funtion.php
			});
			//submit agregar precio
			
			$(document).on("submit","#frmPrecio",function(e){
					e.preventDefault();
					form2 = serializeToJson($(this).serializeArray());//se encuentra en funtion.php
					agregarPrecio(form2);//se encuentra en el archivo funtion.php
				});
			//submit agregar servicio
			$(document).on("submit","#frmServicio",function(e) {
				e.preventDefault();
				form3 = serializeToJson($(this).serializeArray());
				agregarservicio(form3);
			});
			//submit agregar radio
			$(document).on("submit","#frmRadio",function(e) {
				e.preventDefault();
				form4 = serializeToJson($(this).serializeArray());
				//console.log(form4);
				agregarradio(form4);
			});
			//submit agregar cliente
			$(document).on("submit","#frmClientes",function(e) {
				e.preventDefault();
				form5 = serializeToJson($(this).serializeArray());
				agregarcliente(form5);
				//console.log(form5);
			});
});