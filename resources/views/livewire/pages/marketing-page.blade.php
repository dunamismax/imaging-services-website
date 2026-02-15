<section class="page-shell page-shell-narrow page-section">
    <article class="surface-card p-6 md:p-8">
        <p class="brand-pill">Imaging Services</p>
        <h1 class="mt-4 page-title text-brand-deep">{{ $page['title'] ?? '' }}</h1>
        <p class="mt-4 page-lead">{{ $page['description'] ?? '' }}</p>

        <div class="mt-6 space-y-4 rounded-2xl border border-brand-ink/10 bg-site-panel p-4 reading-body">
            @foreach (($page['body'] ?? []) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ $page['ctaUrl'] ?? '#' }}" class="btn-primary" wire:navigate.hover>{{ $page['cta']['label'] ?? 'Learn More' }}</a>
            <a href="{{ $page['homeUrl'] ?? route('home') }}" class="btn-secondary" wire:navigate.hover>Return Home</a>
        </div>
    </article>
</section>
