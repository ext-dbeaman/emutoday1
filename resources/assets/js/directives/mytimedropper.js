module.exports = {
	twoWay: true,
  priority: 1000,
	params: ['options'],
	bind: function() {
		$(this.el).timeDropper();
		console.log(this.params);

	},
	update: function() {
		// alert('update');
	}
}
