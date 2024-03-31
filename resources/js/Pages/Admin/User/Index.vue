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
                                <th><h4>Usuário</h4></th>
                                <th><h4>Criado</h4></th>
                                <th><h4>Status</h4></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span class="text-muted">001401</span></td>
                                <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                                <td>
                                    12 Apr 2017
                                </td>
                                <td>
                                    <span class="badge bg-green-lt">Inativo</span>
                                </td>
                                <td class="text-end">
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
                            <tr>
                                <td><span class="text-muted">001401</span></td>
                                <td><a href="invoice.html" class="text-reset" tabindex="-1">Develop web</a></td>
                                <td>
                                    12 Apr 2017
                                </td>
                                <td>
                                    <span class="badge bg-red-lt">Inativo</span>
                                </td>
                                <td class="text-end">
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
                            <tr>
                                <td><span class="text-muted">001401</span></td>
                                <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Web</a></td>
                                <td>
                                    12 Apr 2017
                                </td>
                                <td>
                                    <span class="badge bg-red-lt">Inativo</span>
                                </td>
                                <td class="text-end">
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
                            <tr>
                                <td><span class="text-muted">001401</span></td>
                                <td><a href="invoice.html" class="text-reset" tabindex="-1">Develop Java</a></td>
                                <td>
                                    12 Apr 2017
                                </td>
                                <td>
                                    <span class="badge bg-green-lt">Ativo</span>
                                </td>
                                <td class="text-end">
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
                            <tr>
                                <td><span class="text-muted">001401</span></td>
                                <td><a href="invoice.html" class="text-reset" tabindex="-1">Develop PHP</a></td>
                                <td>
                                    12 Apr 2017
                                </td>
                                <td>
                                    <span class="badge bg-red-lt">Inativo</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-icon" aria-label="Button">
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
import {onMounted} from 'vue';
import {Head} from "@inertiajs/inertia-vue3";
import ButtonCreate from "@/Components/ButtonCreate.vue";
import Layout from "@/Layouts/Layout.vue";
import $ from "jquery";
import 'datatables.net-bs5';

onMounted(() => {

    const table = $('#tableUser').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        },

    });

    // Adicionar a funcionalidade de pesquisa
    $('#searchInput').on('key', function () {
        table.search(this.value).draw();
    });
});
</script>
<style>
#dt-search-0 {
    font-size: 14px !important;
    line-height: 20px !important;
    padding: 7px 12px !important;
}

.me-auto {
    display: none !important;
}

label {
    font-size: 16px !important;
    margin-right: 1rem !important;
}

.dt-search {
    display: flex !important;
    align-items: center !important;
}

.btn-icon {
    margin: auto 0.3rem !important;
}
</style>

