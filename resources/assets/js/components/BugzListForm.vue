<template>

		<div class="box-body" v-bind:class="calloutLevel">




				<div class="row border-between">
						<!-- <a v-on:click="toggleBody" href="#"> -->
					<div class="col-md-1">
						<div class="form-group">
							<label class="sr-only" for="select-type">Priority</label>
							<select id="type-{{item.id}}" v-model="item.type" v-on:change="inputChange" class="form-control">
								<option v-for="type in types" v-bind:value="type.value">
									{{type.text}}
								</option>
							</select>
						</div>
					</div><!-- /.col-md-4-->
					<div class="col-md-1">
						<div class="form-group">
					    <label class="sr-only" for="priority-number">Priority</label>
							<select id="priority-{{item.id}}" v-on:change="inputChange" v-model="item.priority" class="form-control" number>
								<option v-for="option in options" v-bind:value="option.value">
									{{option.text}}
								</option>
							</select>
					  </div>
					</div><!-- /.col-md-4-->
					<div class="col-md-4">
						<textarea v-model="item.notes" v-on:change="textareaChange"></textarea>

					</div><!-- /.col-md-4-->
					<div class="col-md-4">
						<textarea v-model="item.reply" v-on:change="textareaChange"></textarea>
					</div><!-- /.col-md-4-->
					<div class="col-md-2 form-inline">
								<div class="form-group pull-left">
										<button v-if="modelChanged"  v-on:click.prevent="saveItem" class="btn btn-primary"><i class="fa fa-floppy-o"></i></button>
										<button v-else class="btn btn-primary btn-sm" disabled="disabled"><i class="fa fa-floppy-o"></i></button>
										<button v-if="modelChanged" class="btn btn-primary btn-sm" disabled="disabled"><i class="fa fa-trash"></i></button>
										<button v-else v-on:click.prevent="removeItem" class="btn btn-primary"><i class="fa fa-trash"></i></button>
								</div><!-- /.btn-toolbar -->
									<div class="form-group pull-right">
										<div class="onoffswitch">
											<input id="smitch-{{item.id}}" v-on:click="completeItem" v-model="item.complete"  type="checkbox" name="onoffswitch" class="onoffswitch-checkbox">

											<label class="onoffswitch-label" for="smitch-{{item.id}}">
												<span class="onoffswitch-inner"></span>
												<span class="onoffswitch-switch"></span>
											</label>
										</div>
									</div><!-- /.btn-group btn-sm -->
								</div><!-- /.col-md-6 -->
			</div><!-- /.row -->

		</div><!-- /.box-body -->


</template>
<style scoped>
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
.form-group {
	/*border: 1px solid red;*/
}
.form-group label{
	margin-bottom: 0;
}
.box-body {
	padding-top: 4px;
	padding-bottom: 6px;
}
.border-between > [class*='col-']:before {
 background: #999999;
 bottom: 0;
 content: " ";
 left: 0;
 position: absolute;
 width: 2px;
 top: 0;
}
.border-between > [class*='col-']:first-child:before {
 display: none;
}
.box.box-solid.box-default {
	border: 1px solid #999999;
}
textarea {
	color: #000000;
	resize: vertical;
	width: 100%;
}
</style>
<script>
var moment = require('moment')

module.exports  = {
				props: [
					'item',
					'pid'
				],
			  data: function() {
			    return {
						inputChanged: false,
						modelChanged: false,
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
						types: [
							{ text: 'bug', value: 'bug' },
							{ text: 'dsgn', value: 'design' },
							{ text: 'cmmnt', value: 'comment' },
							{ text: 'other', value: 'other' }
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
					calloutLevel: function(){
						var level
						if (this.item.priority > 10) {
							level = 'bg-maroon'
						} else {
							if (this.item.priority > 7 && this.item.priority <= 10 ) {
								level = 'bg-red'
							} else if (this.item.priority > 4 && this.item.priority <= 7) {
								level = 'bg-orange'
							} else if (this.item.priority > 0 && this.item.priority <= 4) {
								level = 'bg-yellow'
							} else {
								level = ''
							}
					}

					return  level;
				}

			  },
			  methods: {
					textareaChange: function(ev){
						console.log('textareaChange='+ ev.target)
						this.modelChanged = true;
					},
					inputChange: function(ev){
						console.log('inputChange='+ ev.target)
						this.modelChanged = true;
					},

					completeItem: function(ev) {
						this.item.complete = 1;
						this.$emit('item-change','completeItem',this.item);
						console.log('ev ' + ev + 'this.item.id= '+  this.item)
					},
					saveItem: function(ev) {
						this.$emit('item-change','saveItem',this.item);
						console.log('item-change ' + ev + 'this.item.id= '+  this.item)
					},
					removeItem: function(ev) {
						this.$emit('item-change','removeItem',this.item);
						console.log('item-change ' + ev + 'this.item.id= '+  this.item)
					}

				},
				watch: {
					// 'isapproved': function(val, oldVal) {
					// 	if (val !=  oldVal) {
					// 		console.log('val change')
					// 	}
					// }
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
						// momentPretty: {
						// 	read: function(val) {
						// 			console.log('read-val'+ val )
						//
						// 		return 	val ?  moment(val).format('MM-DD-YYYY') : '';
						// 	},
						// 	write: function(val, oldVal) {
						// 		console.log('write-val'+ val + '--'+ oldVal)
						//
						// 		return moment(val).format('YYYY-MM-DD');
						// 	}
						// }
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
