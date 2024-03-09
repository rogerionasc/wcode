<template>
    <h2 class="page-title">
        <slot/>
    </h2>
</template>

<script>
export default {
    name: "PageTitle",
    props: {
        pageTitle: {
            type: String,
            default: 'Titulo da Pagína'
        }
    },
    data() {
        return {};
    }
};
</script>

<style scoped>

</style>
