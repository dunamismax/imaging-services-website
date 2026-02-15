<div>
@php
    $siteData = is_array($site ?? null) ? $site : [];
    $partners = is_array($siteData['partners'] ?? null) ? $siteData['partners'] : [];
@endphp

<section class="page-shell page-shell-wide page-section">
    <div class="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <p class="brand-pill">Accessories</p>
            <h1 class="mt-4 page-title text-brand-deep">View and select from our accessories catalog</h1>
            <p class="mt-4 max-w-3xl page-lead">{{ $accessories['summary'] ?? '' }}</p>
        </div>
        <div class="lg:col-span-4">
            <div class="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">Ordering support</p>
                <p class="mt-2 text-sm text-brand-muted">Need help finding part numbers or lead times? We can help you place the right order quickly.</p>
                <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-secondary mt-5 w-full" wire:navigate.hover>Request assistance</a>
            </div>
        </div>
    </div>
</section>

<section class="page-shell page-shell-wide page-section-tight">
    <div class="grid gap-6 lg:grid-cols-2">
        <article class="surface-card p-6 md:p-8">
            <h2 class="card-title text-brand-deep">Ordering Process</h2>
            <ul class="mt-4 space-y-3">
                @foreach (($accessories['notes'] ?? []) as $index => $note)
                    <li class="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted">
                        <span class="mr-2 font-semibold text-brand-accent">{{ $index + 1 }}.</span>{{ $note }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ $accessories['catalog_pdf'] ?? '#' }}" target="_blank" rel="noopener" class="btn-primary">Download Accessories Catalog</a>
                <a href="{{ $siteData['urls']['payments'] ?? route('payments') }}" class="btn-secondary" wire:navigate.hover>Go to Payments</a>
            </div>
        </article>

        <div class="surface-card relative overflow-hidden">
            <img src="{{ $accessories['catalog_image'] ?? '' }}" alt="Accessories catalog preview" class="h-full min-h-80 w-full object-cover">
            <div class="absolute inset-x-0 bottom-0 bg-linear-to-t from-black/60 to-transparent p-5">
                <p class="text-xs uppercase tracking-[0.14em] text-white/80">Preview</p>
                <p class="mt-1 font-display text-lg text-white">Accessories Catalog</p>
            </div>
        </div>
    </div>
</section>

<section class="page-shell page-shell-wide page-section-loose pb-4">
    <x-site.partners-grid :partners="$partners" />
</section>

</div>
