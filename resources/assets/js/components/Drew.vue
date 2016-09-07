<template>
    <div class="list-group">

  <a href="#" class="list-group-item" v-for="item in list">
    <h4 class="list-group-item-heading">
      {{ item.image_type }}
    </h4>

    <h5>
        <img :src="'http://emutoday.app'+item.image_path+'thumbnails/thumb-'+item.filename">
    </h5>

    <p class="list-group-item-text" v-if="item.caption">{{ item.caption }}</p>

    <button class="btn btn-xs btn-danger">Delete</button>
  </a>

</div>

</template>

<script>
    export default {

      props: ['list'],

        created() {
            this.list = JSON.parse(this.list);
        },
        computed: {
          src () {
            return 'imgs/story/thumbnails/thumb-' + this.list.item.filename
          }
        }
      };
</script>

<style>

</style>
