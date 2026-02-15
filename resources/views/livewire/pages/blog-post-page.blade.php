@php
    $siteData = is_array($site ?? null) ? $site : [];
    $sections = is_array($post['sections'] ?? null) ? $post['sections'] : [];
    $content = is_array($post['content'] ?? null) ? $post['content'] : [];
@endphp

<section class="page-shell page-shell-narrow page-section">
    <a href="{{ $post['backUrl'] ?? route('media') }}" class="text-sm font-semibold text-brand-accent hover:text-brand-deep" wire:navigate.hover>&larr; Back to Media</a>

    <article class="surface-card mt-4 p-6 md:p-8">
        <p class="brand-pill">{{ $post['published'] ?? '' }}</p>
        <h1 class="mt-4 page-title text-brand-deep">{{ $post['title'] ?? '' }}</h1>
        <p class="mt-4 page-lead">{{ $post['summary'] ?? '' }}</p>

        <div class="mt-6 space-y-4 reading-body">
            @foreach ($content as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>

        @if ($sections !== [])
            <div class="mt-8 space-y-8">
                @foreach ($sections as $index => $section)
                    @php
                        $sectionParagraphs = is_array($section['paragraphs'] ?? null) ? $section['paragraphs'] : [];
                        $sectionBullets = is_array($section['bullets'] ?? null) ? $section['bullets'] : [];
                    @endphp
                    <section class="rounded-2xl border border-brand-ink/10 bg-site-panel px-4 py-5 md:px-5" wire:key="blog-section-{{ $index }}">
                        <h2 class="card-title text-brand-deep">{{ $section['title'] ?? '' }}</h2>
                        @if ($sectionParagraphs !== [])
                            <div class="mt-3 space-y-3 reading-body">
                                @foreach ($sectionParagraphs as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                            </div>
                        @endif
                        @if ($sectionBullets !== [])
                            <ul class="mt-4 space-y-2">
                                @foreach ($sectionBullets as $bullet)
                                    <li class="rounded-xl border border-brand-ink/10 bg-brand-soft px-3 py-2 text-sm text-brand-muted">{{ $bullet }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </section>
                @endforeach
            </div>
        @endif

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-primary" wire:navigate.hover>Talk to Our Team</a>
            <a href="{{ $siteData['urls']['equipment'] ?? route('equipment') }}" class="btn-secondary" wire:navigate.hover>Explore Equipment</a>
        </div>
    </article>
</section>
