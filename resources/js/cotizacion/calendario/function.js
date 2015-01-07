function getCalendar(selector,fechaInicio){
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
			select: function(start, end) {
				//var title = prompt('Ingrese el titulo de evento:');
				var date = new Date();
				var title = start.format();
				console.log("title",title);
				var eventData;
				//if (title) {
					eventData = {
						title: title,
						start: start,
						//end: end,
						rendering: 'background',
						color: 'red'
					};
					selector.fullCalendar('renderEvent', eventData, true); // stick? = true
					var fechas = new Array();
					console.log("Ingresada: ",start.format());
					//selector.fullCalendar('unselect');
				//} 
					console.log(start.format('YYYY-MM-DD'));

			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events

		});
	}