// byron 
	function putEvents(eventos){
		eventosCalendar = new Array();
		$.each(eventos,function(i,val){//construyo el arreglo de objetos
			eventosCalendar[i] = new Object();
			//eventosCalendar[i].title = "hola";
			eventosCalendar[i].start = val;
			eventosCalendar[i].overlap= false;
			eventosCalendar[i].color = "#2B87CD";
		});
		return eventosCalendar;
	}
// ######
function validarEvento (txtEvento,start,end) {//validar coma
	
	if(txtEvento.val() == ""){
		contenidoEventos = start.format('YYYY-MM-DD');
	}else{
		contenidoEventos = txtEvento.val() + ","+ start.format('YYYY-MM-DD');	
		// fechafin - fechainicio || 01/01/2015 , 14/01/2015
		// 13
		// for(i=0;i<13;i++)
		// arregloFechas[i] = fechainicio += 1
	}
	return contenidoEventos;
}
function alguito () {
	// body...
}

function getCalendar(selector,fechaInicio,eventos,txtEvento){
		selector.fullCalendar("destroy");
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
			//,allday,jsEvent
			select: function(start, end) {
				index = start.format('YYYY-MM-DD');
				var eventData;
				eventData = {
					start: start,
					//end: end,
					color: '#2B87CD'
				};
				if (txtEvento.val().indexOf(index) == -1) { // no existe evento
					contenidoEventos = validarEvento(txtEvento, start);
					txtEvento.val(contenidoEventos);
					selector.fullCalendar('renderEvent', eventData, true);
				}else{
					ev = index;
					console.log("valor con ',' es: ",txtEvento.val().indexOf(","+index));
					if(txtEvento.val().indexOf(","+index) != -1){
						console.log("reemplazo aqui");
						txtEvento.val(txtEvento.val().replace(","+ev,""));	
					}else{
						txtEvento.val(txtEvento.val().replace(ev,""));	
					}
					
				}
				 //selector.fullCalendar( 'removeEvents' );
				eventosActudales = txtEvento.val().split(",");
				var eventosCalendar;
				if (eventosActudales.indexOf(index) != -1) {//con este if se quita la lentitud de los eventos al hacer click en el dia
					selector.fullCalendar( 'removeEvents' );
					if(txtEvento.val() != ""){
					eventosCalendar = putEvents(eventosActudales);
					$.each(eventosCalendar,function(i,val){
						selector.fullCalendar('renderEvent', val, true);
					});
				}else{
					eventosCalendar = null;
				}
				}else{
					console.log("fecha ingresada: ",index);	
				}
				
				
				
				// console.log("fecha ingresada: ",index);	
							
			},
			// eventClick: function(eventos){
   			// 		selector.fullCalendar('removeEvents',eventos._id);

			//  },
			editable: true,
			eventLimit: true, // allow "more" link when too many events

		});
		
		
			
	}