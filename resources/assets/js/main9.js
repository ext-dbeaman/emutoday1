global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;
// load everything from jquery-ui

require('bootstrap');
var Vue = require('vue');


Vue.config.debug = true;

var vm = new Vue({
  el: '#vuedatetimepicker',
  components: { DateTimeExample },
});


// window.$ = window.jQuery = require('jquery');
// require('bootstrap');
//
// var moment = require('moment');
// var Vue = require('vue');
//
// import DateTimeExample from './components/DateTimeExample.vue';
//
// new Vue({
//     el: '#vuedatetimepicker',
//
//     components: {
//       DateTimeExample
//     },
//
//     ready() {
//        alert('vue ready');
//     }
// });
