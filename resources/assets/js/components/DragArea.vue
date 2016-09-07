<template>
    <div class="dragarea">
        <div v-for="item in allitems">
            <div class="row">
                <div class="col-md-3">
                    <div id="drag{{item.id}}" class="dragbox">{{item.id}}</div>

                    <!-- <div id="draghold{{item.id}}" class="dragholdbox">
                        <h4 class="text-center">{{item.id}}</h4>
                    </div> -->
                </div><!-- /.col-md-3 -->
                <div class="col-md-3">
                    <h5 class="text-left">{{item.type}}</h5>
                </div><!-- /.col-md-3 -->
                <div class="col-md-6">
                    <h5 class="text-left">{{item.title}}</h5>
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->
        </div>
    </div><!-- /.dragarea -->


</template>
<style scoped>
#dragcontainer {
  position:relative;
}
.dragbox {
  position:absolute;
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
require('Draggable')
module.exports  = {
  data: function() {
    return {
      overlapThreshold: "50%",
      droppables: []
  }

  },

  props:
  ['allitems']
  ,
  created: function() {
    //  this.fetchCurrentEventsForCalendar();
    // this.fetchCategoryList();
  },
  ready: function() {
      console.log('DragArea Ready');
      this.droppables = $(".dragbox");

      Draggable.create(this.droppables, {
          type: "x,y",
           bounds:window
      })
  },
  filters: {
    // removex: function(value) {
    //   return (value[0] == 'x') ? '_' : value;
    // }
  },

  computed: {
    // currentDayInMonth: function () {
    //   if (this.yearVar == this.currentDate.yearVar) {
    //     if (this.monthVar == this.currentDate.monthVar)
    //       return this.currentDate.dayVar;
    //   } else {
    //     return '';
    //   }
    //
    // },
    // selectedDayInMonth: function () {
    //   if (this.yearVar == this.selectedDate.yearVar) {
    //     if (this.monthVar == this.selectedDate.monthVar)
    //       return this.selectedDate.dayVar;
    //   } else {
    //     return '';
    //   }
    //
    // },
  },

  methods: {


  },
watch: {

},

components: {

},
events: {

    }
};
</script>
