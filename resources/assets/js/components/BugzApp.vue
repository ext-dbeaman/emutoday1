<template>
    <div class="row">
            <div class="col-md-12">
            <h3>Bugz</h3>

                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                            <div class="row border-between">
                                    <!-- <a v-on:click="toggleBody" href="#"> -->
                                <div class="col-md-1">
                                    <h4 class="box-title">type</h4>
                                </div><!-- /.col-md-4-->
                                <div class="col-md-1">
                                    <h4 class="box-title">lvl</h4>
                                </div><!-- /.col-md-4-->
                                <div class="col-md-4">
                                    <h4 class="box-title">note</h4>
                                </div><!-- /.col-md-4-->
                                <div class="col-md-4">
                                    <h4 class="box-title">reply</h4>
                                </div><!-- /.col-md-4-->
                                <div class="col-md-2">
                                    <h4 class="box-title pull-left">edit</h4>

                                    <h4 class="box-title pull-right">done</h4>
                                </div><!-- /.col-md-2 -->
                        </div><!-- /.row -->
                  </div>  <!-- /.box-header -->
                <div id="items-bugz">
                    <bugz-list-form
                    pid="items-list"
                     v-for="item in allitems | orderBy 'priority' -1"
                    @item-change="itemChanged"

                    :item="item"
                    :index="$index"
                    :is="bugz-list">
                </bugz-list-form>
                </div>
            </div><!-- /.box -->
            </div><!-- /.col-md-6 -->
</div><!-- ./row -->
</template>
<style scoped>
    #items-bugz .box {
        margin-bottom: 4px;
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

</style>
<script>
    import BugzListForm from './BugzListForm.vue'
    // import EventViewContent from './EventViewContent.vue'
      export default  {
        components: {
                    BugzListForm
                },
                props: [
                    'records'
                ],


        ready() {
                    // this.resource = this.$resource('/api/announcement/:id');
                    this.fetchAllRecords();
                    // this.fetchUnapprovedRecords();

        },
        data: function() {
          return {
            resource: {},
            allitems: [],
            items: [],
            xitems: [],
                        objs: {}
            }
        },

                computed: {
                    itemsApproved:function() {
                        return  this.itemyes(this.allitems);
                    },
                    itemsUnapproved:function() {
                        return  this.itemno(this.allitems);
                    },
                    itemsApprovedPriority:function() {
                        return  this.itemno(this.allitems);
                    }


                },

        methods : {
                    // checkIndexWithValue: function (chitem){
                    // 	return
                    // },
                    itemChanged: function(method, changeditem){
                        // var changeditem = chitem;
                        console.log('changeitem id' + changeditem.id)
                        if (method == 'removeItem'){
                            this.removeRecord(changeditem)
                        } else {
                            this.updateRecord(changeditem)
                        }
                        console.log('method'+ method + 'changeditem' + changeditem);

                    },
                    movedItemIndex: function(mid){
                        return this.xitems.findIndex(item => item.id == mid)
                    },
                    removeRecord: function(item){
                        var currentRecordId =  item.id;
                        var currentRecord = item;
                        this.$http.patch('/api/bugz/removeItem/' + item.id , currentRecord , {
                            method: 'DELETE'

                        } )
                            .then((response) => {
                                console.log('good?'+ response)

                                var currentRecordIndex = this.movedItemIndex(currentRecordId);
                                this.allitems.splice(currentRecordIndex, 1);
                                console.log('removeIndex==='+ currentRecordIndex)
                            }, (response) => {
                                console.log('bad?'+ response)
                            });
                    },
                    updateRecord: function(item){
                        var currentRecordId =  item.id;
                        var currentRecord = item;
                        this.$http.patch('/api/bugz/updateItem/' + item.id , currentRecord , {
                            method: 'PATCH'

                        } )
                            .then((response) => {
                                console.log('currentRecord.complete' + currentRecord.complete + 'good?'+ response)

                                var currentRecordIndex = this.movedItemIndex(currentRecordId);
                                // this.xitems.pop(movedRecord);
                                //
                                if (currentRecord.complete == 1) {
                                    this.allitems.splice(currentRecordIndex, 1);

                             }

                                console.log('movedIndex==='+ currentRecordIndex)
                            }, (response) => {
                                console.log('bad?'+ response)
                            });
                    },
                    fetchAllRecords: function() {
                        this.$http.get('/api/bugz/listall')

                            .then((response) =>{
                                    //response.status;
                                    console.log('response.status=' + response.status);
                                    console.log('response.ok=' + response.ok);
                                    console.log('response.statusText=' + response.statusText);
                                    console.log('response.data=' + response.data);
                                    // data = response.data;
                                    //
                                    this.$set('allitems', response.data.data)

                                    // this.allitems = response.data.data;
                                    // console.log('this.record= ' + this.record);

                                    this.checkOverDataFilter();
                                }, (response) => {
                                    //error callback
                                    console.log("ERRORS");

                                    //  this.formErrors =  response.data.error.message;

                                }).bind(this);
                            },
                            checkOverDataFilter: function() {
                                console.log('items=' + this.allitems)
                                // var unapprovedItems = this.allitems.filter(function(item) {
                                // 	return item.approved === 0
                                // });
                                //
                                // this.xitems = unapprovedItems;
                                //
                                //
                                // var approvedItems = this.allitems.filter(function(item) {
                                // 	return item.approved === 1
                                // });
                                //
                                // this.items = approvedItems.sort(function(a,b){
                                // 	return parseFloat(b.priority) - parseFloat(a.priority);
                                // });

                            }
                    },


        // the `events` option simply calls `$on` for you
        // when the instance is created
        events: {
          // 'child-msg': function (msg) {
          //   // `this` in event callbacks are automatically bound
          //   // to the instance that registered it
          //   this.messages.push(msg)
          // }
        }
    }
</script>
