<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';
import ContactSalesForm from '../Components/forms/ContactSalesForm.vue';
import SelectableRequestForm from '../Components/forms/SelectableRequestForm.vue';

const props = defineProps({
    contact: {
        type: Object,
        required: true,
    },
    serviceOptions: {
        type: Array,
        default: () => [],
    },
    trainingOptions: {
        type: Array,
        default: () => [],
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
const forms = computed(() => site.value.forms || {});
const supportContacts = computed(() => props.contact.support_contacts || []);

function dial(phoneNumber) {
    return `tel:${String(phoneNumber).replace(/[^\d+]/g, '')}`;
}

function email(emailAddress) {
    return `mailto:${emailAddress}`;
}
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <p class="brand-pill">Contact Us</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">{{ contact.headline }}</h1>
            <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ contact.subhead }}</p>
        </section>

        <section class="mx-auto mt-8 max-w-7xl px-4 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <article class="surface-card p-6 lg:col-span-2">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">Branch Locations</h2>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div v-for="(address, state) in contact.locations" :key="state" class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3">
                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ state }}</p>
                            <p class="mt-1 text-sm text-brand-muted">{{ address }}</p>
                        </div>
                    </div>

                    <h3 class="mt-6 font-display text-xl font-semibold text-brand-deep">Speak to Principals Directly</h3>
                    <div class="mt-3 flex flex-wrap gap-3">
                        <a
                            v-for="person in contact.principals"
                            :key="person.name"
                            :href="dial(person.phone)"
                            class="btn-secondary"
                        >
                            {{ person.name }}: {{ person.phone }}
                        </a>
                    </div>

                    <h3 class="mt-6 font-display text-xl font-semibold text-brand-deep">Contact Team</h3>
                    <div class="mt-3 grid gap-3 sm:grid-cols-2">
                        <article
                            v-for="person in supportContacts"
                            :key="person.email"
                            class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3"
                        >
                            <p class="text-sm font-semibold text-brand-deep">{{ person.name }}</p>
                            <p class="text-xs uppercase tracking-[0.12em] text-brand-accent">{{ person.role }}</p>
                            <a :href="email(person.email)" class="mt-2 block text-sm text-brand-muted hover:text-brand-deep">{{ person.email }}</a>
                            <a v-if="person.phone" :href="dial(person.phone)" class="mt-1 block text-sm text-brand-muted hover:text-brand-deep">{{ person.phone }}</a>
                        </article>
                    </div>

                    <div class="mt-5 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
                        <p>Toll Free: {{ company.phone_toll_free }}</p>
                        <p class="mt-1">Email Orders: {{ company.email_orders }}</p>
                        <p class="mt-1">Working Hours: Mon-Fri 8:30 am - 5 pm</p>
                    </div>
                </article>

                <div class="surface-card p-6">
                    <h2 class="font-display text-xl font-semibold text-brand-deep">Working Hours</h2>
                    <dl class="mt-4 space-y-2 text-sm">
                        <div v-for="slot in hours" :key="slot.day" class="flex items-center justify-between border-b border-brand-ink/10 pb-2">
                            <dt class="font-semibold uppercase tracking-wide text-brand-muted">{{ slot.day }}</dt>
                            <dd class="text-brand-deep">{{ slot.hours }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-2">
                <ContactSalesForm
                    :endpoint="forms.contactSales"
                    success-message="We received your message and a member of our sales team will reach out within one business day."
                />
                <SelectableRequestForm
                    :endpoint="forms.serviceRequest"
                    :options="serviceOptions"
                    options-field="serviceOptions"
                    options-legend="Select one or more options"
                    button-label="Request Service"
                    pill-label="Service Request"
                    heading-label="Request our service"
                    success-message="We received your message and a member of our services team will reach out within one business day."
                />
            </div>
        </section>

        <section class="mx-auto mt-6 max-w-7xl px-4 lg:px-8">
            <SelectableRequestForm
                :endpoint="forms.trainingRequest"
                :options="trainingOptions"
                options-field="trainingOptions"
                options-legend="Select one or more training options"
                button-label="Request Training"
                pill-label="Training Request"
                heading-label="Request training"
                success-message="We received your message and a member of our training team will reach out within one business day."
            />
        </section>
    </SiteLayout>
</template>
