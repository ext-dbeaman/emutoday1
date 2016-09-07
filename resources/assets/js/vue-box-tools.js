var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

var moment = require('moment');

let vm = new Vue({
    el: '#vue-box-tools',
    components: {
      BoxTools: require('./components/BoxTools.vue')
    },
        http: {
                headers: {
                        // You could also store your token in a global object,
                        // and reference it here. APP.token
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
        },
        data:{
            isdirty: 0

        },
        methods: {
            changeDirtyState:function(value){

                this.$refs.boxtools.isdirty = value;
            }
        },
    ready() {
      console.log('new Vue BoxTools ready');
    }
});
export default vm;
