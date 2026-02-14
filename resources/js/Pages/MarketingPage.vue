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

        <section class="mx-auto mt-10 max-w-4xl px-4 lg:px-8">
            <article class="surface-card p-6 md:p-8">
                <p class="brand-pill">Imaging Services</p>
                <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">{{ page.title }}</h1>
                <p class="mt-4 text-lg text-brand-muted">{{ page.description }}</p>

                <div class="mt-6 space-y-4 text-base text-brand-muted">
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
