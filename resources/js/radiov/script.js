$(document).ready(function() {
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
});