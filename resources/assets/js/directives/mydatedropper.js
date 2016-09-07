module.exports = {
	twoWay: true,
  priority: 1000,
	params: ['options'],
	bind: function() {
		$(this.el).dateDropper();
		console.log(this.params);

	},
	update: function() {
		
	}
}
