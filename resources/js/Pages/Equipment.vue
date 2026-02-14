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
const urls = computed(() => page.props.site?.urls || {});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="page-shell page-shell-wide page-section">
            <div class="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
                <div class="lg:col-span-8">
                    <p class="brand-pill">Equipment</p>
                    <h1 class="mt-4 page-title text-brand-deep">Imaging systems for chiropractic, podiatry, veterinary, mobile, and orthopedic workflows</h1>
                    <div class="mt-5 grid gap-3">
                        <p v-for="line in equipment.intro" :key="line" class="page-body">{{ line }}</p>
                    </div>
                </div>
                <aside class="lg:col-span-4">
                    <div class="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">Need guidance?</p>
                        <p class="mt-2 text-sm text-brand-muted">Our team helps you choose the right system for your room size, workflow, and budget.</p>
                        <Link :href="urls.contact" class="btn-secondary mt-5 w-full">Talk to Equipment Sales</Link>
                    </div>
                </aside>
            </div>
        </section>

        <section class="page-shell page-shell-wide page-section">
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                <article v-for="item in equipment.categories" :key="item.slug" class="surface-card group overflow-hidden">
                    <img :src="item.image" :alt="item.name" class="h-52 w-full object-cover">
                    <div class="bg-site-panel p-5">
                        <h2 class="card-title text-brand-deep">{{ item.name }}</h2>
                        <Link :href="item.url" class="mt-3 inline-flex text-sm font-semibold text-brand-accent transition group-hover:translate-x-0.5 hover:text-brand-deep">View product page</Link>
                    </div>
                </article>
            </div>
        </section>

        <section class="page-shell page-shell-wide page-section-loose pb-4">
            <PartnersGrid :partners="partners" />
        </section>
    </SiteLayout>
</template>
