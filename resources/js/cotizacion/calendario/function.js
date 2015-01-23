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
		if(txtEvent.val() != ""){
			tmpEv = jQuery.parseJSON(txtEvent.val());	
		}else{
			tmpEv = new Array();
		}
		
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
			events: tmpEv,
			//,allday,jsEvent
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
				if(eventosActuales == ""){
					selector.fullCalendar('renderEvent', eventData, true);
						
				}else{
					selector.fullCalendar('removeEvents',start);
				}		
				fecha = start.format("YYYY-MM-DD");
				index = tmpEv.indexOf(fecha);
				if(index){
					tmpEv.push(fecha);	
				}else{
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