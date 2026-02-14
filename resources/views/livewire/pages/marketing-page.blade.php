<section class="mx-auto mt-10 max-w-4xl px-4 lg:px-8">
    <article class="surface-card p-6 md:p-8">
        <p class="brand-pill">Imaging Services</p>
        <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">{{ $page['title'] }}</h1>
        <p class="mt-4 text-lg text-brand-muted">{{ $page['description'] }}</p>

        <div class="mt-6 space-y-4 text-base text-brand-muted">
            @foreach ($page['body'] as $paragraph)
                <p wire:key="marketing-paragraph-{{ $pageSlug }}-{{ $loop->index }}">{{ $paragraph }}</p>
            @endforeach
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route($page['cta']['route']) }}" class="btn-primary">{{ $page['cta']['label'] }}</a>
            <a href="{{ route('home') }}" class="btn-secondary">Return Home</a>
        </div>
    </article>
</section>
