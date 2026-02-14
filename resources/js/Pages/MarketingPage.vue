<script setup>
import { Link } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';

defineProps({
    page: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="page-shell page-shell-narrow page-section">
            <article class="surface-card p-6 md:p-8">
                <p class="brand-pill">Imaging Services</p>
                <h1 class="mt-4 page-title text-brand-deep">{{ page.title }}</h1>
                <p class="mt-4 page-lead">{{ page.description }}</p>

                <div class="mt-6 space-y-4 rounded-2xl border border-brand-ink/10 bg-site-panel p-4 reading-body">
                    <p v-for="paragraph in page.body" :key="paragraph">{{ paragraph }}</p>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <Link :href="page.ctaUrl" class="btn-primary">{{ page.cta.label }}</Link>
                    <Link :href="page.homeUrl" class="btn-secondary">Return Home</Link>
                </div>
            </article>
        </section>
    </SiteLayout>
</template>
