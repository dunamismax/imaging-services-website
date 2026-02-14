<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    meta: {
        type: Object,
        default: () => ({
            title: 'Imaging Services',
            description: '',
        }),
    },
});
</script>

<template>
    <Head :title="meta.title || 'Imaging Services'">
        <meta v-if="meta.description" name="description" :content="meta.description">
    </Head>
</template>
