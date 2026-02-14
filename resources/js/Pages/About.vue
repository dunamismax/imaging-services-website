<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';
import PartnersGrid from '../Components/site/PartnersGrid.vue';

const props = defineProps({
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
const site = computed(() => page.props.site || {});
const company = computed(() => site.value.company || {});
const partners = computed(() => page.props.site?.partners || []);
const teamCount = computed(() => props.about.team?.length || 0);
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="page-shell page-shell-wide page-section">
            <div class="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
                <div class="lg:col-span-8">
                    <p class="brand-pill">About Imaging Services</p>
                    <h1 class="mt-4 page-title text-brand-deep">Our dedicated team caters to your business</h1>
                    <p class="mt-4 max-w-3xl page-lead">{{ about.intro }}</p>
                    <p class="mt-2 max-w-3xl page-body">{{ about.supporting }}</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <Link :href="site.urls?.contact" class="btn-primary">Talk to the team</Link>
                        <Link :href="site.urls?.services" class="btn-secondary">Explore services</Link>
                    </div>
                </div>
                <aside class="lg:col-span-4">
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                        <article class="rounded-2xl border border-brand-ink/10 bg-site-panel p-4">
                            <p class="text-xs uppercase tracking-[0.12em] text-brand-muted">Team Members</p>
                            <p class="mt-1 section-title text-brand-deep">{{ teamCount }}</p>
                        </article>
                        <article class="rounded-2xl border border-brand-ink/10 bg-site-panel p-4">
                            <p class="text-xs uppercase tracking-[0.12em] text-brand-muted">States Served</p>
                            <p class="mt-1 section-title text-brand-deep">{{ (company.states_served || []).length }}</p>
                        </article>
                    </div>
                </aside>
            </div>
        </section>

        <section class="page-shell page-shell-wide page-section">
            <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                <p class="brand-pill">Our Team</p>
                <h2 class="section-title text-brand-deep">People behind your imaging operations</h2>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <article v-for="member in about.team" :key="member.name" class="surface-card group overflow-hidden">
                    <img :src="member.image" :alt="member.name" class="h-64 w-full object-cover">
                    <div class="bg-site-panel p-4">
                        <h3 class="card-title text-brand-deep">{{ member.name }}</h3>
                        <p class="mt-1 text-sm uppercase tracking-[0.14em] text-brand-accent">{{ member.role }}</p>
                        <p class="mt-3 text-xs uppercase tracking-[0.12em] text-brand-muted transition group-hover:text-brand-accent">Imaging Services Team</p>
                    </div>
                </article>
            </div>
        </section>

        <section class="page-shell page-shell-wide page-section-loose pb-4">
            <PartnersGrid :partners="partners" title="Partners" />
        </section>
    </SiteLayout>
</template>
