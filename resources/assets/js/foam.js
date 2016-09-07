var Vue = require('vue');

new Vue({
    el: '#vueapp',
    components: {
      EventFoam: require('./components/EventFoam.vue')

    },
    ready() {
      alert('vue ready');
    }
});
