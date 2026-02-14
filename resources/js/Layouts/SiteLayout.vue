<script setup>
import { computed, onMounted, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const themeStorageKey = 'site-theme';
const page = usePage();
const mobileMenuOpen = ref(false);
const isDarkTheme = ref(false);

const site = computed(() => page.props.site || {});
const routing = computed(() => page.props.routing || {});
const company = computed(() => site.value.company || {});
const navigation = computed(() => site.value.navigation || []);
const quickLinks = computed(() => site.value.quickLinks || []);
const urls = computed(() => site.value.urls || {});
const logoUrl = '/site-assets/images/home/logo.svg';
const themeLabel = computed(() => (isDarkTheme.value ? 'Dark' : 'Light'));
const currentYear = computed(() => new Date().getFullYear());

onMounted(() => {
    isDarkTheme.value = document.documentElement.classList.contains('dark');
});

function isActive(routeName) {
    const currentRoute = routing.value.currentRoute;

    return currentRoute === routeName
        || (routeName === 'contact' && currentRoute === 'contact.alias')
        || (routeName === 'privacy' && currentRoute === 'privacy.legacy');
}

function closeMobileMenu() {
    mobileMenuOpen.value = false;
}

function applyTheme(isDark) {
    document.documentElement.classList.toggle('dark', isDark);
    isDarkTheme.value = isDark;

    try {
        window.localStorage.setItem(themeStorageKey, isDark ? 'dark' : 'light');
    } catch {}
}

function toggleTheme() {
    applyTheme(!isDarkTheme.value);
}
</script>

<template>
    <div class="min-h-screen">
        <header class="site-header sticky top-0 z-40 border-b border-brand-ink/10 backdrop-blur-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 lg:px-8">
                <Link :href="navigation[0]?.url || '/'" class="flex items-center gap-3" @click="closeMobileMenu">
                    <img :src="logoUrl" alt="Imaging Services logo" class="h-10 w-auto">
                    <div>
                        <p class="font-display text-lg font-bold tracking-wide text-brand-deep">{{ company.name }}</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-brand-accent">Imaging Services USA</p>
                    </div>
                </Link>

                <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
                    <Link
                        v-for="item in navigation"
                        :key="item.routeName"
                        :href="item.url"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition"
                        :class="isActive(item.routeName) ? 'bg-brand-deep text-white shadow-sm' : 'text-brand-muted hover:bg-brand-soft hover:text-brand-deep'"
                    >
                        {{ item.label }}
                    </Link>
                </nav>

                <div class="hidden items-center gap-2 lg:flex">
                    <button
                        type="button"
                        class="theme-toggle"
                        :aria-pressed="isDarkTheme"
                        :aria-label="`Switch to ${isDarkTheme ? 'light' : 'dark'} theme`"
                        @click="toggleTheme"
                    >
                        {{ themeLabel }}
                        <span class="theme-toggle-switch" aria-hidden="true">
                            <span class="theme-toggle-thumb" :class="isDarkTheme ? 'translate-x-4' : ''"></span>
                        </span>
                    </button>
                    <a :href="urls.tollFreeDial" class="btn-secondary">{{ urls.tollFreePhone }}</a>
                    <Link :href="urls.payments" class="btn-primary">Payments</Link>
                </div>

                <button
                    type="button"
                    class="rounded-full border border-brand-ink/20 px-4 py-2 text-sm font-semibold text-brand-deep lg:hidden"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                >
                    Menu
                </button>
            </div>

            <div v-if="mobileMenuOpen" class="border-t border-brand-ink/10 bg-white p-4 lg:hidden">
                <div class="mx-auto flex max-w-7xl flex-col gap-2">
                    <button
                        type="button"
                        class="theme-toggle self-start"
                        :aria-pressed="isDarkTheme"
                        :aria-label="`Switch to ${isDarkTheme ? 'light' : 'dark'} theme`"
                        @click="toggleTheme"
                    >
                        {{ themeLabel }}
                        <span class="theme-toggle-switch" aria-hidden="true">
                            <span class="theme-toggle-thumb" :class="isDarkTheme ? 'translate-x-4' : ''"></span>
                        </span>
                    </button>
                    <Link
                        v-for="item in navigation"
                        :key="`mobile-${item.routeName}`"
                        :href="item.url"
                        class="rounded-xl px-3 py-2 text-sm font-medium"
                        :class="isActive(item.routeName) ? 'bg-brand-deep text-white' : 'text-brand-muted hover:bg-brand-soft hover:text-brand-deep'"
                        @click="closeMobileMenu"
                    >
                        {{ item.label }}
                    </Link>
                    <Link :href="urls.payments" class="rounded-xl bg-brand-deep px-3 py-2 text-sm font-semibold text-white" @click="closeMobileMenu">Payments</Link>
                    <a :href="urls.tollFreeDial" class="rounded-xl border border-brand-ink/20 px-3 py-2 text-sm font-semibold text-brand-deep">{{ urls.tollFreePhone }}</a>
                </div>
            </div>
        </header>

        <main>
            <slot />
        </main>

        <footer class="mt-20 border-t border-brand-ink/10 bg-brand-deep text-brand-soft">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-14 lg:grid-cols-3 lg:px-8">
                <div>
                    <p class="font-display text-2xl font-bold">{{ company.name }}</p>
                    <p class="mt-3 max-w-md text-sm text-brand-soft/85">{{ company.tagline }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">Contact</p>
                    <p class="mt-3 text-sm">Toll Free: {{ company.phone_toll_free }}</p>
                    <p class="mt-1 text-sm">Main: {{ company.phone_primary }}</p>
                    <p class="mt-1 text-sm">Orders: {{ company.email_orders }}</p>
                    <p class="mt-1 text-sm">HQ: {{ company.hq_address }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">Quick Links</p>
                    <div class="mt-3 flex flex-wrap gap-2 text-sm">
                        <Link
                            v-for="link in quickLinks"
                            :key="link.label"
                            :href="link.url"
                            class="rounded-full border border-brand-soft/30 px-3 py-1.5 transition hover:bg-brand-soft hover:text-brand-deep"
                        >
                            {{ link.label }}
                        </Link>
                    </div>
                </div>
            </div>
            <div class="border-t border-brand-soft/20">
                <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 text-xs text-brand-soft/85 lg:px-8">
                    <p>&copy; {{ currentYear }} {{ company.legal_name || company.name }}. All rights reserved.</p>
                    <Link :href="urls.privacy" class="hover:text-white">Privacy Policy</Link>
                </div>
            </div>
        </footer>
    </div>
</template>
