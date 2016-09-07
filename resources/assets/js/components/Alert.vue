<style lang="stylus">
    .Alert
      position: relative
      background: #ddd
      border: 1px solid #bbb
      padding: 1em

    .Alert--Success
      background: #ff0000
      border: 1px solid #0000ff

    .Alert--Error
      background: #00ff00
      border: 1px solid #000000

    .Alert__close
      position: absolute
      top: 1em
      right: 1em
      font-weight: bold
      cursor: pointer

</style>
<template>
  <div :class="alertClasses" v-show="show">

  <slot></slot>
  <span class="Alert__close" @click="show = false">X</span>
  </div>

</template>
<script>
  export default  {

    props: ['type'],

    data() {
      return {
        show: true
      };
      },

      computed: {
        alertClasses() {
          var type = this.type;

          return {
            'Alert' : true,
            'Alert--Success': type == 'success',
            'Alert--Error': type == 'error'
          };

        }

      }
    };
  </script>
