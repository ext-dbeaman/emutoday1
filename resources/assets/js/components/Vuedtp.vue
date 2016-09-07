<template>
    <datetime :readonly="true" format="YYYY-MM-DD"></datetime>
    <datetime format="YYYY-M-D" value="2015-9-5"></datetime>
    <datetime :readonly="true" format="MMM/D/YYYY" width="300px"></datetime>
</template>

<script>
import datetime from './datetime.vue';

export default {
    components: { datetime }
};
</script>
