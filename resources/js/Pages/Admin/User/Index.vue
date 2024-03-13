
<!-- Conteúdo da página usuário -->
<template>
    <Layout title-layout="Usuários">
        <template v-slot:ButtonCreate>
            <ButtonCreate />
        </template>
        <!-- Conteúdo da página usuário -->
            Conteudo da página usuário

    </Layout>

</template>

<script>

import { Head } from "@inertiajs/vue3";
import ButtonCreate from "@/Components/ButtonCreate.vue";
import Layout from "@/Layouts/Layout.vue";


export default {
    components: {
        Head,
        ButtonCreate,
        Layout
    },

    // layout: Layout,
    mounted() {
        // this.$page.props.titleLayout = "Usuário";
    }
}

</script>

