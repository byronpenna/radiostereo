$(document).on("click",".apCot",function(){
	var seleccionados=[];
	$(".dataApo :checked").each(function(i,val){
		seleccionados[i] = serializeToJson($(this).serializeArray());
	});
	if(seleccionados==0){
		alertify.error("Debe Seleccionar al menos una cotizacion");
	}else{
		obtenerDatosAprobados(seleccionados);
	}
	
});