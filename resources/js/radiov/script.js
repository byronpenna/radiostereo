$(document).ready(function() {
	//submit agregar radio
		$(document).on("submit","#frmRadio",function(e) {
			e.preventDefault();
			form = serializeToJson($(this).serializeArray());
			//console.log(form4);
			agregarradio(form);
		});
});