$(document).ready(function(){
	$(document).on("click",".btnGuardar",function(){
		// frm 			= serializeToJson($("#tbTabla input").serializeArray());
		frmTemp = new Array();
		cn 		= 0;
		$(".txtFrecuencia").each(function(i,val){
			indice = String($(this).attr("name"));

			
			
			// reg = Array($(this).val(),$(this).attr("detalle"));
			reg = new Object();
			reg.frecuencia 	= $(this).val();
			reg.detalle 	= $(this).attr("detalle");
			reg.fecha 		= indice;
			if(reg.frecuencia != ""){
				frmTemp.push(reg);	
				cn++;
			}
			
		});
		frm = frmTemp;
		// frm = serializeToJson(frm);
		encabezado 		= $("#tbTabla").attr("encabezado");
		frm.encabezado 	= encabezado;
		console.log("frm",frm);
		// guardarOrdenCompra(frm); 
	});
});