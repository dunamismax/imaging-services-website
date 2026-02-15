<div>
@php
    $orderedPosts = [];

    foreach ($posts as $slug => $post) {
        $orderedPosts[] = [
            'slug' => $slug,
            ...$post,
        ];
    }
@endphp

<section class="page-shell page-shell-wide page-section">
    <div class="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
        <div class="lg:col-span-9">
            <p class="brand-pill">Media</p>
            <h1 class="mt-4 page-title text-brand-deep">Digital imaging latest news and insights</h1>
            <p class="mt-4 max-w-3xl page-lead">Browse archived and current media content from Imaging Services.</p>
        </div>
        <div class="lg:col-span-3">
            <div class="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
                <p class="text-xs uppercase tracking-[0.12em] text-brand-muted">Published Articles</p>
                <p class="mt-1 section-title text-brand-deep">{{ count($orderedPosts) }}</p>
            </div>
        </div>
    </div>
</section>

<section class="page-shell page-shell-wide page-section pb-4">
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($orderedPosts as $post)
            <article class="surface-card group flex h-full flex-col p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ $post['published'] ?? '' }}</p>
                <h2 class="mt-3 card-title text-brand-deep">{{ $post['title'] ?? '' }}</h2>
                <p class="mt-3 grow text-sm text-brand-muted">{{ $post['summary'] ?? '' }}</p>
                <a href="{{ $post['url'] ?? '#' }}" class="mt-4 inline-flex text-sm font-semibold text-brand-accent transition group-hover:translate-x-0.5 hover:text-brand-deep" wire:navigate.hover>Read article</a>
            </article>
        @endforeach
    </div>
</section>

</div>
