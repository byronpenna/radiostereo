function serializeToJson(a){
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
			form: JSON.stringify(frm)
		}
		url: <?php echo URLLOCAL."catalogosc/catalogosc/insert_programa" ?>,
		type: 		"POST",
		success: 	function(datos){
			console.log(datos);
		}
	});
}