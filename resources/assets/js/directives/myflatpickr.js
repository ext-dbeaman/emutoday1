import flatpickr from 'flatpickr';

module.exports = {
    twoWay: true,
    priority: 1000,
    params: ['options', 'datevalue'],
    bind: function() {
        // $(this.el).flatpickr();
        console.log(this.params);
        var self = this;
        $(this.el).flatpickr({
                minDate: "today",
                enableTime: false,
                altFormat: "m-d-Y",
                altInput: true,
                altInputClass:"form-control",
                dateFormat: "Y-m-d",
                onChange(dateObject, dateString) {
                    self.$vm.updateRecord('dirty');
                    self.params.datevalue = dateString;
                    // self.record.start_date = dateString;
                    self.startdatePicker.value = dateString;
                }

            });
    },
    update: function (value) {
     $(this.el).val(value).trigger('change')
    //   if (!CKEDITOR.instances[this.el.id])
    //       return this.vm.$nextTick(this.update.bind(this, value));
    //   CKEDITOR.instances[this.el.id].setData(value);
    },
    unbind: function () {
   // CKEDITOR.instances[this.el.id].destroy();
      $(this.el).off().select2('destroy')
    }
}
