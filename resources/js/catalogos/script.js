$(document).ready(function () {
	//desplegar forn cliente
		$("#frmClientes").hide();
		$(document).on("click",".btnDesplegar",function() {
			$("#frmClientes").slideToggle(175);
		})
	// eventos
		// submit
			$(document).on("submit","#frmPrograma",function(e){
				e.preventDefault();
				frm = serializeToJson($(this).serializeArray());//se encuentra en funtion.php
				agregarPrograma(frm);//se encuentra en el archivo funtion.php
			});
			//funcion para obtener la fila y editarla
			$(document).on("click",".btnEditar",function(){
				tr = $(this).parents("tr");//obtengo toda la fila del tr padre en mi vista
				createControlsEdit(tr);//paso todo la fila obtenida a la funcion createControlsEdit
										//ubicada en el archivo functio.php
			});
			//funcion que me controla el evento onclik a la hora de modificar
			$(document).on("click",".btnGuardarPrograma",function(){
				tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
				frm = tr.find("input");//encuentro el valor contenido en el input
				frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
				//console.log(frm);
				saveEditPrograma(frm,tr);
			});
			$(document).on("click",".DeleteProgra",function(){//funcion q me controla el evento onclik ala hora de eliminar
				 if (confirm("Advertencia: Si elimina el Programa eliminará toda la información\
				 				relacionada con él. ¿Aun asi desea continuar?")){
				 	tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
					frm = tr.find("input");//encuentro el valor contenido en el input
					frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
					console.log(frm);
					//DeleteUser(frm,tr);
		            return true;
		         }
		         else{
		            return false;
				}
			});
		//submit agregar radio
			$(document).on("submit","#frmRadio",function(e) {
				e.preventDefault();
				form = serializeToJson($(this).serializeArray());
				//console.log(form4);
				agregarradio(form);
			});
			//funciones para editar servicios
			$(document).on("click",".btnEdtRadio",function() {//obtiene la fila con los datos
				tr = $(this).parents("tr");
				//console.log(tr);
				createEditRadio(tr);
			});
			$(document).on("click",".btnGuardarRadio",function () {
					tr = $(this).parents("tr");
					frm = tr.find("input");
					frm = serializeToJson(frm.serializeArray());
					//console.log(frm);
					savenewRadio(frm,tr);
			});
			$(document).on("click",".DeleteRadio",function(){//funcion q me controla el evento onclik ala hora de eliminar
				 if (confirm("Advertencia: Si elimina la Radio eliminará toda la información\
				 				relacionada con él. ¿Aun asi desea continuar?")){
				 	tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
					frm = tr.find("input");//encuentro el valor contenido en el input
					frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
					console.log(frm);
					//DeleteUser(frm,tr);
		            return true;
		         }
		         else{
		            return false;
				}
			});
		//submit agregar precio
			$(document).on("submit","#frmPrecio",function(e){
				e.preventDefault();
				form = serializeToJson($(this).serializeArray());//se encuentra en funtion.php
				agregarPrecio(form);//se encuentra en el archivo funtion.php
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
			$(document).on("click",".DeletePrecio",function(){//funcion q me controla el evento onclik ala hora de eliminar
				 if (confirm("Advertencia: Si elimina el Precio eliminará toda la información\
				 				relacionada con él. ¿Aun asi desea continuar?")){
				 	tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
					frm = tr.find("input");//encuentro el valor contenido en el input
					frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
					console.log(frm);
					//DeleteUser(frm,tr);
		            return true;
		         }
		         else{
		            return false;
				}
			});
		//submit agregar servicio
			$(document).on("submit","#frmServicio",function(e) {
				e.preventDefault();
				form = serializeToJson($(this).serializeArray());
				agregarservicio(form);
			});
			//funciones para editar servicios
			$(document).on("click",".btnEdtserv",function() {//obtiene la fila con los datos
				tr = $(this).parents("tr");
				//console.log(tr);
				createEditServicio(tr);
			});
			$(document).on("click",".btnGuardarServi",function () {
				tr = $(this).parents("tr");
				frm = tr.find("input");
				frm = serializeToJson(frm.serializeArray());
				//console.log(frm);
				savenewServicio(frm,tr);
			});
			$(document).on("click",".DeleteServi",function(){//funcion q me controla el evento onclik ala hora de eliminar
				 if (confirm("Advertencia: Si elimina el Servicio eliminará toda la información\
				 				relacionada con él. ¿Aun asi desea continuar?")){
				 	tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
					frm = tr.find("input");//encuentro el valor contenido en el input
					frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
					console.log(frm);
					//DeleteUser(frm,tr);
		            return true;
		         }
		         else{
		            return false;
				}
			});
		//submit agregar cliente
			$(document).on("submit","#frmClientes",function(e) {
				e.preventDefault();
				form = serializeToJson($(this).serializeArray());
				agregarcliente(form);
				$("#frmClientes").hide();
				//console.log(form);
			});
			//funciones para editar cliente
			$(".popup").hide()//se oculta el div de modificar;
			$(document).on("click",".EditCliente",function() {//obtiene la fila con los datos
				tr = $(this).parents("tr");
				idcliente = tr.find(".inputClienteId").val();
				//console.log(idcliente);
				createEditCliente(idcliente,tr);
				$(".modificar").show()//se muestra el div de modificar;
				$(".popup").bPopup({//codigo para el popup
		            easing: 'easeOutBack', //uses jQuery easing plugin
		            opacity: 0.6,
		            positionStyle: 'fixed' //'fixed' or 'absolute'
				});
			});
			$(document).on("click",".btnGuardarCliente",function(){//funcion q me controla el evento onclik ala hora de modificar
				tr = $(this).parents(".modificar");//ingreso a mi tr padre contenido en la vista
				//tr2 = $("table").find(".tbClientes").find("tr");
				frm = tr.find("input");//encuentro el valor contenido en el input
				frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
				//console.log(frm);
				saveEditCliente(frm,tr);
				location.reload();
				$(".popup").hide();//ocultar div;
				$(".popup").bPopup({//codigo para el popup
			        closeClass:'.btnGuardarCliente',
            		follow: [false, false] //x, y
				});
				
			});	
			$(document).on("click",".DeleteClient",function(){//funcion q me controla el evento onclik ala hora de eliminar
				 if (confirm("Advertencia: Si elimina el Cliente eliminará toda la información\
				 				relacionada con él. ¿Aun asi desea continuar?")){
				 	tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
					frm = tr.find("input");//encuentro el valor contenido en el input
					frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
					console.log(frm);
					//DeleteUser(frm,tr);
		            return true;
		         }
		         else{
		            return false;
				}
			});
		//submit agregar usuario
			$(document).on("submit","#frmUser",function(e) {
				e.preventDefault();
				form = serializeToJson($(this).serializeArray());
				//agregarusuario(form);
				console.log(form);
			});
			$(document).on("click",".EditUsuario",function() {//obtiene la fila con los datos
				tr = $(this).parents("tr");
				//console.log(tr);
				CreateEdtUser(tr);
			});
			$(document).on("click",".btnGuardarUser",function(){//funcion q me controla el evento onclik ala hora de modificar
				tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
				frm = tr.find("input");//encuentro el valor contenido en el input
				frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
				//console.log(frm);
				saveEditUser(frm,tr);
			});	
			$(document).on("click",".DeleteUser",function(){//funcion q me controla el evento onclik ala hora de modificar
				 if (confirm("Advertencia: Si elimina el Usuario eliminara toda la información\
				 				relacionada con el. ¿Aun asi desea continuar?")){
				 	tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
					frm = tr.find("input");//encuentro el valor contenido en el input
					frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
					//console.log(frm);
					DeleteUser(frm,tr);
		            return true;
		         }
		         else{
		            return false;
				}
				
			});	
});