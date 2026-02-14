<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';
import PartnersGrid from '../Components/site/PartnersGrid.vue';

defineProps({
    accessories: {
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
const urls = computed(() => page.props.site?.urls || {});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <p class="brand-pill">Accessories</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">View and select from our accessories catalog</h1>
            <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ accessories.summary }}</p>
        </section>

        <section class="mx-auto mt-8 max-w-7xl px-4 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <article class="surface-card p-6 md:p-8">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">Ordering Process</h2>
                    <ul class="mt-4 space-y-3">
                        <li v-for="note in accessories.notes" :key="note" class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted">
                            {{ note }}
                        </li>
                    </ul>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a :href="accessories.catalog_pdf" target="_blank" rel="noopener" class="btn-primary">Download Accessories Catalog</a>
                        <Link :href="urls.payments" class="btn-secondary">Go to Payments</Link>
                    </div>
                </article>

                <div class="surface-card overflow-hidden">
                    <img :src="accessories.catalog_image" alt="Accessories catalog preview" class="h-full min-h-80 w-full object-cover">
                </div>
            </div>
        </section>

        <section class="mx-auto mt-12 max-w-7xl px-4 pb-4 lg:px-8">
            <PartnersGrid :partners="partners" />
        </section>
    </SiteLayout>
</template>
