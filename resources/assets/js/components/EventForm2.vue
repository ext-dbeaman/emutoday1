<template>
  <div>
    <typeahead inline-template>
    <div class="typeahead">
      <div class="column row">

        <div class="form-group">
      <input class="form-control title" type="text" name="title" placeholder="Title" v-model="formInputs.title">
      <span v-if="formErrors['title']" class="error">{{ formErrors['title'] }}</span>
        </div>

        <div class="row">



        <div class="small-6 columns">
          <!-- optional indicators -->
          <i class="fa fa-spinner fa-spin" v-if="loading"></i>
          <template v-else>
              <i class="fa fa-search" v-show="isEmpty"></i>
              <i class="fa fa-times" v-show="isDirty" @click="reset"></i>
          </template>
          <!-- the input field -->
          <input type="text"
                 placeholder="..."
                 autocomplete="on"
                 v-model="query"
                 @keydown.down="down"
                 @keydown.up="up"
                 @keydown.enter="hit"
                 @keydown.esc="reset"
                 @blur="reset"
                 @input="update"/>


          <!-- the list -->
          <ul v-show="hasItems">
              <li v-for="item in items" :class="activeClass($index)" @mousedown="hit" @mousemove="setActive($index)">
                  <span class="name" v-text="item.name"></span>
              </li>
          </ul>
        </div>
        <div class="small-6 columns">
          <div class="form-group">
        <input class="form-control location" type="text" name="location" placeholder="" v-model="formInputs.location">
        <span v-if="formErrors['location']" class="error">{{ formErrors['location'] }}</span>
          </div>
        </div>
        </div>

        </div>
    </div>
</typeahead>

  </div>
</template>
<style>
  .typeahead ul  {
    list-style-type: none;
    border: 1px solid #ddd;
  }
  .typeahead ul li.active {
    background-color: #ccc;
  }
</style>

<script>

import VueTypeaheadMixin from 'vue-typeahead'

export default {
  components: {
    'typeahead': {
      props: ['building'],
      mixins: [VueTypeaheadMixin],
      data:function() {
        return {
          src: '/fetch/buildings',
          data: {
            formInputs: {},
            formErrors: {}
          },
          onHit (item) {
            formInputs['location'] = item.name;


          },
          prepareResponseData(data){
            // data =
            return data;
          },

        }
      },
      methods: {

      }
    }
  }
}
</script>
