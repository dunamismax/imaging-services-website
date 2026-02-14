<section class="mx-auto mt-10 max-w-4xl px-4 lg:px-8">
    <a href="{{ route('media') }}" class="text-sm font-semibold text-brand-accent hover:text-brand-deep">&larr; Back to Media</a>

    <article class="surface-card mt-4 p-6 md:p-8">
        <p class="brand-pill">{{ $post['published'] }}</p>
        <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">{{ $post['title'] }}</h1>
        <p class="mt-4 text-lg text-brand-muted">{{ $post['summary'] }}</p>

        <div class="mt-6 space-y-4 text-base leading-relaxed text-brand-muted">
            @foreach ($post['content'] as $paragraph)
                <p wire:key="post-paragraph-{{ $postSlug }}-{{ $loop->index }}">{{ $paragraph }}</p>
            @endforeach
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('contact') }}" class="btn-primary">Talk to Our Team</a>
            <a href="{{ route('equipment') }}" class="btn-secondary">Explore Equipment</a>
        </div>
    </article>
</section>
