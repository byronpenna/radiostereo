$(document).ready(function(){
	var f = new Date();
	console.log(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
	$("#fechaCreacion").val(f.getFullYear()+"-"+(f.getMonth() +1) + "-" + f.getDate());
});


//Esta funcion sirve para obtener la base de la url para poder redirigir de una manera mas eficiente
function getBaseURL() {
	var url = location.href;  // entire url including querystring - also: window.location.href;
	var baseURL = url.substring(0, url.indexOf('/', 14));


	if (baseURL.indexOf('http://localhost') != -1) {
	    // Base Url for localhost
	    var url = location.href;  // window.location.href;
	    var pathname = location.pathname;  // window.location.pathname;
	    var index1 = url.indexOf(pathname);
	    var index2 = url.indexOf("/", index1 + 1);
	    var baseLocalUrl = url.substr(0, index2);

	    return baseLocalUrl + "/";
	}
	else {
	    // Root Url for domain name
	    return baseURL + "/";
	}
}

//Funcion Para Matar la sesion 
function logOut(frm){
	console.log("la url es: ",getBaseURL());
	$.ajax({
         data:{
           form: JSON.stringify(frm)
         },
         url:  getBaseURL()+"index.php/welcome/logOut",
         type:   "POST",
         success: function(data){
           var datos = jQuery.parseJSON(data);
           window.location=getBaseURL()+"index.php/welcome";
         }
     });
}





//keypress
			$(document).on("keypress",".soloNumeros",function(e){//evento para validar si es un numero
				exp 					= /[0-9 \.]/; // expresion regular y buscar codigo asccii
				ascciiCaracterIngresado = e.which;//which obtiene el codigo ascii del el evento keypress
				caracter 				= String.fromCharCode(ascciiCaracterIngresado); //obtenemos el caracter ingresado
				el 						= $(this).val();
				if(exp.test(caracter)){
					if(el.indexOf('.')!=-1){
						if(caracter=="."){
							e.preventDefault();//evitamos que se ejecute la accion
						}
					}
				}else{
					e.preventDefault();//evitamos que se ejecute la accion
				}
			});


//Evento para evitar copiar,pegar y cortar dentro de un TextBox
		
		 $('*').bind("cut copy paste",function(e) {
      		e.preventDefault();
    	});








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