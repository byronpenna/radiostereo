$(document).ready(function () {
	// eventos
		// submit para el catalogo progama
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
		// submit para el catalogo precio
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
		// submit para el catalogo radio
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
		// submit para el catalogo servicio
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
		// submit para el catalogo servicio
			$(document).on("submit","#frmClientes",function(e) {
			e.preventDefault();
			form = serializeToJson($(this).serializeArray());
			agregarcliente(form);
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
		           opacity: 0.9,
		            modalColor: 'Lightgray',
			        speed: 650,
			        positionStyle: 'fixed' //'fixed' or 'absolute'
				});
			});
			$(document).on("click",".btnGuardarCliente",function(){//funcion q me controla el evento onclik ala hora de modificar
				tr = $(this).parents(".modificar");//ingreso a mi tr padre contenido en la vista
				tr2 = $("table").find(".tbClientes").find("tr");
				frm = tr.find("input");//encuentro el valor contenido en el input
				frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
				//console.log(frm);
				saveEditCliente(frm,tr,tr2);
				$(".popup").hide();//ocultar div;
				$(".popup").bPopup({//codigo para el popup
			        closeClass:'.btnGuardarCliente',
            		follow: [false, false] //x, y
				});
				
			});	
});