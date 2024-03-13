<template>
    <Head title="Dashboard"/>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import PageTitle from "@/Components/PageTitle.vue";
import ButtonCreate from "@/Components/ButtonCreate.vue";


export default {
    name: 'Index',
    components: {
        ButtonCreate,
        Head,
        PageTitle,

    }
    ,
    layout: Layout,
    mounted() {
        this.$page.props.titleLayout = "Dashboard";
    }
}
</script>

<style scoped>

</style>
