import { computed, createApp, reactive, ref } from 'vue/dist/vue.esm-bundler.js';

function firstError(errors, key) {
    if (!errors || typeof errors !== 'object') {
        return '';
    }

    const messages = errors[key];

    if (Array.isArray(messages) && messages.length > 0) {
        return String(messages[0]);
    }

    return '';
}

function firstErrorWithPrefix(errors, prefix) {
    if (!errors || typeof errors !== 'object') {
        return '';
    }

    for (const [key, messages] of Object.entries(errors)) {
        if (!key.startsWith(prefix)) {
            continue;
        }

        if (Array.isArray(messages) && messages.length > 0) {
            return String(messages[0]);
        }
    }

    return '';
}

function normalizeErrors(error) {
    const fallbackMessage = 'Something went wrong. Please try again in a moment.';
    const payload = error?.response?.data;

    if (!payload || typeof payload !== 'object') {
        return {
            errors: {},
            formError: fallbackMessage,
        };
    }

    const rawErrors = payload.errors && typeof payload.errors === 'object' ? payload.errors : {};
    const errors = {};

    for (const [field, messages] of Object.entries(rawErrors)) {
        if (Array.isArray(messages)) {
            errors[field] = messages.map((message) => String(message));
        }
    }

    return {
        errors,
        formError: firstError(errors, 'form') || (typeof payload.message === 'string' ? payload.message : fallbackMessage),
    };
}

async function postForm(endpoint, payload) {
    if (window.axios) {
        return window.axios.post(endpoint, payload, {
            headers: {
                Accept: 'application/json',
            },
        });
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const response = await fetch(endpoint, {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
        },
        body: JSON.stringify(payload),
        credentials: 'same-origin',
    });

    if (!response.ok) {
        const error = new Error('Request failed');
        let data;

        try {
            data = await response.json();
        } catch {
            data = null;
        }

        error.response = {
            status: response.status,
            data,
        };

        throw error;
    }

    return {
        data: await response.json(),
    };
}

function parseOptions(rawOptions) {
    if (!rawOptions) {
        return [];
    }

    try {
        const parsed = JSON.parse(rawOptions);

        if (!Array.isArray(parsed)) {
            return [];
        }

        return parsed.filter((option) => typeof option === 'string');
    } catch {
        return [];
    }
}

function mountContactSalesForms() {
    document.querySelectorAll('.js-contact-sales-form').forEach((el) => {
        const endpoint = el.dataset.endpoint || '';
        const initialSuccessMessage = el.dataset.successMessage || 'Your request has been submitted.';

        createApp({
            setup() {
                const form = reactive({
                    name: '',
                    phone: '',
                    email: '',
                    company: '',
                    notes: '',
                });

                const errors = ref({});
                const formError = ref('');
                const submitted = ref(false);
                const isSubmitting = ref(false);
                const successMessage = ref(initialSuccessMessage);

                function resetForm() {
                    form.name = '';
                    form.phone = '';
                    form.email = '';
                    form.company = '';
                    form.notes = '';
                }

                function errorFor(field) {
                    return firstError(errors.value, field);
                }

                async function submit() {
                    if (isSubmitting.value || !endpoint) {
                        return;
                    }

                    submitted.value = false;
                    errors.value = {};
                    formError.value = '';
                    isSubmitting.value = true;

                    try {
                        const response = await postForm(endpoint, {
                            name: form.name,
                            phone: form.phone,
                            email: form.email,
                            company: form.company,
                            notes: form.notes,
                        });

                        if (typeof response?.data?.message === 'string' && response.data.message.length > 0) {
                            successMessage.value = response.data.message;
                        }

                        resetForm();
                        submitted.value = true;
                    } catch (error) {
                        const normalized = normalizeErrors(error);

                        errors.value = normalized.errors;
                        formError.value = normalized.formError;
                    } finally {
                        isSubmitting.value = false;
                    }
                }

                return {
                    form,
                    errors,
                    formError,
                    submitted,
                    isSubmitting,
                    successMessage,
                    errorFor,
                    submit,
                };
            },
            template: `
                <div class="surface-card p-6">
                    <div class="mb-6 flex items-center justify-between gap-3">
                        <div>
                            <p class="brand-pill">Contact Sales</p>
                            <h3 class="mt-2 font-display text-2xl font-semibold text-brand-deep">Request more information</h3>
                        </div>
                    </div>

                    <div v-if="submitted" class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ successMessage }}
                    </div>

                    <div v-if="formError" class="mb-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                        {{ formError }}
                    </div>

                    <form class="space-y-4" @submit.prevent="submit" novalidate>
                        <div>
                            <label for="sales-name" class="form-label">Your Name</label>
                            <input id="sales-name" v-model="form.name" type="text" class="form-field" maxlength="60">
                            <p v-if="errorFor('name')" class="mt-1 text-sm text-red-600">{{ errorFor('name') }}</p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="sales-phone" class="form-label">Your Phone Number</label>
                                <input id="sales-phone" v-model="form.phone" type="text" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                                <p v-if="errorFor('phone')" class="mt-1 text-sm text-red-600">{{ errorFor('phone') }}</p>
                            </div>
                            <div>
                                <label for="sales-email" class="form-label">Your Best Email</label>
                                <input id="sales-email" v-model="form.email" type="email" class="form-field" maxlength="255">
                                <p v-if="errorFor('email')" class="mt-1 text-sm text-red-600">{{ errorFor('email') }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="sales-company" class="form-label">Your Company (Optional)</label>
                            <input id="sales-company" v-model="form.company" type="text" class="form-field" maxlength="60">
                            <p v-if="errorFor('company')" class="mt-1 text-sm text-red-600">{{ errorFor('company') }}</p>
                        </div>

                        <div>
                            <label for="sales-notes" class="form-label">Anything Else of Note?</label>
                            <textarea id="sales-notes" v-model="form.notes" class="form-field min-h-28" maxlength="1000"></textarea>
                            <p v-if="errorFor('notes')" class="mt-1 text-sm text-red-600">{{ errorFor('notes') }}</p>
                        </div>

                        <button type="submit" class="btn-primary w-full" :disabled="isSubmitting">
                            {{ isSubmitting ? 'Sending...' : 'Contact Sales' }}
                        </button>
                    </form>
                </div>
            `,
        }).mount(el);
    });
}

function mountSelectableForms(config) {
    document.querySelectorAll(config.selector).forEach((el) => {
        const endpoint = el.dataset.endpoint || '';
        const initialSuccessMessage = el.dataset.successMessage || 'Your request has been submitted.';
        const availableOptions = parseOptions(el.dataset.options);

        createApp({
            setup() {
                const form = reactive({
                    name: '',
                    phone: '',
                    email: '',
                    company: '',
                    [config.optionsField]: [],
                    notes: '',
                });

                const options = ref(availableOptions);
                const errors = ref({});
                const formError = ref('');
                const submitted = ref(false);
                const isSubmitting = ref(false);
                const successMessage = ref(initialSuccessMessage);

                const optionsError = computed(() => {
                    return firstError(errors.value, config.optionsField)
                        || firstErrorWithPrefix(errors.value, `${config.optionsField}.`);
                });

                function resetForm() {
                    form.name = '';
                    form.phone = '';
                    form.email = '';
                    form.company = '';
                    form[config.optionsField] = [];
                    form.notes = '';
                }

                function errorFor(field) {
                    return firstError(errors.value, field);
                }

                async function submit() {
                    if (isSubmitting.value || !endpoint) {
                        return;
                    }

                    submitted.value = false;
                    errors.value = {};
                    formError.value = '';
                    isSubmitting.value = true;

                    try {
                        const payload = {
                            name: form.name,
                            phone: form.phone,
                            email: form.email,
                            company: form.company,
                            notes: form.notes,
                        };

                        payload[config.optionsField] = form[config.optionsField];

                        const response = await postForm(endpoint, payload);

                        if (typeof response?.data?.message === 'string' && response.data.message.length > 0) {
                            successMessage.value = response.data.message;
                        }

                        resetForm();
                        submitted.value = true;
                    } catch (error) {
                        const normalized = normalizeErrors(error);

                        errors.value = normalized.errors;
                        formError.value = normalized.formError;
                    } finally {
                        isSubmitting.value = false;
                    }
                }

                return {
                    form,
                    options,
                    errors,
                    formError,
                    submitted,
                    isSubmitting,
                    successMessage,
                    optionsField: config.optionsField,
                    optionsLegend: config.optionsLegend,
                    buttonLabel: config.buttonLabel,
                    pillLabel: config.pillLabel,
                    headingLabel: config.headingLabel,
                    optionsError,
                    errorFor,
                    submit,
                };
            },
            template: `
                <div class="surface-card p-6">
                    <p class="brand-pill">{{ pillLabel }}</p>
                    <h3 class="mt-2 font-display text-2xl font-semibold text-brand-deep">{{ headingLabel }}</h3>

                    <div v-if="submitted" class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ successMessage }}
                    </div>

                    <div v-if="formError" class="mt-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                        {{ formError }}
                    </div>

                    <form class="mt-5 space-y-4" @submit.prevent="submit" novalidate>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label :for="optionsField + '-name'" class="form-label">Your Name</label>
                                <input :id="optionsField + '-name'" v-model="form.name" type="text" class="form-field" maxlength="60">
                                <p v-if="errorFor('name')" class="mt-1 text-sm text-red-600">{{ errorFor('name') }}</p>
                            </div>
                            <div>
                                <label :for="optionsField + '-company'" class="form-label">Your Company</label>
                                <input :id="optionsField + '-company'" v-model="form.company" type="text" class="form-field" maxlength="60">
                                <p v-if="errorFor('company')" class="mt-1 text-sm text-red-600">{{ errorFor('company') }}</p>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label :for="optionsField + '-phone'" class="form-label">Your Phone Number</label>
                                <input :id="optionsField + '-phone'" v-model="form.phone" type="text" class="form-field" maxlength="18" placeholder="(000) 000-0000">
                                <p v-if="errorFor('phone')" class="mt-1 text-sm text-red-600">{{ errorFor('phone') }}</p>
                            </div>
                            <div>
                                <label :for="optionsField + '-email'" class="form-label">Your Best Email</label>
                                <input :id="optionsField + '-email'" v-model="form.email" type="email" class="form-field" maxlength="255">
                                <p v-if="errorFor('email')" class="mt-1 text-sm text-red-600">{{ errorFor('email') }}</p>
                            </div>
                        </div>

                        <fieldset>
                            <legend class="form-label">{{ optionsLegend }}</legend>
                            <div class="grid gap-2 sm:grid-cols-2">
                                <label v-for="option in options" :key="option" class="flex items-start gap-2 rounded-xl border border-brand-ink/10 bg-white px-3 py-2 text-sm text-brand-muted">
                                    <input v-model="form[optionsField]" type="checkbox" :value="option" class="mt-0.5 size-4 rounded border-brand-ink/20 text-brand-accent">
                                    <span>{{ option }}</span>
                                </label>
                            </div>
                            <p v-if="optionsError" class="mt-1 text-sm text-red-600">{{ optionsError }}</p>
                        </fieldset>

                        <div>
                            <label :for="optionsField + '-notes'" class="form-label">Anything Else?</label>
                            <textarea :id="optionsField + '-notes'" v-model="form.notes" class="form-field min-h-24" maxlength="1000"></textarea>
                            <p v-if="errorFor('notes')" class="mt-1 text-sm text-red-600">{{ errorFor('notes') }}</p>
                        </div>

                        <button type="submit" class="btn-primary w-full" :disabled="isSubmitting">
                            {{ isSubmitting ? 'Sending...' : buttonLabel }}
                        </button>
                    </form>
                </div>
            `,
        }).mount(el);
    });
}

function initSiteForms() {
    mountContactSalesForms();
    mountSelectableForms({
        selector: '.js-service-request-form',
        optionsField: 'serviceOptions',
        optionsLegend: 'Select one or more options',
        buttonLabel: 'Request Service',
        pillLabel: 'Service Request',
        headingLabel: 'Request our service',
    });
    mountSelectableForms({
        selector: '.js-training-request-form',
        optionsField: 'trainingOptions',
        optionsLegend: 'Select one or more training options',
        buttonLabel: 'Request Training',
        pillLabel: 'Training Request',
        headingLabel: 'Request training',
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSiteForms, { once: true });
} else {
    initSiteForms();
}
