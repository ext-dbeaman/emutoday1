require ('./../plugins/jquery.datetimepicker.min.js');

module.exports = {
    twoWay: true,
  priority: 1000,
    params: ['options'],
    bind: function() {
        $(this.el).datepicker();
        console.log(this.params);

    },
    update: function() {

    }
}
