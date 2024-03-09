<template>
    <Head title="Dashboard"/>
    <layout/>
</template>


<style scoped>
.card {
    height: 28em;
}

</style>
<script>
import {Head} from "@inertiajs/vue3";
import Layout from "../../../Layouts/Layout.vue";
export default {
    components: {
        Layout,
        Head
    }
}
</script>
