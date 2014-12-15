$(document).ready(function(){
		$(document).on('submit','#frmLogout',function(e){
			e.preventDefault();
			var frmlout= serializeToJson($(this).serializeArray());
			console.log(frmlout);
			logOut(frmlout);
		});
});