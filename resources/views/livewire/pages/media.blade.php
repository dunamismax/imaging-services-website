<div>
<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <p class="brand-pill">Media</p>
    <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Updates, interviews, and imaging insights</h1>
    <p class="mt-4 max-w-3xl text-lg text-brand-muted">Browse archived and recent media content from the Imaging Services team.</p>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 pb-4 lg:px-8">
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($posts as $slug => $post)
            <article class="surface-card p-5" wire:key="media-post-{{ $slug }}">
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ $post['published'] }}</p>
                <h2 class="mt-3 font-display text-2xl font-semibold text-brand-deep">{{ $post['title'] }}</h2>
                <p class="mt-3 text-sm text-brand-muted">{{ $post['summary'] }}</p>
                <a href="{{ route('blog.post', ['postSlug' => $slug]) }}" class="mt-4 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep">Read article</a>
            </article>
        @endforeach
    </div>
</section>

</div>
