var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);


// import Validator from 'easiest-js-validator';
// Vue.http.headers.common['X_CSRF-TOKEN'] = document.querySelector('input[name="_token"]').value;
// var vueForm = require('vue-form');
// Vue.use(vueForm);
//
// var autocomplete = require('./components/vue-autocomplete.vue')
//
//
// Vue.component('autocomplete', autocomplete)
import EventFormUniversal from './components/EventFormUniversal.vue'
new Vue({
    el: '#vue-event-form',
    components: {EventForm:EventFormUniversal},
    ready() {
      console.log('vue ready');
    }
});
