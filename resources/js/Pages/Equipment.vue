<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';
import PartnersGrid from '../Components/site/PartnersGrid.vue';

defineProps({
    equipment: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const partners = computed(() => page.props.site?.partners || []);
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <p class="brand-pill">Equipment</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Imaging systems for chiropractic, podiatry, veterinary, mobile, and orthopedic workflows</h1>
            <div class="mt-5 grid gap-3">
                <p v-for="line in equipment.intro" :key="line" class="text-base text-brand-muted">{{ line }}</p>
            </div>
        </section>

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                <article v-for="item in equipment.categories" :key="item.slug" class="surface-card overflow-hidden">
                    <img :src="item.image" :alt="item.name" class="h-52 w-full object-cover">
                    <div class="p-5">
                        <h2 class="font-display text-2xl font-semibold text-brand-deep">{{ item.name }}</h2>
                        <Link :href="item.url" class="mt-3 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep">View product page</Link>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto mt-12 max-w-7xl px-4 pb-4 lg:px-8">
            <PartnersGrid :partners="partners" />
        </section>
    </SiteLayout>
</template>
