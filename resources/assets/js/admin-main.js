window.$ = window.jQuery = require('jquery')
require('bootstrap-sass');
require ('moment');
import datetimepicker from 'eonasdan-bootstrap-datetimepicker-npm';

// require ('onasdan-bootstrap-datetimepicker-npm');

// import AllPages from './my_datetimepicker';

$( document ).ready(function() {
    console.log($.fn.tooltip.Constructor.VERSION);
});

if ($('.datetimepicker').length) {
	// require('moment');
	// require('bootstrap-datetimepicker-build');
	//
	// require('moment');
	// require('eonasdan-bootstrap-datetimepicker-npm');
	// DATETIME-picker
	$('.datetimepicker').datetimepicker();
	// $('.datetimepicker').datetimepicker({
	// 	format: 'YYYY-MM-DD HH:mm:ss'
	// });
}(jQuery);
