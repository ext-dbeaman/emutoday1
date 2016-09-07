var Vue = require('vue');
var VueDragula = require('vue-dragula');

Vue.config.debug = true;

Vue.use(VueDragula);

new Vue({
    el: '#vuedrag',
    components: {
      dragcol: require('./components/DragCol.vue')
    },
    ready() {
    	console.log(this)
		    Vue.dragcol.$on(
		      'drop',
		      function (args) {
		        console.log('drop: ' + args[0])
		        console.log(colOne)
		      }
		    )
				Vue.dragcol.$on(
		      'dropModel',
		      function (args) {
		        console.log('dropModel: ' + args[0])
		        console.log(colOne)
		      }
		    )

    }
});
