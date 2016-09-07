var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import moment from 'moment';
import StoryApp from './components/StoryApp.vue';

new Vue({
    el: '#vue-story-app',
    components: {
      StoryApp
    },
        http: {
                headers: {
                        // You could also store your token in a global object,
                        // and reference it here. APP.token
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
        },
    ready() {
      console.log('new Vue StoryApp ready');
    }
});
