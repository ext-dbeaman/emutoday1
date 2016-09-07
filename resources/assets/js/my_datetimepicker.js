var AllPages = function($) {

	// ---
	// add a datepicker when there are date input fields
	// ---
	if ($('.datetimepicker').length) {
		// alert('datepicker');
		require('moment');
		// require('moment-timezone');
		// require ('../../vendor/moment/moment.js');
		// require ('../../vendor/moment-timezone/moment-timezone.js');
		require ('./lib/bootstrap-datetimepicker.min.js');
		// DATETIME-picker
		$('.datetimepicker').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
			widgetPositioning : {
				horizontal: 'auto',
				vertical: 'bottom'
			}
		});

	}

}(jQuery);
