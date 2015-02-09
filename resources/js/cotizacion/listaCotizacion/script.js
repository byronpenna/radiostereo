$(document).on("click",".btnDelCot",function(){
	tr = $(this).parents("tr");
	id = tr.find(".idCot").val();
	mensaje = "Advertencia: Desea Eliminar la Cotizacion  ? "
	alertify.confirm(mensaje,function(e) {
		if (e) {
			scrollTop();
            setTimeout(function() {
                    eliminarCot(id);
                }, 1000);
		}else{
			location.reload();
		}
	});
});