function login(frm){
	console.log("entro");
	$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  "welcome/login",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           console.log(datos.mensaje);
         }
     });
}


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