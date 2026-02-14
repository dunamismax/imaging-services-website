<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';
import PartnersGrid from '../Components/site/PartnersGrid.vue';

const props = defineProps({
    home: {
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
const hours = computed(() => site.value.hours || []);
const partners = computed(() => site.value.partners || []);
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 grid max-w-7xl gap-8 px-4 lg:grid-cols-5 lg:px-8">
            <div class="reveal-up lg:col-span-3">
                <p class="brand-pill">Imaging Services USA</p>
                <h1 class="mt-4 font-display text-4xl font-semibold leading-tight text-brand-deep md:text-5xl">{{ home.hero.headline }}</h1>
                <p class="mt-4 max-w-2xl text-lg text-brand-muted">{{ home.hero.subheadline }}</p>
                <p class="mt-3 max-w-2xl text-base text-brand-muted">{{ home.hero.summary }}</p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <Link :href="home.hero.primary_cta.url" class="btn-primary">{{ home.hero.primary_cta.label }}</Link>
                    <Link :href="home.hero.secondary_cta.url" class="btn-secondary">{{ home.hero.secondary_cta.label }}</Link>
                </div>
            </div>

            <aside class="surface-card reveal-up p-5 lg:col-span-2">
                <h2 class="font-display text-xl font-semibold text-brand-deep">Typical Working Hours</h2>
                <dl class="mt-4 space-y-2 text-sm">
                    <div v-for="slot in hours" :key="slot.day" class="flex items-center justify-between border-b border-brand-ink/10 pb-2">
                        <dt class="font-semibold uppercase tracking-wide text-brand-muted">{{ slot.day }}</dt>
                        <dd class="text-brand-deep">{{ slot.hours }}</dd>
                    </div>
                </dl>
                <p class="mt-4 text-sm text-brand-muted">Toll free: {{ company.phone_toll_free }}</p>
                <p class="mt-1 text-sm text-brand-muted">Coverage: {{ (company.states_served || []).join(', ') }}</p>
            </aside>
        </section>

        <section class="mx-auto mt-12 max-w-7xl px-4 lg:px-8">
            <div class="surface-card p-6 md:p-8">
                <p class="brand-pill">Our Main Advantages</p>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <article v-for="advantage in home.advantages" :key="advantage" class="rounded-2xl border border-brand-ink/10 bg-white p-4">
                        <p class="text-base text-brand-muted">{{ advantage }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="mx-auto mt-12 max-w-7xl px-4 lg:px-8">
            <div class="mb-6 flex items-end justify-between gap-3">
                <div>
                    <p class="brand-pill">Types of Equipment</p>
                    <h2 class="mt-3 font-display text-3xl font-semibold text-brand-deep">Built for real clinical workflows</h2>
                </div>
                <Link :href="site.urls.equipment" class="btn-secondary">View All</Link>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <article v-for="category in home.categories" :key="category.slug" class="surface-card overflow-hidden">
                    <img :src="category.image" :alt="category.title" class="h-56 w-full object-cover">
                    <div class="p-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ category.subtitle }}</p>
                        <h3 class="mt-2 font-display text-2xl font-semibold text-brand-deep">{{ category.title }}</h3>
                        <Link :href="category.url" class="mt-4 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep">View details</Link>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto mt-12 max-w-7xl px-4 lg:px-8">
            <div class="mb-6">
                <p class="brand-pill">Word on the Street</p>
                <h2 class="mt-3 font-display text-3xl font-semibold text-brand-deep">Customer feedback from the field</h2>
            </div>
            <div class="grid gap-5 lg:grid-cols-3">
                <article v-for="item in home.testimonials" :key="item.author" class="surface-card p-5">
                    <p class="text-sm text-brand-muted">"{{ item.quote }}"</p>
                    <div class="mt-5 flex items-center gap-3">
                        <img :src="item.image" :alt="item.author" class="size-12 rounded-full object-cover">
                        <div>
                            <p class="text-sm font-semibold text-brand-deep">{{ item.author }}</p>
                            <p class="text-xs text-brand-muted">{{ item.location }}</p>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto mt-12 max-w-7xl px-4 pb-4 lg:px-8">
            <PartnersGrid :partners="partners" />
        </section>
    </SiteLayout>
</template>
