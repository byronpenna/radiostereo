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
		selector.fullCalendar( 'destroy' );
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
				
				var eventData;
					eventData = {
						start: start,
						//end: end,
						color: 'red'
					};
					 // stick? = true
					index = start.format('YYYY-MM-DD');
					index2 = end.format();
					console.log(index);
					console.log(index2);
					console.log("INDEXOF ",txtEvento.val().indexOf(index));
					console.log("el id del evento es:",jsEvent);
					if (txtEvento.val().indexOf(index) == -1) {
						console.log("entro if");
						contenidoEventos = validarEvento(txtEvento, start)//se llama la funcion que quita la primera coma
						txtEvento.val(contenidoEventos);//se colocala fecha en el textbox
						selector.fullCalendar('renderEvent', eventData, true);
						//console.log(contenidoEventos);
					}else{
						console.log("entro al else");
						ev = txtEvento.val();
						console.log("ev",ev);
						txtEvento.val(txtEvento.val().replace(ev,""));
					}			
			},
			eventClick: function(eventos){
   					selector.fullCalendar('removeEvents',eventos._id);
   					//txtEvento.val().empty();
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events

		});
		
		
			
	}