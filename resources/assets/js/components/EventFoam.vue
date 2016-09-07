<style>
.my-foam h2 {
	color: red;
}
</style>
<template>
	<div class="my-foam">
		<h2>{{msg}}</h2>
	</div>
</template>
<script>
    module.exports = {
			data: function () {
				return{
					msg: 'fffffffoammmmeeee'
				}
			},
      created() {
            alert('EVENT FOAM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');
      }
    }
</script>
