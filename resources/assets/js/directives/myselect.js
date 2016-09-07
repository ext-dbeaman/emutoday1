
module.exports = {
	twoWay: true,
  priority: 1000,

  params: ['ajaxurl','resultvalue'],
	paramWatchers: {
	resultvalue: function (val, oldVal) {
		console.log('val=' + val + ' oldVal' + oldVal)

		$(this.el).val([val]).trigger('change');

	}
},
	bind: function(value) {
		this.handler = function() {
				var svalues = $(this.el).select2('val');
			console.log('this.handler= '+ svalues)
			// var svalues3 = $(this).select2('val')
			this.set(this.el.value = svalues)

			// console.log('this.svalues3= '+ svalues3)
			// this.set(svalues3)
		}.bind(this)
		$(this.el).on('select2:close', this.handler)
		console.log('value='+ value)
		var self = this
		$(this.el)
			.select2({
				ajax: {
					url: this.params.ajaxurl,
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term//, // search term
							// page: params.page
						};
					},
					processResults: function (data) {
							return {
								results: $.map(data, function (item) {
									return {
										text: item.name || item.category,
										id:   item.name || item.id
									}
								})
							}
						}
					}
				})
					.on('change', function (ev) {
						var mydom = this;
						// console.log($(mydom).);
						var selectedValues = $(this).select2('val');
						console.log('selectedvalues= ' + selectedValues)
						// console.log($(ev));
						// self.params.items = selectedValues;
						// self.params.resultvalue = selectedValues;
						// console.log("this.el=" + $(this).text())
			 		self.set($(this).val())
			})
				console.log('after init =' + this.params.resultvalue)
				// self.set($(this).val())
			// if(this.params.resultvalue){
			// 		$(this.el).val(this.params.resultvalue).trigger('change')
			// }

  },
	update: function(value) {
		$(this.el).val(value).trigger('change');
		// $(this.el)
		// 	.on("select2:close", function(e) {
		// 		var svalues = $(this).select2('val');
		// 		console.log('svalues='+ svalues);
		//
		// 	}).bind(this);
  },
  unbind: function() {
		$(this.el).off('select2:close', this.handler)
		$(this.el).off().select2('destroy')
  }
}
