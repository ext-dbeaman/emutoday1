var moment = require('moment')
// require('../plugins/bootstrap-datetimepicker.min.js');
module.exports = {
	twoWay: true,
  priority: 1000,

  params: ['ddate'],
	bind: function() {
		 var self = this
		// $(this.el).datetimepicker();
		var dtpicker = $(this.el);
		dtpicker.fdatepicker({
			format: 'mm-dd-yyyy',
			onRender: function (date) {
				// console.log('onRender' + date.valueOf())
				// if (self.params.ddate === undefined) {
				// 	return 'disabled';
				//
				// } else {
				// 		return date.valueOf() < self.params.ddate ? 'disabled' : '';
				//
				// }

			}
		}).on('changeDate', function (ev) {
			// console.log('changeDate.ev.target' + ev.date);
			if (self.params.ddate === undefined) {
				return 'disabled';
			} else {
				var gooddate = moment(self.params.ddate);
				console.log('changeDate.ev.target' + moment(ev.date)  + 'ddate=' + gooddate );
				if (moment(ev.date) < gooddate) {
					console.log('invalid date' + moment(gooddate).format('MM-DD-YYYY') );
					  $(this.el).val(moment(gooddate).format('MM-DD-YYYY'))
				} else {
						console.log('valid date' + moment(ev.date).format('MM-DD-YYYY') )
				}
					// return moment(ev.date) < gooddate ? dtpicker.update(gooddate) : dtpicker.update(moment(ev.date));

			}
		}).data('datepicker');

		// $(this.el).datetimepicker({
		// 		format:'Y/m/d H:i'
		// 	})
  },
	update: function(value) {
		 $(this.el).val(value).trigger('change')
  },
  unbind: function() {
		// $(this.el).off().select2('destroy')
  }
}
