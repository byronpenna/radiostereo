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

function getCalendar(selector,fechaInicio,txtEvent){
		// tmpEv = selector.fullCalendar("clientEvents");
		// console.log("los eventos son: ",tmpEv);
		eventos = new Array();
		if(txtEvent.val() != ""){
			tmpEv = jQuery.parseJSON(txtEvent.val());	
			// console.log("tmp",tmpEv);
			$.each(tmpEv,function(i,val){
				eventos[i] = new Object();
				eventos[i] = {
					id: 	val,
					start: 	val,
					//end: end,
					color: 	'#2B87CD'
				};
			});
		}else{
			tmpEv = new Array();
		}
		selector.fullCalendar("destroy");
		// console.log("Eventosooooo",eventos);
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
			eventClick: function(calEvent, jsEvent, view) {
				start = calEvent.start.format('YYYY-MM-DD');
				selector.fullCalendar('removeEvents',calEvent.start);
				selector.fullCalendar('removeEvents',start);
				index = tmpEv.indexOf(start);
				tmpEv.splice(index,1);
				txtEvent.val(JSON.stringify(tmpEv));
			},
			select: function(start, end) {				
				index = start.format('YYYY-MM-DD');
				var eventData;

				eventData = {
					id: 	start,
					start: 	start,
					//end: end,
					color: 	'#2B87CD'
				};
				eventosActuales = selector.fullCalendar("clientEvents",start);
				eventosActualT 	= selector.fullCalendar("clientEvents");
				// console.log("Todos los eventos son ",eventosActualT);
				// console.log("fecha actual ",start);
				// console.log("Los eventos actuales son:",eventosActuales);
				// console.log("los eventos con index son:",selector.fullCalendar("clientEvents",index));
				fecha = start.format("YYYY-MM-DD");
				if(eventosActuales == ""){
					eventosActuales = selector.fullCalendar("clientEvents",index);
					if(eventosActuales == ""){
						selector.fullCalendar('renderEvent', eventData, true);
						tmpEv.push(fecha);		
					}else{
						selector.fullCalendar('removeEvents',index);
						index = tmpEv.indexOf(fecha);
						tmpEv.splice(index,1);
					}
				}else{
					selector.fullCalendar('removeEvents',start);
					index = tmpEv.indexOf(fecha);
					tmpEv.splice(index,1);
				}			
				txtEvent.val(JSON.stringify(tmpEv));					
			},
			// eventClick: function(eventos){
   			// 		selector.fullCalendar('removeEvents',eventos._id);

			//  },
			editable: true,
			eventLimit: true, // allow "more" link when too many events

		});
		
		
			
	}