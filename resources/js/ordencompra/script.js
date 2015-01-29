$(document).ready(function(){
	$(document).on("click",".btnGuardar",function(){
		// frm 			= serializeToJson($("#tbTabla input").serializeArray());
		frmTemp = new Array();
		$(".txtFrecuencia").each(function(i,val){
			indice = String($(this).attr("name"));

			if(frmTemp[indice] == undefined && $(this).val() != ""){
				frmTemp[indice] = new Object();
				frmTemp[indice] = [frmTemp[indice]];
			}
			
			// reg = Array($(this).val(),$(this).attr("detalle"));
			reg = new Object();
			reg.frecuencia 	= $(this).val();
			reg.detalle 	= $(this).attr("detalle");
			if(reg.frecuencia != ""){
				frmTemp[indice].push(reg);	
			}
			
		});
		frm = frmTemp;
		// frm = serializeToJson(frm);
		encabezado 		= $("#tbTabla").attr("encabezado");
		frm.encabezado 	= encabezado;
		console.log("frm",frm);
		guardarOrdenCompra(frm); 
	});
});