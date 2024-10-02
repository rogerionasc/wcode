<template>
    <h2>Minha Conta</h2>
    <h3 class="card-title">Detalhes do meu perfil</h3>
<form>
    <div class="row d-flex align-items-center">
        <!-- Avatar -->
        <div class="col-12 col-md-3 col-lg-2 text-md-start text-center mt-md-5">
            <span class="avatar avatar-xl mb-3 mb-md-0 rounded">{{ getInitials(props.auth.user.first_name, props.auth.user.last_name) }}</span>
        </div>

        <div class="col-12 col-md-9 col-lg-10">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nome</label>
                    <input v-model="formUpdate.first_name" type="text" class="form-control" placeholder="Seu nome"
                    :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.first_name }">
                    <small v-if="formUpdate.errors.update && formUpdate.errors.update.first_name"
                    class="invalid-feedback">{{ formUpdate.errors.update.first_name }}</small>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Sobrenome</label>
                    <input v-model="formUpdate.last_name" type="text" class="form-control" placeholder="Seu sobrenome"
                    :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.last_name }">
                    <small v-if="formUpdate.errors.update && formUpdate.errors.update.last_name"
                    class="invalid-feedback">{{ formUpdate.errors.update.last_name }}</small>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">CPF</label>
                    <input v-model="formUpdate.document" type="text" class="form-control"
                    :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.document }"
                    placeholder="xxx.xxx.xxx-xx"
                    :disabled="!hasRole(['Administrador', 'Gerente'])">
                    <small v-if="formUpdate.errors.update && formUpdate.errors.update.document"
                    class="invalid-feedback">{{ formUpdate.errors.update.document }}</small>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control"
                    placeholder="(99) 9 9999-9999">
                    <small class="invalid-feedback"></small>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">Data de Nascimento</label>
                    <Datepicker :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.birth_date }"
                    class="custom-date" v-model="formUpdate.birth_date" />
                    <small v-if="formUpdate.errors.update && formUpdate.errors.update.birth_date"
                    class="invalid-feedback">{{ formUpdate.errors.update.birth_date }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-md-6">
            <label class="form-label">Email</label>
            <input :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.email }"
             v-model="formUpdate.email" type="email" class="form-control" name="account-name" placeholder="Seu email"
             :disabled="!hasRole(['Administrador', 'Gerente'])">
            <small v-if="formUpdate.errors.update && formUpdate.errors.update.email"
            class="invalid-feedback">{{formUpdate.errors.update.email}}</small>
        </div>
        <div class="col-12 col-md-6 mt-3 mt-md-0">
            <label class="form-label">Alterar senha</label>
            <div class="mt-0 input-group">
                <input
                :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.password }"
                v-model="formUpdate.password" value="" :type="showPassword ? 'text' : 'password'" class="form-control">
                <button type="button" @click="togglePassword" class="btn">{{ showPassword ? "Ocultar" : "Mostrar" }}</button>
                <small v-if="formUpdate.errors.update && formUpdate.errors.update.password"
                class="invalid-feedback">{{formUpdate.errors.update.password}}</small>
            </div>
        </div>
    </div>
</form>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import Datepicker from '@/Components/Datepicker.vue';
// import { password } from 'pg/lib/defaults';

const showPassword = ref(false);

const props = defineProps({
  auth: Object
});

const permissions = props.auth.user.permissions.original;

const hasPermission = (permissionName) => {
  return props.auth.user.permissions.original.some(permission => permission.name === permissionName);
};

// const isAdmin = () => {
//     return props.auth.user.role === 'Administrador';
// };

const hasRole = (roles) => {
    return roles.includes(props.auth.user.role);
};

console.log(permissions);

const formUpdate = useForm ({
    first_name: props.auth.user.first_name,
    last_name: props.auth.user.last_name,
    document: props.auth.user.document,
    email: props.auth.user.email,
    birth_date: props.auth.user.birth_date,
    password: '',
    status: props.auth.user.status,
    role: props.auth.user.role,

});

watch(() => props.auth.user, (newValue) => {
    formUpdate.first_name = newValue.first_name;
    formUpdate.last_name = newValue.last_name;
    formUpdate.document = newValue.document;
    formUpdate.email = newValue.email;
    formUpdate.birth_date = newValue.birth_date;
    formUpdate.password = newValue.password;
    formUpdate.status = newValue.status;
    formUpdate.role = newValue.role;

});

async function updateAccount() {
    try {
        formUpdate.put(`./user/update/${props.auth.user.id}`, {

        });
        
    } catch (error) {
        
    }  
}

function getInitials(firstName, lastName) {
    // Obtém a primeira letra do primeiro nome e do sobrenome
    const firstInitial = firstName.charAt(0).toUpperCase();
    const lastInitial = lastName.charAt(0).toUpperCase();

    // Junta as iniciais
    return firstInitial + lastInitial;
}

defineExpose({ updateAccount });

function togglePassword() {
    showPassword.value = !showPassword.value;
    console.log(props.auth.user);
}
</script>
