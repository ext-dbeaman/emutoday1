var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

let moment = require('moment');

let vm = new Vue({
    el: '#vue-form-wrapper',
    components: {
      BoxTools: require('./components/BoxTools.vue')
    },
    directives:{
            myrte: require('./directives/ckrte.js')
    },
        http: {
                headers: {
                        // You could also store your token in a global object,
                        // and reference it here. APP.token
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
        },
        data:{
            content: '',
            isnotdirty: true,
            isdirty: 0,
            obj: {}

        },
        events:{
            'makedirty': function(value) {
                console.log('this.isnotdirty = '+ value)
                this.isnotdirty = value;
            }
        },
        methods: {

        },
    ready() {
      console.log('new Vue Form Tool ready');

    }
});

// var obj = {}
// ;(function() {
//     window.obj.fn = function (arg) { ... }
// })()
