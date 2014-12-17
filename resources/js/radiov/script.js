$(document).ready(function() {
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
});