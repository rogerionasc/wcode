<template>
    <Index/>
</template>

<script setup>
import Index from '@/Pages/Admin/Home/Index.vue';

const module = {
    home: {
        write: true,
        delete: true,
        read: true
    }
};

</script>