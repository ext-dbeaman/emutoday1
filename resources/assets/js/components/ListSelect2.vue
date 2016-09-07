<style>

</style>
<template>
	<div class="form-group">
		<select v-if="ismultiple" class="select2" multiple="multiple">
			<option value="-1" selected="selected">Make Selection</option>
		</select>
		<select  v-else class="select2">
			<option value="-1" selected="selected">Make Selection</option>
		</select>
	</div>
</template>

<script>
      export default  {
        components: {
				},
        props: ['ismultiple', 'ajaxurl','tags','minforsearch','placeholder','resultvalue', 'newbuilding'],

        ready() {
					// console.log('ready'+ toString(this))
					var self = this
					 console.log('vm.$el'+ this.$el)
					// var intEl = $('this.el');
					 console.log($(this.$el).next());
					 var elem = 	$(this.$el).has('.select2');

						$(elem).select2({
							placeholder: this.placeholder,
							allowClear: true,
							tags: false,
							minimumResultsForSearch: this.minforsearch,
							ajax: {
								url: this.ajaxurl,
								dataType: 'json',
								delay: 250,
								data: function (params) {
									return {
										q: params.term//, // search term
										// page: params.page
									};
								},
								processResults: function (mydata) {
										return {
											results: $.map(mydata, function (item) {
												// console.log(item.name)
												return {
													text:item.name,
													id:item.id
												}
											})
										}
									},
									cache:true
								},
								// escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      					minimumInputLength: 1
      					// templateResult: formatRepo,
								// templateSelection: formatRepoSelection
							})
								.on('change', function (ev) {
									// self.set(this.value);
									console.log(self);
									var value = $(ev.currentTarget).val();
									var text = $(ev.currentTarget).find('select option:selected').text();
									var name = $(ev.currentTarget).get();

									// elem.find('option:selected').text();
								console.log('value='+ value + '__text= '+ text + "__name= "+ name);
								// var value = $("option:selected").text()
								self.resultvalue = text;
								self.$dispatch('val-change', text);
						})
        },
        data: function() {
          return {
						// compval: $('#slct').val()
            }
        },
        methods : {
          handleEventFetch: function(eobject) {

          },
          freshPageLand: function() {

          }
        },
        events: {

        }
    }
</script>
