<template>
    <form action="/emu-today/search" method="get">
        <slot name="csrf"></slot>
        <template v-if="searchFormIsOpen">

            <span class="search-area">Search:<input type="text" name="searchterm" placeholder="Search" v-model="searchterm"><button type="submit"><i class="fi-magnifying-glass"></i></button></span>

        </template>
        <template v-else>
            <span class="search-area"><a @click.prevent="openSearchForm">Search <i class="fi-magnifying-glass"></i></a></span>
        </template>
    </form>
</template>
<style scoped>


</style>


<script>

module.exports = {
    directives: {},
    components: {},
    props: {},
    data: function() {
        return {
            searchFormIsOpen: false,
            searchterm:''

        }
    },
    created: function() {

    },
    ready() {
    },
    computed: {


    },
    methods: {
        openSearchForm:function(evt){
            this.searchFormIsOpen = true;
        },
        // submitSearch: function (e) {
        //     this.$http.get('/emu-today/search', this.searchterm);
        // },

        },
    watch: {},
    filters: {},
    events: {}
};

</script>
