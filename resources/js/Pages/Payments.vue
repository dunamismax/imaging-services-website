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

        <section class="page-shell page-shell-medium page-section">
            <div class="surface-card p-6 md:p-8">
                <p class="brand-pill">Payments</p>
                <h1 class="mt-4 page-title text-brand-deep">Send deposits and checks to Imaging Services</h1>
                <p class="mt-4 max-w-3xl page-body">Need help choosing the right payment method? Contact our team before sending funds and we will route you to the correct process.</p>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-2">
                <article class="surface-card p-6">
                    <h2 class="card-title text-brand-deep">Send Deposits and Checks</h2>
                    <p class="mt-4 text-sm uppercase tracking-[0.14em] text-brand-accent">{{ payments.mailing.company }}</p>
                    <p class="mt-2 page-body">{{ payments.mailing.address }}</p>
                </article>

                <article class="surface-card p-6">
                    <h2 class="card-title text-brand-deep">{{ payments.bank_transfer.title }}</h2>
                    <p class="mt-3 page-body">{{ payments.bank_transfer.note }}</p>
                    <Link :href="urls.contact" class="btn-secondary mt-5">Request Transfer Details</Link>
                </article>
            </div>

            <article class="surface-card mt-5 p-6">
                <h2 class="card-title text-brand-deep">Credit Cards</h2>
                <p class="mt-3 page-body">{{ payments.card_note }}</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a :href="urls.tollFreeDial" class="btn-primary">Call {{ company.phone_toll_free }}</a>
                    <Link :href="urls.contact" class="btn-secondary">Submit Payment Question</Link>
                </div>
            </article>
        </section>
    </SiteLayout>
</template>
