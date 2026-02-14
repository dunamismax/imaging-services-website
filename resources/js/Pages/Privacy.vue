<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';

defineProps({
    privacy: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const company = computed(() => page.props.site?.company || {});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-5xl px-4 lg:px-8">
            <p class="brand-pill">Privacy Policy and Terms</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Privacy Policy and Terms of Use</h1>
            <p class="mt-2 text-sm uppercase tracking-[0.12em] text-brand-accent">Effective Date: {{ privacy.effective_date }}</p>

            <article class="surface-card mt-6 p-6">
                <p class="text-base text-brand-muted">{{ privacy.summary }}</p>

                <div v-for="section in privacy.sections" :key="section.title" class="mt-6">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">{{ section.title }}</h2>
                    <ul class="mt-3 space-y-2">
                        <li v-for="line in section.body" :key="line" class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted">
                            {{ line }}
                        </li>
                    </ul>
                </div>

                <div class="mt-6 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
                    <p><strong>{{ company.legal_name }}</strong></p>
                    <p class="mt-1">Phone: {{ company.phone_primary }}</p>
                    <p class="mt-1">Address: {{ company.hq_address }}</p>
                </div>
            </article>
        </section>
    </SiteLayout>
</template>
