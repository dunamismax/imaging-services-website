<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import SiteLayout from '../Layouts/SiteLayout.vue';
import PageMeta from '../Components/site/PageMeta.vue';

const props = defineProps({
    posts: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});

const orderedPosts = computed(() => Object.entries(props.posts).map(([slug, post]) => ({
    slug,
    ...post,
})));
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
            <p class="brand-pill">Media</p>
            <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Digital imaging latest news and insights</h1>
            <p class="mt-4 max-w-3xl text-lg text-brand-muted">Browse archived and current media content from Imaging Services.</p>
        </section>

        <section class="mx-auto mt-10 max-w-7xl px-4 pb-4 lg:px-8">
            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                <article v-for="post in orderedPosts" :key="post.slug" class="surface-card p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ post.published }}</p>
                    <h2 class="mt-3 font-display text-2xl font-semibold text-brand-deep">{{ post.title }}</h2>
                    <p class="mt-3 text-sm text-brand-muted">{{ post.summary }}</p>
                    <Link :href="post.url" class="mt-4 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep">Read article</Link>
                </article>
            </div>
        </section>
    </SiteLayout>
</template>
