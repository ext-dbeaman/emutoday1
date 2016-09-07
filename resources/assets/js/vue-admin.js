// import jquery
var $ = require('jquery');

// assign to window object
window.jQuery = window.$ = $;

// only now, require bootstrap
require('bootstrap');

// require plugins
// require('./libs/jquery.upgrade-columns.js');
//
require ('moment');
require ('moment-timezone');
// import 'bootstrap-datetimepicker-build';
require ('./lib/bootstrap-datetimepicker.min.js');
var Vue = require("vue");
Vue.config.devtools = true;
Vue.config.debug = true;
 var vm = new Vue({
   el: "#app",
   components: {
     "demo": require("./components/demo.vue")
   },
   data: function() {
     return {
       result1: null,
       startDatetime: moment(),
       endDatetime: null
     };
   }
 });
