<script setup>
import { computed, reactive, ref } from 'vue';

const props = defineProps({
    endpoint: {
        type: String,
        required: true,
    },
    options: {
        type: Array,
        default: () => [],
    },
    optionsField: {
        type: String,
        required: true,
    },
    optionsLegend: {
        type: String,
        required: true,
    },
    buttonLabel: {
        type: String,
        required: true,
    },
    pillLabel: {
        type: String,
        required: true,
    },
    headingLabel: {
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
    [props.optionsField]: [],
});

const isSubmitting = ref(false);
const submitted = ref(false);
const resolvedSuccessMessage = ref(props.successMessage);
const formError = ref('');
const errors = ref({});
const idPrefix = computed(() => props.optionsField.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase());

function fieldError(field) {
    const messages = errors.value?.[field];

    return Array.isArray(messages) && messages.length > 0 ? String(messages[0]) : '';
}

const optionsError = computed(() => {
    const directError = fieldError(props.optionsField);

    if (directError) {
        return directError;
    }

    for (const [field, messages] of Object.entries(errors.value || {})) {
        if (!field.startsWith(`${props.optionsField}.`) || !Array.isArray(messages) || messages.length === 0) {
            continue;
        }

        return String(messages[0]);
    }

    return '';
});

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
    form[props.optionsField] = [];
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
        const payload = {
            name: form.name,
            phone: form.phone,
            email: form.email,
            company: form.company,
            notes: form.notes,
            [props.optionsField]: form[props.optionsField],
        };

        const response = await window.axios.post(props.endpoint, payload);

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
        <p class="brand-pill">{{ pillLabel }}</p>
        <h3 class="mt-2 card-title text-brand-deep">{{ headingLabel }}</h3>

        <div v-if="submitted" class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ resolvedSuccessMessage }}
        </div>

        <div v-if="formError" class="mt-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
            {{ formError }}
        </div>

        <form class="mt-5 space-y-4" novalidate @submit.prevent="submitForm">
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label :for="`${idPrefix}-name`" class="form-label">Your Name</label>
                    <input :id="`${idPrefix}-name`" v-model="form.name" type="text" class="form-field" maxlength="60">
                    <p v-if="fieldError('name')" class="mt-1 text-sm text-red-600">{{ fieldError('name') }}</p>
                </div>
                <div>
                    <label :for="`${idPrefix}-company`" class="form-label">Your Company</label>
                    <input :id="`${idPrefix}-company`" v-model="form.company" type="text" class="form-field" maxlength="60">
                    <p v-if="fieldError('company')" class="mt-1 text-sm text-red-600">{{ fieldError('company') }}</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label :for="`${idPrefix}-phone`" class="form-label">Your Phone Number</label>
                    <input :id="`${idPrefix}-phone`" v-model="form.phone" type="text" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                    <p v-if="fieldError('phone')" class="mt-1 text-sm text-red-600">{{ fieldError('phone') }}</p>
                </div>
                <div>
                    <label :for="`${idPrefix}-email`" class="form-label">Your Best Email</label>
                    <input :id="`${idPrefix}-email`" v-model="form.email" type="email" class="form-field" maxlength="255">
                    <p v-if="fieldError('email')" class="mt-1 text-sm text-red-600">{{ fieldError('email') }}</p>
                </div>
            </div>

            <fieldset>
                <legend class="form-label">{{ optionsLegend }}</legend>
                <div class="grid gap-2 sm:grid-cols-2">
                    <label
                        v-for="option in options"
                        :key="option"
                        class="flex items-start gap-2 rounded-xl border border-brand-ink/10 bg-site-panel px-3 py-2 text-sm text-brand-muted transition hover:border-brand-ink/20"
                    >
                        <input
                            v-model="form[optionsField]"
                            type="checkbox"
                            :value="option"
                            class="mt-0.5 size-4 rounded border-brand-ink/20 text-brand-accent"
                        >
                        <span>{{ option }}</span>
                    </label>
                </div>
                <p v-if="optionsError" class="mt-1 text-sm text-red-600">{{ optionsError }}</p>
            </fieldset>

            <div>
                <label :for="`${idPrefix}-notes`" class="form-label">Anything Else?</label>
                <textarea :id="`${idPrefix}-notes`" v-model="form.notes" class="form-field min-h-24" maxlength="1000"></textarea>
                <p v-if="fieldError('notes')" class="mt-1 text-sm text-red-600">{{ fieldError('notes') }}</p>
            </div>

            <button type="submit" class="btn-primary w-full" :disabled="isSubmitting">
                {{ isSubmitting ? 'Sending...' : buttonLabel }}
            </button>
        </form>
    </div>
</template>
