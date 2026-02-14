<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';

defineProps({
    payments: {
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
const urls = computed(() => page.props.site?.urls || {});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-5xl px-4 lg:px-8">
            <p class="brand-pill">Payments</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Send deposits and checks to Imaging Services</h1>

            <div class="mt-8 grid gap-5 md:grid-cols-2">
                <article class="surface-card p-6">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">Send Deposits and Checks</h2>
                    <p class="mt-4 text-sm uppercase tracking-[0.14em] text-brand-accent">{{ payments.mailing.company }}</p>
                    <p class="mt-2 text-base text-brand-muted">{{ payments.mailing.address }}</p>
                </article>

                <article class="surface-card p-6">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">{{ payments.bank_transfer.title }}</h2>
                    <p class="mt-3 text-base text-brand-muted">{{ payments.bank_transfer.note }}</p>
                    <Link :href="urls.contact" class="btn-secondary mt-5">Request Transfer Details</Link>
                </article>
            </div>

            <article class="surface-card mt-5 p-6">
                <h2 class="font-display text-2xl font-semibold text-brand-deep">Credit Cards</h2>
                <p class="mt-3 text-base text-brand-muted">{{ payments.card_note }}</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a :href="urls.tollFreeDial" class="btn-primary">Call {{ company.phone_toll_free }}</a>
                    <Link :href="urls.contact" class="btn-secondary">Submit Payment Question</Link>
                </div>
            </article>
        </section>
    </SiteLayout>
</template>
