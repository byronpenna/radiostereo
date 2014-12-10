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
				saveEditPrograma(frm);
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
				agregarradio(form4);
			});
});