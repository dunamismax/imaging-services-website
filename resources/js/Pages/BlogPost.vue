<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const urls = computed(() => page.props.site?.urls || {});
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-4xl px-4 lg:px-8">
            <Link :href="post.backUrl" class="text-sm font-semibold text-brand-accent hover:text-brand-deep">&larr; Back to Media</Link>

            <article class="surface-card mt-4 p-6 md:p-8">
                <p class="brand-pill">{{ post.published }}</p>
                <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">{{ post.title }}</h1>
                <p class="mt-4 text-lg text-brand-muted">{{ post.summary }}</p>

                <div class="mt-6 space-y-4 text-base leading-relaxed text-brand-muted">
                    <p v-for="paragraph in post.content" :key="paragraph">{{ paragraph }}</p>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <Link :href="urls.contact" class="btn-primary">Talk to Our Team</Link>
                    <Link :href="urls.equipment" class="btn-secondary">Explore Equipment</Link>
                </div>
            </article>
        </section>
    </SiteLayout>
</template>
