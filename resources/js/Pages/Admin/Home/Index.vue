<template>
    <Head title="Dashboard"/>
    <Layout />
</template>

<script>
import {Head} from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import PageTitle from "@/Components/PageTitle.vue";

export default {
    name: 'Index',
    components: {
        Head,
        PageTitle,
        Layout,
    }
}
</script>

<style scoped>

</style>
