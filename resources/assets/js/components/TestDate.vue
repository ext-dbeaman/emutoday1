<template>
	<p>
		Pick A Date Time
	</p>
		<input id="dateinput" v-dtpicker="selected" type="text" >
</template>

<script>
    export default {
      props: '',
			data: function() {
          return {
						selected: 0,
          }
        },
        created() {
					console.log('test-dtpicker')
        },
        directives: {
					dtpicker: require('../directives/dtpicker.js')
        }
      };
</script>

<style>

</style>
