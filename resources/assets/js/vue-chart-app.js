var Vue = require('vue');
import VueResource from 'vue-resource';
Vue.use(VueResource);
var VueCharts = require('vue-charts')
Vue.use(VueCharts);
import PageChartApp from './components/PageChartApp.vue'
new Vue({
    el: '#vue-chart-app',
    components: {
      PageChartApp
  },
    ready() {
      console.log('vue ready');
    }
});
