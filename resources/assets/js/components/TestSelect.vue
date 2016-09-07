<template>
	<div id="el">
  <p>Selected: {{selected}}</p>
  <select v-myselect="selected" :options="options">
    <option value="0">default</option>
  </select>
</div>

</template>

<script>
    export default {
      props: '',
			data: function() {
          return {
						selected: 0,
						options: [
							{ id: 1, text: 'hello' },
							{ id: 2, text: 'what' }
						]
          }
        },
        created() {
					console.log('test-select')
        },
        directives: {
					myselect: require('../directives/myselect.js')
        }
      };
</script>

<style>

</style>
