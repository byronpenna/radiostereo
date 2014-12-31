$(document).ready(function(){

		$(document).on('submit','#frmLogin',function(e){
			e.preventDefault();
			var frm= serializeToJson($(this).serializeArray());
			login(frm);
		});
});


 