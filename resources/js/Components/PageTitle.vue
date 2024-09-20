<template>
    <h2 class="page-title mx-2">{{ pageTitle }}</h2>
</template>

<script>
export default {
    name: "PageTitle",
    props: {
        pageTitle: {
            type: String,
            default: 'Valor Padrão',
        },
    }
}
</script>

<style scoped>

</style>
