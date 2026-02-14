<script setup>
import { reactive, ref } from 'vue';

const props = defineProps({
    endpoint: {
        type: String,
        required: true,
    },
    successMessage: {
        type: String,
        default: 'Your request has been submitted.',
    },
});

const form = reactive({
    name: '',
    phone: '',
    email: '',
    company: '',
    notes: '',
});

const isSubmitting = ref(false);
const submitted = ref(false);
const resolvedSuccessMessage = ref(props.successMessage);
const formError = ref('');
const errors = ref({});

function fieldError(field) {
    const messages = errors.value?.[field];

    return Array.isArray(messages) && messages.length > 0 ? String(messages[0]) : '';
}

function normalizeErrors(error) {
    const payload = error?.response?.data;

    if (!payload || typeof payload !== 'object') {
        return {
            errors: {},
            formMessage: 'Something went wrong. Please try again in a moment.',
        };
    }

    const normalized = {};
    const payloadErrors = payload.errors && typeof payload.errors === 'object' ? payload.errors : {};

    for (const [field, messages] of Object.entries(payloadErrors)) {
        if (Array.isArray(messages)) {
            normalized[field] = messages.map((message) => String(message));
        }
    }

    return {
        errors: normalized,
        formMessage: normalized.form?.[0] || payload.message || 'Something went wrong. Please try again in a moment.',
    };
}

function resetForm() {
    form.name = '';
    form.phone = '';
    form.email = '';
    form.company = '';
    form.notes = '';
}

async function submitForm() {
    if (isSubmitting.value) {
        return;
    }

    submitted.value = false;
    formError.value = '';
    errors.value = {};
    isSubmitting.value = true;

    try {
        const response = await window.axios.post(props.endpoint, {
            name: form.name,
            phone: form.phone,
            email: form.email,
            company: form.company,
            notes: form.notes,
        });

        if (typeof response?.data?.message === 'string' && response.data.message.length > 0) {
            resolvedSuccessMessage.value = response.data.message;
        }

        resetForm();
        submitted.value = true;
    } catch (error) {
        const normalized = normalizeErrors(error);

        errors.value = normalized.errors;
        formError.value = normalized.formMessage;
    } finally {
        isSubmitting.value = false;
    }
}
</script>

<template>
    <div class="surface-card p-6">
        <div class="mb-6 flex items-center justify-between gap-3">
            <div>
                <p class="brand-pill">Contact Sales</p>
                <h3 class="mt-2 font-display text-2xl font-semibold text-brand-deep">Request more information</h3>
            </div>
        </div>

        <div v-if="submitted" class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ resolvedSuccessMessage }}
        </div>

        <div v-if="formError" class="mb-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
            {{ formError }}
        </div>

        <form class="space-y-4" novalidate @submit.prevent="submitForm">
            <div>
                <label for="sales-name" class="form-label">Your Name</label>
                <input id="sales-name" v-model="form.name" type="text" class="form-field" maxlength="60">
                <p v-if="fieldError('name')" class="mt-1 text-sm text-red-600">{{ fieldError('name') }}</p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="sales-phone" class="form-label">Your Phone Number</label>
                    <input id="sales-phone" v-model="form.phone" type="text" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                    <p v-if="fieldError('phone')" class="mt-1 text-sm text-red-600">{{ fieldError('phone') }}</p>
                </div>
                <div>
                    <label for="sales-email" class="form-label">Your Best Email</label>
                    <input id="sales-email" v-model="form.email" type="email" class="form-field" maxlength="255">
                    <p v-if="fieldError('email')" class="mt-1 text-sm text-red-600">{{ fieldError('email') }}</p>
                </div>
            </div>

            <div>
                <label for="sales-company" class="form-label">Your Company (Optional)</label>
                <input id="sales-company" v-model="form.company" type="text" class="form-field" maxlength="60">
                <p v-if="fieldError('company')" class="mt-1 text-sm text-red-600">{{ fieldError('company') }}</p>
            </div>

            <div>
                <label for="sales-notes" class="form-label">Anything Else of Note?</label>
                <textarea id="sales-notes" v-model="form.notes" class="form-field min-h-28" maxlength="1000"></textarea>
                <p v-if="fieldError('notes')" class="mt-1 text-sm text-red-600">{{ fieldError('notes') }}</p>
            </div>

            <button type="submit" class="btn-primary w-full" :disabled="isSubmitting">
                {{ isSubmitting ? 'Sending...' : 'Contact Sales' }}
            </button>
        </form>
    </div>
</template>
