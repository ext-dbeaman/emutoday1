<template>
    <div class="flipswitch">
    <label class="flipswitch-label" :class="{checked:value}">
        <input type="checkbox" v-model="value" :disabled="disabled" name="flipswitch" class="flipswitch-cb">
        <div class="flipswitch-inner"></div>
        <div class="flipswitch-switch"></div>
    </label>
</div>
</template>
<script>
      export default  {
        props: {
            disabled: Boolean,
            checked: [Boolean, Number],
            value: Number
        },
        ready() {
            this.value == !!this.checked
        },
        data: function() {
          return {
                        // compval: $('#slct').val()
            }
        },
        methods : {

        },
        events: {

        }
    }
</script>
<style>
.flipswitch {
  position: relative;
  width: 36px;
  -webkit-user-select:none;
  -moz-user-select:none;
  -ms-user-select: none;
}
.flipswitch input[type=checkbox] {
  display: none;
}
.flipswitch-label {
  display: block;
  overflow: hidden;
  cursor: pointer;
  border: 1px solid #999999;
  border-radius: 4px;
}
.flipswitch-inner {
  width: 50%;
  /*margin-left: -50%;*/
  -webkit-transition: margin 0.3s ease-in 0s;
  -moz-transition: margin 0.3s ease-in 0s;
  -ms-transition: margin 0.3s ease-in 0s;
  -o-transition: margin 0.3s ease-in 0s;
  transition: margin 0.3s ease-in 0s;
}
.flipswitch-inner:before, .flipswitch-inner:after {
  float: left;
  width: 100%;
  height: 20px;
  padding: 0;
  line-height: 20px;
  font-size: 10px;
  color: white;
  font-family: Trebuchet, Arial, sans-serif;
  font-weight: bold;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.flipswitch-inner:before {
  content: "Y";
  padding-left: 5px;
  background-color: #605CA8;
  color: #FFFFFF;
}
.flipswitch-inner:after {
  content: "N";
  padding-right: 5px;
  background-color: #EBEBEB;
  color: #888888;
  text-align: right;
}
.flipswitch-switch {
  width: 8px;
  margin: 0px;
  background: #FFFFFF;
  border: 1px solid #999999;
  border-radius: 4px;
  position: absolute;
  top: 0;
  bottom: 0;
  right: 14px;
  -webkit-transition: all 0.3s ease-in 0s;
  -moz-transition: all 0.3s ease-in 0s;
  -ms-transition: all 0.3s ease-in 0s;
  -o-transition: all 0.3s ease-in 0s;
  transition: all 0.3s ease-in 0s;
}
.flipswitch-cb:checked + .flipswitch-label .flipswitch-inner {
  margin-left: 0;
}
.flipswitch-cb:checked + .flipswitch-label .flipswitch-switch {
  right: 0;
}
</style>
