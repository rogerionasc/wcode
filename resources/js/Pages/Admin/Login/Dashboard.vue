<template>
<!--    Bem vindo,-->
<!--    <h3>{{ $page.props.auth.user.name }}</h3>-->
<!--    <h3>{{ $page.props.auth.user.email }}</h3>-->
<!--    {user->name}-->
<!--    <a href="/logout">sair</a>-->

    <layout/>
</template>


<style scoped>
.card {
    height: 28em;
}

</style>
<script>
import Layout from "../../../Layouts/layout.vue";
export default {
    components: {Layout}
}
</script>
