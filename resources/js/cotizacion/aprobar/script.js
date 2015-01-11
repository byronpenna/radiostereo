$(document).on("click",".apCot",function(){
	var seleccionados=[];
	$(".dataApo :checked").each(function(i,val){
		seleccionados[i] = serializeToJson($(this).serializeArray());
	});

	obtenerDatosAprobados(seleccionados);
});