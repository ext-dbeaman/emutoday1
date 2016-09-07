<template>
  <div class="form-horizontal">
    <div class="form-group">
      <label for="picker1" class="col-sm-3 control-label">
        A default datetime picker:
      </label>
      <div class="col-sm-5">
        <vue-datetime-picker v-ref:picker1 name="picker1"
                             :model.sync="result1"
														 type="datetime"
														 language="en-US">
        </vue-datetime-picker>
      </div>
      <div class="col-sm-4">
        <p class="form-control-static">
          Selected Datetime: <span class="vue-result1">{{formatDatetime(result1)}}</span>
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
			<vue-datetime-picker v-ref:start-picker name="start-picker"
													 :model.sync="startDatetime"
													 type="datetime"
													 language="en-US"
													 :on-change="onStartDatetimeChanged">
			</vue-datetime-picker>
		</div>
		<label for="end-picker" class="col-sm-3 control-label">
			End Datetime:
		</label>
		<div class="col-sm-3">
			<vue-datetime-picker v-ref:end-picker name="end-picker"
													 :model.sync="endDatetime"
													 type="datetime"
													 language="en-US"
													 :on-change="onEndDatetimeChanged">
			</vue-datetime-picker>
		</div>
	</div>
	</div>
</template>

<script>
module.exports = {
  components: {
    "vue-datetime-picker": require("../vue-vendor/vue-datetime-picker.js")
  },
	ready() {


	},
  props: {
    result1: {
      required: true,
      twoWay: true
    },
    startDatetime: {
      required: true,
      twoWay: true
    },
    endDatetime: {
      required: true,
      twoWay: true
    }
  },
  methods: {
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
      var endPicker = this.$refs.endPicker.control;
      endPicker.minDate(newStart);
    },
    onEndDatetimeChanged: function(newEnd) {
      var startPicker = this.$refs.startPicker.control;
      startPicker.maxDate(newEnd);
    }
  }
};
</script>
