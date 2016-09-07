<style scoped>

// ====================================================
// 🔥Fireselect
// ====================================================

.fire-select-box {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 3px;
    position: relative;
    box-sizing: border-box;
    margin-bottom: 20px;

    &:before,
    &:after {
        content: " ";
        display: table;
    }

    &:after {
        clear: both;
    }

    &.multiple {
        .fire-selected-item:not(.empty) {
            display: inline-block;
            font-size: 14px;
            padding: 2px 0 2px 5px;
            margin: 3px 0 3px 3px;
            border: 1px solid #ccc;

            &::after {
                display: none;
            }

            & > b {
                float: none;
                margin: 0;
                padding: 0 5px;
                border-right: none;
            }
        }
    }
}

.fire-select-list,
.fire-selected-list {
    padding: 0;
    margin: 0;
    list-style: none;
}

.fire-selected-list {
    width: 100%;
    float: left;
    cursor: pointer;
}

.fire-selected-item {
    box-sizing: border-box;
    border-radius: 3px;
    padding: 5px 10px;
    color: #333;
    background-image: linear-gradient(#fff, #ddd);
    display: block;
    user-select: none;
    font-size: 16px;
    line-height: 1em;
    position: relative;

    &::after {
        content: '';
        display: block;
    	width: 0;
    	height: 0;
    	border-left: 4px solid transparent;
    	border-right: 4px solid transparent;
    	border-top: 4px solid #333;
        position: absolute;
        right: 10px;
        top: 50%;
        margin-top: -2px;
    }

    & > b {
        float: right;
        margin-right: 20px;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        padding: 0 10px;
    }
}

.fire-select-list {
    position: absolute;
    top: 100%;
    left: 0;
    border: 1px solid #ccc;
    width: 100%;
    box-sizing: border-box;
    border-radius: 3px;
    z-index: 1;
    background: #fff;
    overflow-y: auto;
    max-height: 200px;
}

.fire-select-item {
    padding: 10px;
    color: #333;
    cursor: pointer;
    user-select: none;
    font-size: 14px;
    border-top: 1px solid #eee;

    &:hover,
    &.hover {
        background: #eee;
    }
}

.fire-select-item-input {
    padding: 10px;
}

.fire-select-input {
    border: none;
    font-size: 14px;
    line-height: 1em;
    outline: none;
    color: #333;
    width: 100%;
}

.fs-hidden {
    display: none !important;
}

// ====================================================
// Animate.css - bounceIn
// ====================================================

.animated {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}

@keyframes bounceIn {
    from, 20%, 40%, 60%, 80%, to {
        animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
    }

    0% {
        opacity: 0;
        transform: scale3d(.3, .3, .3);
    }

    20% {
        transform: scale3d(1.1, 1.1, 1.1);
    }

    40% {
        transform: scale3d(.9, .9, .9);
    }

    60% {
        opacity: 1;
        transform: scale3d(1.03, 1.03, 1.03);
    }

    80% {
    transform: scale3d(.97, .97, .97);
    }

    to {
        opacity: 1;
        transform: scale3d(1, 1, 1);
    }
}

.fs-bounceIn {
  animation-name: bounceIn;
}


</style>


<template>
  <div
    class="fire-select-box"
    :class="{
        'multiple': multiple,
    }"
    @click="open()"
>
    <ul class="fire-selected-list">
        <li class="fire-selected-item empty" v-show="selected.length == 0">{{ placeholder }}</li>
        <li class="fire-selected-item"
            :class="{
                'animated': animation
            }"
            :transition="animation ? 'bounce' : ''"
            v-for="option in selected"
            @click.stop="open()"
        >
            {{ option.label }}
            <b @click.stop="deselect(option)">&times;</b>
        </li>
    </ul>

    <ul class="fire-select-list" v-show="isOpen">
        <li class="fire-select-item-input">
            <input
                type="text"
                class="fire-select-input"
                :placeholder="helperMessage"
                v-model="input"
                v-el:input
                @keyup.enter="index === null || index == -1 ? newOption() : select(index)"
                @keydown.esc="close()"
                @keydown.up.prevent="up()"
                @keydown.down.prevent="down()"
                @blur="close() | debounce 100"
            >
        </li>

        <li class="fire-select-item"
            v-if="input && create"
            @click="newOption()"
            :class="{
                'hover': index == -1,
            }"
        >
            {{ addLabel }} <b>{{ input }}</b>
        </li>

        <li class="fire-select-item" v-if="tips.length == 0 && ! create">
            {{ noResultsLabel }} <b>{{ input }}</b>
        </li>

        <li
            class="fire-select-item"
            v-for="option in tips"
            @click.stop="select(option)"
            @mouseover="index = null"
            :class="{
                'hover': $index == index,
            }"
        >
            {{{ option.label | highlight }}}
        </li>
    </ul>

    <select :name="name" :id="id" multiple style="display: none;">
        <option :value="option.value" selected v-for="option in selected">{{ option.label }}</option>
    </select>
</div>

</template>
<script>
  export default {
    props: {
      options: {
          type: Array,
          default: [],
      },

      multiple: {
          type: Boolean,
          default: false
      },

      create: {
          type: Boolean,
          default: true
      },

      name: {
          type: String,
          default: 'fire-select[]'
      },

      id: {
          type: String,
          default: 'fire-select'
      },

      helperMessage: {
          type: String,
          default: 'Type anything to search'
      },

      placeholder: {
          type: String,
          default: function () {
              return this.multiple ? 'Select some items' : 'Select an item';
          }
      },

      addLabel: {
          type: String,
          default: 'Add:'
      },

      noResultsLabel: {
          type: String,
          default: 'No results found for:'
      },

      animation: {
          type: Boolean,
          default: true
      }
  },

  data: function() {
      return {
          options_: [],
          input: '',
          index: null,
          isOpen: false,
          isPopulating: false,
          skipClose: false,
      };
  },

  transitions: {
      'bounce': {
          enterClass: 'fs-bounceIn',
          leaveClass: 'fs-hidden'
      },
  },

  computed: {
      tips: function() {
          return this.options_.filter(function(option) { return option.tip === true && option.selected === false; });
      },

      selected: function() {
          return this.options_.filter(function(option) { return option.selected === true; });
      },
  },

  watch: {
      'input': function (val) {
          this.index = null;

          this.options_.forEach(function(option) {
              var label = option.label.toLowerCase(),
                  value = val.toLowerCase();

              option.tip = val.length ? label.indexOf(value) != -1 : true;
          });
      },

      'options': {
          handler: function() {
              this.populate();
          },
          deep: true
      },

      multiple: function(val) {
          if (val === false && this.selected.length) {
              this.selected.forEach(function(option, index){
                  if (index > 0) option.selected = false;
              });
          }
      },
  },

  filters: {
      highlight: function(value) {
          return this.input.length ?
              value.replace(new RegExp('('+this.input+')', 'gi'), '<b>$1</b>')
              : value;
      }
  },

  methods: {
      populate: function() {
          this.options_ = [];
          this.index = null;
          this.isPopulating = true;

          this.options.forEach(function(option, index) {
              if (typeof option == 'string') {
                  this.addOption(index, option, false, true);
              } else {
                  this.addOption(option.value, option.label, option.selected, true);
              }
          }.bind(this));

          this.isPopulating = false;
      },

      addOption: function(value, label, selected, tip) {
          var option = {
              value: value,
              label: label,
              selected: false,
              tip: !! tip,
          };

          if (this.options_.filter(function(item_) {
              return item_.value == value && item_.label == label;
          }).length === 0) {
              this.options_.$set(this.options_.length, option);
              if (! this.isPopulating) this.$dispatch('fsOptionAdded', Vue.util.extend({}, option));
              if (!! selected) this.select(option);
          }
      },

      newOption: function() {
          if (! this.create) return;

          var text = this.input.trim();

          if (! text) return;

          this.singleDeselect();
          this.addOption(text, text, true, true, true);
      },

      select: function(option) {
          // get a option by this.index
          if (typeof option != 'object') {
              option = this.tips[this.index];
              this.index = null;
          }

          this.singleDeselect();

          option.selected = true;
          if (! this.isPopulating) this.$dispatch('fsOptionSelected', Vue.util.extend({}, option));

          if (this.multiple) {
              this.skipClose = true;
              if (this.isOpen) this.$els.input.focus();
          } else {
              if (this.isOpen) this.close();
          }
      },

      deselect: function(option) {
          option.selected = false;
          if (! this.isPopulating) this.$dispatch('fsOptionDeselect', Vue.util.extend({}, option));
      },

      singleDeselect: function() {
          if (! this.multiple && this.selected.length) this.deselect(this.selected[0]);
          this.input = '';
      },

      up: function() {
          if (this.index !== null && this.index > (this.input ? -1 : 0)) {
              this.index--;
          } else {
              this.index = this.tips.length - 1;
          }
      },

      down: function() {
          if (this.index !== null && this.index < (this.tips.length - 1)) {
              this.index++;
          } else {
              this.index = this.input ? -1 : 0;
          }
      },

      open: function() {
          this.isOpen = true;

          this.$nextTick(function () {
              this.$els.input.focus();
          }.bind(this));
      },

      close: function() {
          if (this.skipClose === true) {
              this.skipClose = false;
              return;
          }

          this.isOpen = false;
      },
  },

  created: function() {
      this.populate();
  }
  }
</script>
