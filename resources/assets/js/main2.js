import Vue from 'vue';
import VueResource from 'vue-resource';

import VueTypeaheadMixin from 'vue-typeahead'
import VueTypeaheadTemplate from './components/template.html'
Vue.use(VueResource);

Vue.component('typeahead', {
  template: VueTypeaheadTemplate,
  mixins: [VueTypeaheadMixin],
  data(){
    return {
      src: 'fetch/buildings',
      data: {},
      onHit (item) {

      }

    }
  }
});


new Vue({
    el: '#vueapp'
});
