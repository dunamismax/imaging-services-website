<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';

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
const urls = computed(() => page.props.site?.urls || {});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <Link :href="equipment.backUrl" class="text-sm font-semibold text-brand-accent hover:text-brand-deep">&larr; Back to Equipment</Link>

            <div class="mt-4 grid gap-6 lg:grid-cols-2">
                <div class="surface-card overflow-hidden">
                    <img :src="equipment.image" :alt="equipment.title" class="h-full min-h-72 w-full object-cover">
                </div>

                <article class="surface-card p-6 md:p-8">
                    <p class="brand-pill">Equipment Detail</p>
                    <h1 class="mt-3 font-display text-3xl font-semibold text-brand-deep md:text-4xl">{{ equipment.title }}</h1>
                    <p class="mt-3 text-base text-brand-muted">{{ equipment.subtitle }}</p>

                    <ul class="mt-5 space-y-2">
                        <li v-for="highlight in equipment.highlights" :key="highlight" class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted">
                            {{ highlight }}
                        </li>
                    </ul>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <Link :href="urls.contact" class="btn-primary">Request Pricing</Link>
                        <Link :href="urls.services" class="btn-secondary">See Service Options</Link>
                        <a v-if="equipment.brochure" :href="equipment.brochure" target="_blank" rel="noopener" class="btn-secondary">Download Brochure</a>
                    </div>
                </article>
            </div>
        </section>
    </SiteLayout>
</template>
