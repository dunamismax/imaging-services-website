@php
    $siteData = is_array($site ?? null) ? $site : [];
    $sections = is_array($equipment['sections'] ?? null) ? $equipment['sections'] : [];
@endphp

<section class="page-shell page-shell-wide page-section">
    <a href="{{ $equipment['backUrl'] ?? route('equipment') }}" class="text-sm font-semibold text-brand-accent hover:text-brand-deep" wire:navigate.hover>&larr; Back to Equipment</a>

    <div class="mt-4 grid gap-6 lg:grid-cols-2">
        <div class="surface-card overflow-hidden">
            <img src="{{ $equipment['image'] ?? '' }}" alt="{{ $equipment['title'] ?? '' }}" class="h-full min-h-72 w-full object-cover">
        </div>

        <article class="surface-card p-6 md:p-8">
            <p class="brand-pill">Equipment Detail</p>
            <h1 class="mt-3 page-title-compact text-brand-deep">{{ $equipment['title'] ?? '' }}</h1>
            <p class="mt-3 page-body">{{ $equipment['subtitle'] ?? '' }}</p>

            <ul class="mt-5 space-y-2">
                @foreach (($equipment['highlights'] ?? []) as $highlight)
                    <li class="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted">
                        <span class="text-brand-accent">•</span> {{ $highlight }}
                    </li>
                @endforeach
            </ul>

            @if ($sections !== [])
                <div class="mt-7 space-y-5">
                    @foreach ($sections as $index => $section)
                        @php
                            $sectionParagraphs = is_array($section['paragraphs'] ?? null) ? $section['paragraphs'] : [];
                            $sectionBullets = is_array($section['bullets'] ?? null) ? $section['bullets'] : [];
                        @endphp
                        <section class="rounded-2xl border border-brand-ink/10 bg-site-panel px-4 py-4" wire:key="equipment-section-{{ $index }}">
                            <h2 class="card-title text-brand-deep">{{ $section['title'] ?? '' }}</h2>
                            @if ($sectionParagraphs !== [])
                                <div class="mt-3 space-y-2 text-sm leading-relaxed text-brand-muted">
                                    @foreach ($sectionParagraphs as $paragraph)
                                        <p>{{ $paragraph }}</p>
                                    @endforeach
                                </div>
                            @endif
                            @if ($sectionBullets !== [])
                                <ul class="mt-3 space-y-2">
                                    @foreach ($sectionBullets as $bullet)
                                        <li class="rounded-xl border border-brand-ink/10 bg-brand-soft px-3 py-2 text-sm text-brand-muted">{{ $bullet }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </section>
                    @endforeach
                </div>
            @endif

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-primary" wire:navigate.hover>Request Pricing</a>
                <a href="{{ $siteData['urls']['services'] ?? route('services') }}" class="btn-secondary" wire:navigate.hover>See Service Options</a>
                @if (! empty($equipment['brochure']))
                    <a href="{{ $equipment['brochure'] }}" target="_blank" rel="noopener" class="btn-secondary">Download Brochure</a>
                @endif
            </div>
        </article>
    </div>
</section>
