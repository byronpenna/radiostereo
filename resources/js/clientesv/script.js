$(document).ready(function() {
	//submit agregar cliente
		$(document).on("submit","#frmClientes",function(e) {
			e.preventDefault();
			form = serializeToJson($(this).serializeArray());
			agregarcliente(form);
			//console.log(form);
		});
	//funciones para editar precio
		$(document).on("click",".EditCliente",function() {//obtiene la fila con los datos
			tr = $(this).parents("tr");
			//console.log(tr);
			createEditCliente(tr);
		});
		$(document).on("click",".btnGuardarCliente",function(){//funcion q me controla el evento onclik ala hora de modificar
			tr = $(this).parents("tr");//ingreso a mi tr padre contenido en la vista
			frm = tr.find("input");//encuentro el valor contenido en el input
			frm = serializeToJson(frm.serializeArray());//convierto los datos en un array de tipo form
			//console.log(frm);
			saveEditCliente(frm,tr);
		});	
})