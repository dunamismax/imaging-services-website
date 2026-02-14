<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';
import SelectableRequestForm from '../Components/forms/SelectableRequestForm.vue';

defineProps({
    services: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const forms = computed(() => page.props.site?.forms || {});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <p class="brand-pill">Services and Training</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">On-site and remote support to keep your systems operational</h1>
            <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ services.intro }}</p>
        </section>

        <section class="mx-auto mt-8 max-w-7xl px-4 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <article class="surface-card p-6 md:p-8">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">Service Options</h2>
                    <ul class="mt-4 space-y-2">
                        <li v-for="option in services.service_options" :key="option" class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted">
                            {{ option }}
                        </li>
                    </ul>
                </article>

                <article class="surface-card p-6 md:p-8">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">Training Focus Areas</h2>
                    <ul class="mt-4 space-y-2">
                        <li v-for="option in services.training_options" :key="option" class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted">
                            {{ option }}
                        </li>
                    </ul>
                    <p class="mt-5 text-sm text-brand-muted">{{ services.parts_summary }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span v-for="brand in services.brands" :key="brand" class="rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold uppercase tracking-wide text-brand-accent">
                            {{ brand }}
                        </span>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-2">
                <SelectableRequestForm
                    :endpoint="forms.serviceRequest"
                    :options="services.service_options"
                    options-field="serviceOptions"
                    options-legend="Select one or more options"
                    button-label="Request Service"
                    pill-label="Service Request"
                    heading-label="Request our service"
                    success-message="We received your message and a member of our services team will reach out within one business day."
                />
                <SelectableRequestForm
                    :endpoint="forms.trainingRequest"
                    :options="services.training_options"
                    options-field="trainingOptions"
                    options-legend="Select one or more training options"
                    button-label="Request Training"
                    pill-label="Training Request"
                    heading-label="Request training"
                    success-message="We received your message and a member of our training team will reach out within one business day."
                />
            </div>
        </section>
    </SiteLayout>
</template>
