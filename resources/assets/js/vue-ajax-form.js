var Vue = require('vue');
import VueResource from 'vue-resource';
Vue.use(VueResource);

new Vue({
    el: '.hasajax',
		directives:{
				myajax: require('./directives/myajax.js')
		},
    http: {
        headers: {
            // You could also store your token in a global object,
            // and reference it here. APP.token
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    }
});
