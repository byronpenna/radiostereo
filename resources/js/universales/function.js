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