function serializeToJson(a){//convierte el form a un objeto jason
		var o = {};
		$.each(a, function() {
		   if (o[this.name]) {
		       if (!o[this.name].push) {
		           o[this.name] = [o[this.name]];
		       }
		       o[this.name].push(this.value || '');
		   } else {
		       o[this.name] = this.value || '';
		   }
		});
		return o;
	}
function agregarPrograma(frm){
	$.ajax({
		data:{
			form: JSON.stringify(frm)//convierte el objeto jason a string
		},
		url: <?php echo "'".URLLOCAL."catalogosc/catalogosc/insert_programa"."'" ?>,
		type: 		"POST",
		success: 	function(datos){
			alert(datos);//muestra el mensaje
			//console.log(datos);
		}
	});
}