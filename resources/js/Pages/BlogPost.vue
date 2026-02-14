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
const sections = computed(() => (Array.isArray(props.post.sections) ? props.post.sections : []));
</script>

<template>
    <SiteLayout>
        <PageMeta :meta="meta" />

        <section class="page-shell page-shell-narrow page-section">
            <Link :href="post.backUrl" class="text-sm font-semibold text-brand-accent hover:text-brand-deep">&larr; Back to Media</Link>

            <article class="surface-card mt-4 p-6 md:p-8">
                <p class="brand-pill">{{ post.published }}</p>
                <h1 class="mt-4 page-title text-brand-deep">{{ post.title }}</h1>
                <p class="mt-4 page-lead">{{ post.summary }}</p>

                <div class="mt-6 space-y-4 reading-body">
                    <p v-for="paragraph in post.content" :key="paragraph">{{ paragraph }}</p>
                </div>

                <div v-if="sections.length" class="mt-8 space-y-8">
                    <section
                        v-for="(section, index) in sections"
                        :key="`${section.title}-${index}`"
                        class="rounded-2xl border border-brand-ink/10 bg-site-panel px-4 py-5 md:px-5"
                    >
                        <h2 class="card-title text-brand-deep">{{ section.title }}</h2>
                        <div v-if="section.paragraphs?.length" class="mt-3 space-y-3 reading-body">
                            <p v-for="paragraph in section.paragraphs" :key="paragraph">{{ paragraph }}</p>
                        </div>
                        <ul v-if="section.bullets?.length" class="mt-4 space-y-2">
                            <li
                                v-for="bullet in section.bullets"
                                :key="bullet"
                                class="rounded-xl border border-brand-ink/10 bg-brand-soft px-3 py-2 text-sm text-brand-muted"
                            >
                                {{ bullet }}
                            </li>
                        </ul>
                    </section>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <Link :href="urls.contact" class="btn-primary">Talk to Our Team</Link>
                    <Link :href="urls.equipment" class="btn-secondary">Explore Equipment</Link>
                </div>
            </article>
        </section>
    </SiteLayout>
</template>
