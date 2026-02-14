<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';
import PartnersGrid from '../Components/site/PartnersGrid.vue';

defineProps({
    about: {
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
            <p class="brand-pill">About Imaging Services</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Supporting your workflow with a dedicated team</h1>
            <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ about.intro }}</p>
            <p class="mt-2 max-w-3xl text-base text-brand-muted">{{ about.supporting }}</p>
        </section>

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <div class="mb-5">
                <p class="brand-pill">Our Team</p>
                <h2 class="mt-3 font-display text-3xl font-semibold text-brand-deep">People behind your imaging success</h2>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <article v-for="member in about.team" :key="member.name" class="surface-card overflow-hidden">
                    <img :src="member.image" :alt="member.name" class="h-64 w-full object-cover">
                    <div class="p-4">
                        <h3 class="font-display text-xl font-semibold text-brand-deep">{{ member.name }}</h3>
                        <p class="mt-1 text-sm uppercase tracking-[0.14em] text-brand-accent">{{ member.role }}</p>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto mt-12 max-w-7xl px-4 pb-4 lg:px-8">
            <PartnersGrid :partners="partners" title="Partners" />
        </section>
    </SiteLayout>
</template>
