$(document).ready(function() {
	//submit agregar precio
		$(document).on("submit","#frmPrecio",function(e){
			e.preventDefault();
			form = serializeToJson($(this).serializeArray());//se encuentra en funtion.php
			agregarPrecio(form);//se encuentra en el archivo funtion.php
		});
});