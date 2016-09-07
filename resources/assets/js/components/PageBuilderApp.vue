<template>
    <div id="dragcontainer" class="row">
        <div class="col-md-6">
            <h3>Story Btns</h3>
            <table>
                <tbody>
                    <tr v-for="item in allitems">
                        <td class="dragbox">
                            {{item.id}}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- <table id="dragtable">
                <tr is="drag-btn"
                    class="dragbox"
                    v-for="item in allitems"
                    :item="item"
                    :index="$index"
                    ></tr>
            </table> -->

        </div><!-- /.col-md-6 -->

            <div class="col-md-6">
                <div id="dropcontainer">
                  <div id="box1" class="dropbox">box1</div>
                  <div id="box2" class="dropbox">box2</div>
                  <div id="box3" class="dropbox">box3</div>
                </div>
            </div><!-- /.col-md-6 -->
    </div><!-- ./row -->
</template>
<style>
#dragcontainer {
  position:relative;
  height: 800px;
}
#dragcontainer {
  position:relative;
  height: 100%;
  width: 100%;
}
#maindragholder{
    position:relative;
}
table#dragtable {
     position:relative;
    height: 100%;
    width: 100%;
}
.dragbox {
  /*position:absolute;*/
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
.dropbox {
    position:absolute;
    width: 200px;
    height: 200px;
    text-align: center;
    line-height: 16px;
    font-size: 16px;
    color: white;
    /*border-radius:10px;*/
    border: 1px solid grey;
    background-color: black;
}
.dragholdbox {
  position:absolute;
  width: 40px;
  height: 40px;
  text-align: center;
  line-height: 16px;
  font-size: 16px;
  color: white;
  /*border-radius:10px;*/
  border: 1px solid grey;
  background-color: black;
}
#box1 {
    background-color: red;
  top:0px;
}
#box2 {
    background-color: blue;
  top:88px;
}
#box3 {
  background-color:green;
  top:176px;
}

</style>
<script>
import { TweenLite, CSSPlugin, ScrollToPlugin } from 'gsap'
require('Draggable')


export default  {
        components: {
             DragBtn : require('./DragBtn.vue')
        },
        props: [
        ],
        data: function() {
          return {
              allitems: [],
              dragbtns: [],
              droppables: []
            }
        },
        // asyncComputed: {
        //     allitems: {
        //       return
        //       Vue.http.get('/api/story/listapproved')
        //         .then((response) => {
        //             response.data.data
        //         }, (response) => {
        //             //error callback
        //             console.log("ERRORS");
        //
        //             //  this.formErrors =  response.data.error.message;
        //
        //         })
        //     }
        // },
        watch: {
            // allitems: {
            //     handler: function (newValue, oldValue) {
            //         console.log("users is now", this.allitems);
            //     },
            //     deep: true
            // }
        },
        ready() {

           this.fetchAllRecords();
        },

        methods : {
            fetchAllRecords: function(){
                    this.$http.get('/api/story/listapproved')

                        .then((response) =>{
                            console.log('response.status=' + response.status);
                            console.log('response.ok=' + response.ok);
                            console.log('response.statusText=' + response.statusText);
                            console.log('response.data=' + response.data);

                            this.$set('allitems', response.data.data);
                            this.$set('droppables', $('.dropbox'));
                             this.$nextTick(this.listAllitems);
                            // return this.listAllitems(response.data.data);
                            //
                            // this.fetchApprovedRecords();
                        }, (response) => {
                            //error callback
                            console.log("ERRORS");

                            //  this.formErrors =  response.data.error.message;

                        }).bind(this);
                },
                listAllitems: function() {
                    console.log('allitems=' + this.allitems.length);
                    // for (var i = 0; i < self.allitems.length; i++) {
                    //     var holdid = "hold"+self.allitems[i].id;
                    //     var holdelem = document.getElementById(holdid);
                    //     var dbid = 'dragbox'+self.allitems[i].id;
                    //     $(holdelem).append("<div class='dragbox' id="+dbid+">"+self.allitems[i].id+"</div>")
                    //     var yval = i * 40;
                    //     var dbidelem = document.getElementById(dbid);
                    //     TweenMax.set($(dbidelem),{x:0,y:yval})
                    //
                    //     // TweenMax.set($(".dragbox")[i],{x:0,y:yval})
                    // }

                    var dragbtn = Draggable.create('.dragbox',{
                        bounds:document.getElementById("dragcontainer"),
                        onPress: function(e) {
                            console.log('shit')
                        }
                    })[0];
                    dragbtn.addEventListener(
                        'drag', this.onDrag.bind(this)
                    );
                },
                onDrag: function(e){
                    console.log('droppppp'+ this.dropabbles.length)
                }
        },
        directives: {
                // gsDraggable: require('../directives/gs-draggable.js')
            },
        computed: {


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
