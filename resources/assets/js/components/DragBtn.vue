<template>

    <tr>
        <td>
            {{item.id}}
        </td>
    </tr>





</template>
<style scoped>
.sqbtn {

  width: 40px;
  height: 40px;
  text-align: center;
  line-height: 16px;
  font-size: 16px;
  color: white;
  /*border-radius:10px;*/
  border: 1px solid black;
  background-color: grey;
}

</style>
<script>
module.exports  = {
                props: [
                    'item',
                    'pid'
                ],
              data: function() {
                return {

                }
              },
                created: function () {
                    // this.currentDate = moment();
                    // console.log('this.currentDate=' + this.currentDate)
                },
                ready: function() {
                    //ready function
                },
              computed: {


              },
              methods: {

                },
                watch: {

                },
                directives: {
                        // mydatedropper: require('../directives/mydatedropper.js')
                        // dtpicker: require('../directives/dtpicker.js')
                },
                components: {
                        // listselect2: require('./ListSelect2.vue')
                        // autocomplete: require('./vue-autocomplete.vue'),
                    // 'datepicker': require('../vendor/datepicker.vue'),

                },
                filters: {

                    },
                    events: {

                    // 'building-change':function(name) {
                    // 	this.newbuilding = '';
                    // 	this.newbuilding = name;
                    // 	console.log(this.newbuilding);
                    // },
                    // 'categories-change':function(list) {
                    // 	this.categories = '';
                    // 	this.categories = list;
                    // 	console.log(this.categories);
                    // }
                }
            };


</script>
