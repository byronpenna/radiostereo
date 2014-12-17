$(document).ready(function() {
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
});