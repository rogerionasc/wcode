<template>
    <div>
        <Head :title="'Dashboard'"/>
        <Layout :titleLayout="'Dashboard'">
            <!-- Conteúdo da página usuário -->
            <div class="col-12">
                <div class="card">
                    <!-- Conteúdo da página usuário -->
            Conteudo da página dashboard

                </div>
            </div>

            
        </Layout>
    </div>
</template>


<script setup>
import { Head } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
defineOptions({
  name: 'IndexDashboard'
});
</script>
