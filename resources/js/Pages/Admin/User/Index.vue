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
                                    <th><h4>Cargo</h4></th>
                                    <th class="text-center"><h4>Status</h4></th>
                                    <th class="text-center"><h4>Ação</h4></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Iteração sobre os usuários -->
                                <tr v-for="user in usersList" :key="user.id">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal Form -->
            <ModalCreateUser  @updateTable="handleUpdateTable"/>
            <ModalDeleteUser :user="userToDelete" @updateTable="handleUpdateTable"/>
            <ModalEditUser :user="userToEdit" @updateTable="handleUpdateTable"/>
        </Layout>
    </div>
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue';
import { Head } from "@inertiajs/inertia-vue3";
import ButtonCreate from "@/Components/ButtonCreate.vue";
import Layout from "@/Layouts/Layout.vue";
import ModalCreateUser from "@/Pages/Admin/User/Create.vue";
import ModalDeleteUser from "@/Pages/Admin/User/Delete.vue";
import ModalEditUser from "@/Pages/Admin/User/Edit.vue";
import jquery from 'jquery';
import 'datatables.net-bs5';

const props = defineProps(['users']);
const usersList = reactive(props.users);

let dataTableInstance = null;
let userToDelete = ref({}); // Inicializado como um objeto vazio para evitar erros nulos
let userToEdit = ref({}); // Inicializado como um objeto vazio para evitar erros nulos

onMounted(() => {
    initializeDataTable();
    setupEventListeners();
    // console.log(props.users.error);
});

// Inicializar o DataTable
const initializeDataTable = () => {
    dataTableInstance = jquery('#tableUser').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        },
        
        data: usersList, // Inicializa com dados
        columns: [
            { data: 'id', className: 'text-muted'},
            { data: 'first_name', className: 'text-muted', render: (data, type, row) => `${data} ${row.last_name}` },
            { data: 'email', className: 'text-muted'},
            { data: 'title_role', className: 'text-muted' },
            { data: 'status', className: 'text-center', render: (data) => data === 'active' ? '<span class="badge bg-green-lt">Ativo</span>' : '<span class="badge bg-red-lt">Inativo</span>' },
            {
                data: null, className: 'text-center', render: (data) => `
                    <a href="#" class="btn edit-btn btn-icon "  data-bs-toggle="modal" data-bs-target="#editUser" aria-label="Button">
                        <!-- SVG de editar -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                            <path d="M16 5l3 3"/>
                        </svg>
                    </a>
                    <a href="#" class="btn btn-danger btn-icon delete-btn"  data-bs-toggle="modal" data-bs-target="#deleteUser" aria-label="Button">
                        <!-- SVG de excluir -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7l16 0"/>
                            <path d="M10 11l0 6"/>
                            <path d="M14 11l0 6"/>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                        </svg>
                    </a>
                `
            }
        ],
        order: [[0, 'desc']]
    });
};

// Configurar eventos após inicializar o DataTable
const setupEventListeners = () => {
    jquery('#tableUser').on('click', '.delete-btn, .edit-btn', function() {
        const row = dataTableInstance.row(jquery(this).closest('tr')).data();
        userSelect(row);
    });
};

const userSelect = (user) => {
    userToDelete.value = user || {}; // Garantia de que não será null
    userToEdit.value = user || {}; // Garantia de que não será null
    console.log("Usuário selecionado:", user);
    // console.log(user.address);
};

// Atualizar a tabela
const handleUpdateTable = async () => {
    try {
        const response = await fetch('/admin/user/fetchUsers');
        const data = await response.json();
        dataTableInstance.clear();
        dataTableInstance.rows.add(data);
        dataTableInstance.draw();
    } catch (error) {
        console.error("Erro ao atualizar a tabela de usuários:", error);
    }
};

</script>

<style>
.dt-empty {
  text-align: center;
}

.dt-column-title h4 {
    margin: 0;
    margin-top: 1em;
}
</style>
