// byron 
	function putEvents(eventos){
		eventosCalendar = new Array();
		$.each(eventos,function(i,val){//construyo el arreglo de objetos
			eventosCalendar[i] = new Object();
			//eventosCalendar[i].title = null;
			eventosCalendar[i].start = val;
			eventosCalendar[i].overlap= false;
			eventosCalendar[i].color = "red";
		});
		return eventosCalendar;
	}
// ######
function validarEvento (txtEvento,start,end) {//validar coma
	
	if(txtEvento.val() == ""){
		contenidoEventos = start.format('YYYY-MM-DD');
	}else{

		contenidoEventos = txtEvento.val() +" , "+ start.format('YYYY-MM-DD');	
		// fechafin - fechainicio || 01/01/2015 , 14/01/2015
		// 13
		// for(i=0;i<13;i++)
		// arregloFechas[i] = fechainicio += 1
	}
	return contenidoEventos;
}

function getCalendar(selector,fechaInicio,eventos,txtEvento){
		
		selector.fullCalendar({
			windowResize: function(view) {
	    		
			},
			editable: true,
			contentHeight: 260,
			theme: true,
			lang: 'es',
			dayNamesShort: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
			header: {
				left: 'prev,next today',
				center: 'title',
				month: false,
				right: false
			},
			defaultDate: fechaInicio,
			selectable: true,
			selectHelper: true,
			events: eventos,
			
			select: function(start, end,allday,jsEvent) {
				// console.log($(this).parents(".cuerpo").find(".txtEvents").val());
				index = start.format('YYYY-MM-DD');
				index2 = end.format();
				var eventData;
				eventData = {
					title: 'hola',
					start: start,
					//end: end,

					color: 'red'
				};
				if (txtEvento.val().indexOf(index) == -1) {
					contenidoEventos = validarEvento(txtEvento, start)//se llama la funcion que quita la primera coma
					txtEvento.val(contenidoEventos);//se colocala fecha en el textbox
					selector.fullCalendar('renderEvent', eventData, true);
					//console.log(contenidoEventos);
				}else{
					ev = index;
					txtEvento.val(txtEvento.val().replace(ev,""));
				}
				selector.fullCalendar( 'removeEvents' );
				eventosActudales = $(".txtEvents").val().split(",");
				var eventosCalendar;
				if($(".txtEvents").val() != ""){
					eventosCalendar = putEvents(eventosActudales);
					$.each(eventosCalendar,function(i,val){
						console.log("el valor es:",val);
						selector.fullCalendar('renderEvent', val, true);
					});
				}else{
					eventosCalendar = null;
				}
				
				
				console.log("fecha ingresada: ",index);	
							
			},
			eventClick: function(eventos){
   					selector.fullCalendar('removeEvents',eventos._id);
   					//txtEvento.val().empty();
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events

		});
		
		
			
	}