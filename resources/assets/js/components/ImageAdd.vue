<style lang="stylus">

</style>
<template>
  <h2>Story Image Add</h2>
  <ul class="list-group">
    <li class="list-group-item" v-for="item in list">
      {{ item.image_name }}
    </li>
  </ul>
  </div>

</template>
<script>
  export default  {
    props: ['list'],

    created() {
      this.list = JSON.parse(this.list);
    }

    };
  </script>
