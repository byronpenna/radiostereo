$(document).ready(function () {
	//desplegar forn cliente
		$("#frmClientes").hide();
		$(document).on("click",".btnDesplegar",function() {
			$("#frmClientes").slideToggle(175);
		})
	// eventos
		// click 
			$(document).on("click",".btnActionMultiple",function(){
				direccion = $(this).attr("direccion"); // 1 derecha, 0 izquierda
				console.log("entro");
				if(direccion == 1){
					addOption($(this));
				}else if(direccion == 0){
					removeOption($(this));
				}
			});
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
				 tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
			 	frm = Serializar(tr);
			 	mensaje = "Advertencia: El programa se eliminara si aun no esta relacionado con cotizaciones, de lo contrario no se podra eliminar"
				alertify.confirm(mensaje,function(e) {
								if (e) {
										DeletePrograma(frm,tr);
				 					}else{
				 						//console.log("no");
				 						location.reload();
				 					}
				 				});
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
					frm = Serializar(tr);
					//console.log(frm);
					savenewRadio(frm,tr);
			});
			$(document).on("click",".DeleteRadio",function(){//funcion q me controla el evento onclik ala hora de eliminar
				 tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
			 	frm = Serializar(tr);
			 	mensaje = "Advertencia: La Radio se eliminara si aun no esta relacionado con cotizaciones, de lo contrario no se podra eliminar"
				alertify.confirm(mensaje,function(e) {
								if (e) {
										DeleteRadio(frm,tr);
				 					}else{
				 						//console.log("no");
				 						location.reload();
				 					}
				 				});
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
				frm = Serializar(tr);
				//console.log(frm);
				savenewPrecio(frm,tr);
			});
			$(document).on("click",".DeletePrecio",function(){//funcion q me controla el evento onclik ala hora de eliminar
				tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
			 	frm = Serializar(tr);
			 	mensaje = "Advertencia: No debe eliminar esta Tarifa porque puede estar en uso por las cotizaciones, ¿aun asi desea continuar?"
				alertify.confirm(mensaje,function(e) {
								if (e) {
										DeletePrecio(frm,tr);
				 					}else{
				 						//console.log("no");
				 						location.reload();
				 					}
				 				});
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
				frm = Serializar(tr);
				// console.log(frm);
				savenewServicio(frm,tr);
			});
			$(document).on("click",".DeleteServi",function(){//funcion q me controla el evento onclik ala hora de eliminar
				tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
			 	frm = Serializar(tr);
			 	mensaje = "Advertencia: El Servicio se eliminara si aun no esta relacionado con cotizaciones, de lo contrario no se podra eliminar"
				alertify.confirm(mensaje,function(e) {
								if (e) {
										DeleteServicio(frm,tr);
				 					}else{
				 						location.reload();
				 					}
				 				});
			});
		//submit agregar cliente
			$(document).on("submit","#frmClientes",function(e) {
				e.preventDefault();
				form 		= serializeToJson($(this).serializeArray());
				options 	= $('#addprod option');
				var values = $.map(options ,function(option) {
				    return option.value;
				});
				if(values.length){
					form.programas = values;	
					agregarcliente(form);
					$("#frmClientes").hide();	
				}else{
					alertify.error("Agregue por lo menos un programa");
				}				
				console.log(form);
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
				frm = Serializar(tr);

				// #############
					options 	= $('#addprod option');
					var values = $.map(options ,function(option) {
					    return option.value;
					});
				frm.productos = values;

				console.log("formulario",frm);
				saveEditCliente(frm,tr);
				location.reload();
				$(".popup").hide();//ocultar div;
				$(".popup").bPopup({//codigo para el popup
			        closeClass:'.btnGuardarCliente',
            		follow: [false, false] //x, y
				});
				
			});	
			$(document).on("click",".DeleteClient",function(){//funcion q me controla el evento onclik ala hora de eliminar
				tr = $(this).parents(".popup");//ingreso a mi tr padre contenido en la vista
			 	frm = Serializar(tr);
			 	mensaje = "Advertencia: El Cliente se eliminara si aun no esta relacionado con cotizaciones, de lo contrario no se podra eliminar"
				alertify.confirm(mensaje,function(e) {
								if (e) {
										DeleteCliente(frm,tr);
										location.reload();
				 					}else{
				 						location.reload();
				 					}
				 				});
			});
		//submit agregar usuario
			$(document).on("submit","#frmMantoUser",function(e) {
				e.preventDefault();
				form = serializeToJson($(this).serializeArray());
				agregarusuario(form);
				//console.log(form);
			});
			$(document).on("click",".EditUsuario",function() {//obtiene la fila con los datos
				tr = $(this).parents("tr");
				//console.log(tr);
				CreateEdtUser(tr);
			});
			$(document).on("click",".btnGuardarUser",function(){//funcion q me controla el evento onclik ala hora de modificar
				tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
				frm = Serializar(tr);
				//console.log(frm);
				saveEditUser(frm,tr);
			});	
			$(document).on("click",".EditFirma",function() {
				tr = $(this).parents("tr");
				createEditFirma(tr);
			});
			$(document).on("click",".btnGuardarFirma",function() {
				tr = $(this).parents("tr");
				frm = tr.find("textarea");//encuentro el valor contenido en el input
				frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
				//console.log(frm);
				saveFirma(frm,tr);
			});
			$(document).on("click",".DeleteUser",function(){//funcion q me controla el evento onclik ala hora de modificar
					tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
					frm = Serializar(tr);

				 	console.log(frm);
				 	mensaje = "Advertencia: Si elimina el Usuario eliminara toda la información relacionada con el. ¿Aun asi desea continuar?"
					alertify.confirm(mensaje,function(e) {
				 					if (e) {
										DeleteUser(frm,tr);
				 					}else{
				 						//console.log("no");
				 						location.reload();
				 					}
				 				});
			});


			$(document).on("click","#asignRol",function(){
				formulario = $(".rolClientes");
				frm = Serializar(formulario);
				// console.log(frm);
				asignRol(frm);
			});
});