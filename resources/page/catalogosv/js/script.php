$(document).ready(function () {
	// eventos
		// submit
			$(document).on("submit","#frmPrograma",function(e){
				e.preventDefault();
				frm = serializeToJson($(this).serializeArray());//se encuentra en funtion.php
				agregarPrograma(frm);//se encuentra en el archivo funtion.php
			});
});