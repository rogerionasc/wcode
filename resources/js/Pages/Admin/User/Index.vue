<!-- Conteúdo da página usuário -->
<template>
    <div>
        <Head :title="'Usuários'"/>
        <Layout :titleLayout="'Usuários'">
            <template #ButtonCreate>
                <ButtonCreate/>
            </template>
            <!-- Conteúdo da página usuário -->
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive p-3">
                        <table id="tableUser"
                               class="table w-100 card-table table-vcenter text-nowrap datatable dataTables_scrollBody">
                            <thead>
                            <tr>
                                <th><h4>ID</h4></th>
                                <th><h4>Nome</h4></th>
                                <th><h4>E-mail</h4></th>
                                <th class="text-center"><h4>Permissão</h4></th>
                                <th class="text-center"><h4>Ação</h4></th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Iteração sobre os usuários -->
                            <tr v-for="user in usersList" :key="user.id">
                                <td><span class="text-muted">{{ user.id }}</span></td>
                                <td><a href="" class="text-reset" tabindex="-1">{{ user.first_name }} {{  user.last_name  }}</a></td>
                                <td>{{ user.email }}</td>
                                <td class="text-center">
                                    <span :class="user.role === 'Ativo' ? 'badge bg-green-lt' : 'badge bg-red-lt'">
                                        {{ user.role }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon" aria-label="Button">
                                        <!-- SVG icon from http://tabler-icons.io/i/trash -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                            <path d="M16 5l3 3"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-icon" aria-label="Button">
                                        <!-- SVG icon from http://tabler-icons.io/i/trash -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7l16 0"/>
                                            <path d="M10 11l0 6"/>
                                            <path d="M14 11l0 6"/>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </Layout>
    </div>
</template>


<script setup>
import {computed, onMounted, ref} from 'vue';
import {Head} from "@inertiajs/inertia-vue3";
import ButtonCreate from "@/Components/ButtonCreate.vue";
import Layout from "@/Layouts/Layout.vue";
import jquery from "jquery";
import 'datatables.net-bs5';

// let { users } = defineProps(['users']);
// let usersList = computed(() => users.original);

const props = defineProps(['users']);
const usersList = ref(props.users.original);

onMounted(() => {
    const table = jquery('#tableUser').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        },

    });

    $('#searchInput').on('keyup', function () {
        table.search(this.value).draw();
    });
});
</script>

