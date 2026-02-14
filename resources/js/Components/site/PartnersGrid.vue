<script setup>
defineProps({
    partners: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        default: 'Partners We Work With',
    },
});
</script>

<template>
    <div class="surface-card p-6 md:p-8">
        <p class="brand-pill">{{ title }}</p>
        <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            <div
                v-for="partner in partners"
                :key="partner.name"
                class="flex items-center justify-center rounded-xl border border-brand-ink/10 bg-white p-3"
            >
                <img :src="partner.logo" :alt="partner.name" class="h-10 w-auto object-contain" loading="lazy">
            </div>
        </div>
    </div>
</template>
