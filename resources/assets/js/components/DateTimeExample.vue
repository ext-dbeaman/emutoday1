<template>

			<div class="form-horizontal">
	  <div class="form-group">
	    <label for="picker1" class="col-sm-3 control-label">
	      A default datetime picker:
	    </label>
	    <div class="col-sm-5">
	      <vue-datetime-picker class="vue-picker1" name="picker1"
	                           :model.sync="result1">
	      </vue-datetime-picker>
	    </div>
	    <div class="col-sm-4">
	      <p class="form-control-static">
	        Selected Datetime: <span class="vue-result1">{{formatDatetime(result1)}}</span>
	      </p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="picker2" class="col-sm-3 control-label">
	      A datetime picker with customized datetime format:
	    </label>
	    <div class="col-sm-5">
	      <vue-datetime-picker class="vue-picker2" name="picker2"
	                           :model.sync="result2"
	                           type="datetime"
	                           language="en"
	                           datetime-format="LLL">
	      </vue-datetime-picker>
	    </div>
	    <div class="col-sm-4">
	      <p class="form-control-static">
	        Selected Datetime: <span class="vue-result2">{{formatDatetime(result2)}}</span>
	      </p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="picker3" class="col-sm-3 control-label">
	      A date picker with customized date format:
	    </label>
	    <div class="col-sm-5">
	      <vue-datetime-picker class="vue-picker3" name="picker3"
	                           :model.sync="result3"
	                           type="date"
	                           language="en-US"
	                           date-format="L">
	      </vue-datetime-picker>
	    </div>
	    <div class="col-sm-4">
	      <p class="form-control-static">
	        Selected Date: <span class="vue-result3">{{formatDate(result3)}}</span>
	      </p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="picker4" class="col-sm-3 control-label">
	      A time picker with customized time format:
	    </label>
	    <div class="col-sm-5">
	      <vue-datetime-picker class="vue-picker4" name="picker4"
	                           :model.sync="result4"
	                           type="time"
	                           language="zh-CN"
	                           time-format="LT">
	      </vue-datetime-picker>
	    </div>
	    <div class="col-sm-4">
	      <p class="form-control-static">
	        Selected Time: <span class="vue-result4">{{formatTime(result4)}}</span>
	      </p>
	    </div>
	  </div>
	  <div class="form-group">
	    <p class="form-control-static col-sm-12">
	      Demonstration of the range of datetime. Note how the minimum/maximum
	      selectable datetime of the start/end datetime picker was changed
	      according to the selection of another picker.
	    </p>
	  </div>
	  <div class="form-group">
	    <label for="start-picker" class="col-sm-3 control-label">
	      Start Datetime:
	    </label>
	    <div class="col-sm-3">
	      <vue-datetime-picker class="vue-start-picker" name="start-picker"
	                           v-ref:start-picker
	                           :model.sync="startDatetime"
	                           :on-change="onStartDatetimeChanged">
	      </vue-datetime-picker>
	    </div>
	    <label for="end-picker" class="col-sm-3 control-label">
	      End Datetime:
	    </label>
	    <div class="col-sm-3">
	      <vue-datetime-picker class="vue-end-picker" name="end-picker"
	                           v-ref:end-picker
	                           :model.sync="endDatetime"
	                           :on-change="onEndDatetimeChanged">
	      </vue-datetime-picker>
	    </div>
	  </div>
	</div>

</template>
<script>
      export default {
        components: {
					"vue-datetime-picker": require("vue-datetime-picker"),
					},
        props: [ 'varYearUnit', 'varMonthUnit','varDayUnit', ],

        ready() {
          alert('varYearUnit');


        },
        data: function() {
          return {
						result1: null,
						result2: null,
						result3: null,
						startDatetime: moment(),
						endDatetime: null
          }
        },
        methods : {
					formatDatetime: function(datetime) {
			      if (datetime === null) {
			        return "[null]";
			      } else {
			        return datetime.format("YYYY-MM-DD HH:mm:ss");
			      }
			    },
			    formatDate: function(date) {
			      if (date === null) {
			        return "[null]";
			      } else {
			        return date.format("YYYY-MM-DD");
			      }
			    },
			    formatTime: function(time) {
			      if (time === null) {
			        return "[null]";
			      } else {
			        return time.format("HH:mm:ss");
			      }
			    },
			    onStartDatetimeChanged: function(newStart) {
			      var endPicker = this.$.endPicker.control;
			      endPicker.minDate(newStart);
			    },
			    onEndDatetimeChanged: function(newEnd) {
			      var startPicker = this.$.startPicker.control;
			      startPicker.maxDate(newEnd);
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
