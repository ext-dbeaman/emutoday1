<template>

    <div class="box box-default box-solid">
      <div class="box-header with-border" >
          <div class="row">
              <div class="col-sm-12">
                  <form class="form-inline pull-right">
                    <div class="form-group">
                      <label class="sr-only" for="priority-number">Priority</label>
                          <select id="priority-{{item.id}}" v-model="item.priority" class="form-control" number>
                              <option v-for="option in options" v-bind:value="option.value">
                                  {{option.text}}
                              </option>
                          </select>
                    </div>
                    <div class="form-group">
                            <label>approved:</label>
                        </div><!-- /.form-group -->
                       <div class="form-group">
                            <vui-flip-switch id="switch-{{item.id}}"
                                v-on:click="doThis"
                                :value="isApproved" >
                            </vui-flip-switch>
                        </div>
                    </form>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
          <div class="row">
            <a v-on:click.prevent="toggleBody" href="#">
              <div class="col-sm-12">
                  <h6 class="box-title">{{item.title}}</h6>
              </div><!-- /.col-md-12 -->
            </a>
          </div><!-- /.row -->

      </div>  <!-- /.box-header -->


        <div v-if="showBody" class="box-body">
                        <p>{{item.announcement}}</p>
                        <div class="announcement-info">
                            Submitted On: {{item.submission_date}}</br>
                            By: {{item.user_name}}</br>
                            {{item.user_email}} {{item.user_phone}}</br>
                            Dates: {{item.start_date}} - {{item.end_date}}

                        </div>

      </div><!-- /.box-body -->
      <div class="box-footer list-footer">
          <div class="row">
              <div class="col-sm-7">
                  <h5>Live {{timefromNow}}</h5>
              </div><!-- /.col-md-7 -->
              <div class="col-sm-5">
                  <div class="btn-group pull-right">
                          <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-pencil"></i></button>
                          <!-- <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-eye"></i></button> -->
                  </div><!-- /.btn-toolbar -->

              </div><!-- /.col-md-7 -->
          </div><!-- /.row -->
      </div><!-- /.box-footer -->
  </div><!-- /.box- -->
</template>
<style scoped>
.box {
    color: #1B1B1B;
    margin-bottom: 10px;
}
.box-body {
    background-color: #fff;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    margin:0;
}

.box-header {
    padding: 3px;
}

button.footer-btn {
    border-color: #1B1B1B;

}

h5.box-footer {
    padding: 3px;
}
button.footer-btn {
    border-color: #1B1B1B;

}
h6.box-title {
    color: #1B1B1B;
}
.emutoday {

    background-color: #76D7EA;
    border: 1px solid #76D7EA
}
.student {
    color: #1B1B1B;
    background-color: #FED85D;
    border: 1px solid #FED85D
}
.external  {
    color: #1B1B1B;
    background-color: #cccccc;
    border: 1px solid #cccccc;
}
.news  {
    color: #1B1B1B;
    background-color: #C9A0DC;
    border: 1px solid #C9A0DC;
}
.article  {
    color: #1B1B1B;
    background-color: #29AB87;
    border: 1px solid #29AB87;
}
.item-type-icon {
    color: #1B1B1B;
    /*position:absolute;
    top: 5px;
    left: 5px;*/

}
.zcallout {
    border-radius: 5px;
    /*margin: 0 0 20px 0;*/
    /*padding: 15px 30px 15px 15px;*/
    border-left: 50px solid #ff0000;
}

.onoffswitch {
    position: relative; width: 60px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 50px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 18px; padding: 0; line-height: 18px;
    font-size: 11px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "YES";
    padding-left: 10px;
    background-color: #605CA8; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "NO";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 22px; margin: 0px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 38px;
    border: 2px solid #999999; border-radius: 50px;
    transition: all 0.3s ease-in 0s;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px;
}

select.form-control {
    height:22px;
    border: 1px solid #999999;
}
h6 {
    margin-top: 0;
    margin-bottom: 0;
}
h5 {
    margin-top: 0;
    margin-bottom: 0;
}
.form-group {
    /*border: 1px solid red;*/
}
.form-group label{
    margin-bottom: 0;
}

.box-footer {
    padding-top: 4px;
    padding-bottom: 4px;

}
.box.box-solid.box-default {
    border: 1px solid #999999;
}
</style>
<script>

import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

module.exports  = {
                props: [
                    'item',
                    'pid'
                ],
              data: function() {
                return {
                        options: [
                            { text: '0', value: 0 },
                             { text: '1', value: 1 },
                             { text: '2', value: 2 },
                            { text: '3', value: 3 },
                             { text: '4', value: 4 },
                             { text: '5', value: 5 },
                            { text: '6', value: 6 },
                            { text: '7', value: 7 },
                            { text: '8', value: 8 },
                            { text: '9', value: 9 },
                            { text: '10', value: 10 },
                            { text: '99', value: 99 }
                        ],
                        showBody: false,
                        currentDate: {},
                        record: {
                            user_id : '',
                            title: '',
                            announcement: '',
                            start_date: ''
                        }
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
                  timefromNow:function() {
                      return moment(this.item.start_date).fromNow()
                  },
                  isApproved: function() {
                      return this.item.is_approved;
                  },
                  itemEditPath: function(){
                      return '/admin/announcement/'+ this.item.id + '/edit'
                  },
                  itemPreviewPath: function(){
                      return '/preview/story/'+ this.item.id
                  },

              },
              methods: {
                  editItem: function(ev) {


                      window.location.href = this.itemEditPath;
                  },
                  previewItem: function(ev) {
                      window.location.href = this.itemPreviewPath;
                  },
                    toggleBody: function(ev) {
                        if(this.showBody == false) {
                            this.showBody = true;
                        } else {
                            this.showBody = false;
                        }
                        console.log('toggleBody' + this.showBody)
                    },
                    doThis: function(ev) {
                        this.$emit('item-change',this.item);
                        console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
                    }

                },
                watch: {
                    'isapproved': function(val, oldVal) {
                        if (val !=  oldVal) {
                            console.log('val change')
                        }
                    }
                },
                directives: {
                        // mydatedropper: require('../directives/mydatedropper.js')
                        // dtpicker: require('../directives/dtpicker.js')
                },
                components: {
                    VuiFlipSwitch

                        // listselect2: require('./ListSelect2.vue')
                        // autocomplete: require('./vue-autocomplete.vue'),
                    // 'datepicker': require('../vendor/datepicker.vue'),

                },
                filters: {
                        momentPretty: {
                            read: function(val) {
                                    console.log('read-val'+ val )

                                return 	val ?  moment(val).format('MM-DD-YYYY') : '';
                            },
                            write: function(val, oldVal) {
                                console.log('write-val'+ val + '--'+ oldVal)

                                return moment(val).format('YYYY-MM-DD');
                            }
                        }
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
