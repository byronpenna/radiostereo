$(document).ready(function(){

		$(document).on('submit','#frmLogin',function(e){
			 e.preventDefault();
			var frm= serializeToJson($(this).serializeArray());
			//console.log(frm);
			login(frm);
		});

		$(document).on('submit','#frmLogout',function(e){
			e.preventDefault();
			var frmlout= serializeToJson($(this).serializeArray());
			console.log(frmlout);
			logOut(frmlout);
		});
});


 