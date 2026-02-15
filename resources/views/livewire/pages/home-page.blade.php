<div>
@php
    $siteData = is_array($site ?? null) ? $site : [];
    $company = is_array($siteData['company'] ?? null) ? $siteData['company'] : [];
    $hours = is_array($siteData['hours'] ?? null) ? $siteData['hours'] : [];
    $partners = is_array($siteData['partners'] ?? null) ? $siteData['partners'] : [];
    $statesServed = is_array($company['states_served'] ?? null) ? $company['states_served'] : [];
    $statCards = [
        ['label' => 'Years Supporting Clinics', 'value' => '45+'],
        ['label' => 'States Covered', 'value' => (string) count($statesServed)],
        ['label' => 'Manufacturer Partners', 'value' => (string) count($partners)],
    ];
@endphp

<section class="page-shell page-shell-wide page-section grid gap-8 lg:grid-cols-12">
    <div class="reveal-up lg:col-span-7">
        <p class="brand-pill">Imaging Services USA</p>
        <h1 class="mt-4 page-title text-brand-deep">{{ $home['hero']['headline'] ?? '' }}</h1>
        <p class="mt-4 max-w-2xl page-lead">{{ $home['hero']['subheadline'] ?? '' }}</p>
        <p class="mt-3 max-w-2xl page-body">{{ $home['hero']['summary'] ?? '' }}</p>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ $home['hero']['primary_cta']['url'] ?? '#' }}" class="btn-primary" wire:navigate.hover>{{ $home['hero']['primary_cta']['label'] ?? '' }}</a>
            <a href="{{ $home['hero']['secondary_cta']['url'] ?? '#' }}" class="btn-secondary" wire:navigate.hover>{{ $home['hero']['secondary_cta']['label'] ?? '' }}</a>
        </div>

        <div class="mt-8 grid gap-3 sm:grid-cols-3">
            @foreach ($statCards as $stat)
                <article class="surface-card bg-site-panel p-4">
                    <p class="card-title text-brand-deep">{{ $stat['value'] }}</p>
                    <p class="mt-1 text-xs uppercase tracking-[0.12em] text-brand-muted">{{ $stat['label'] }}</p>
                </article>
            @endforeach
        </div>
    </div>

    <div class="reveal-up lg:col-span-5">
        <div class="surface-card overflow-hidden">
            <img src="{{ $home['hero']['image'] ?? '' }}" alt="Medical imaging equipment in a treatment room" class="h-64 w-full object-cover md:h-72">
            <div class="bg-site-panel p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">Regional Coverage</p>
                <p class="mt-2 text-sm text-brand-muted">Serving {{ implode(', ', $statesServed) }} with installation, retrofits, and responsive support.</p>
            </div>
        </div>

        <aside class="surface-card mt-5 p-5">
            <h2 class="card-title text-brand-deep">Typical Working Hours</h2>
            <dl class="mt-4 space-y-2 text-sm">
                @foreach ($hours as $slot)
                    <div class="flex items-center justify-between border-b border-brand-ink/10 pb-2">
                        <dt class="font-semibold uppercase tracking-wide text-brand-muted">{{ $slot['day'] ?? '' }}</dt>
                        <dd class="text-brand-deep">{{ $slot['hours'] ?? '' }}</dd>
                    </div>
                @endforeach
            </dl>
            <p class="mt-4 text-sm text-brand-muted">Toll free: {{ $company['phone_toll_free'] ?? '' }}</p>
            <p class="mt-1 text-sm text-brand-muted">Orders: {{ $company['email_orders'] ?? '' }}</p>
        </aside>
    </div>
</section>

<section class="page-shell page-shell-wide page-section-loose">
    <div class="surface-card p-6 md:p-8">
        <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="brand-pill">Our Main Advantages</p>
                <h2 class="mt-3 section-title text-brand-deep">A practical partner for your imaging operations</h2>
            </div>
            <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-secondary" wire:navigate.hover>Talk to our team</a>
        </div>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            @foreach (($home['advantages'] ?? []) as $advantage)
                <article class="rounded-2xl border border-brand-ink/10 bg-site-panel p-4">
                    <p class="page-body">{{ $advantage }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="page-shell page-shell-wide page-section-loose">
    <div class="mb-6 flex items-end justify-between gap-3">
        <div>
            <p class="brand-pill">Types of Equipment</p>
            <h2 class="mt-3 section-title text-brand-deep">Built for real clinical workflows</h2>
        </div>
        <a href="{{ $siteData['urls']['equipment'] ?? route('equipment') }}" class="btn-secondary" wire:navigate.hover>View All</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2">
        @foreach (($home['categories'] ?? []) as $category)
            <article class="surface-card overflow-hidden">
                <img src="{{ $category['image'] ?? '' }}" alt="{{ $category['title'] ?? '' }}" class="h-56 w-full object-cover">
                <div class="p-5">
                    <p class="text-sm font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ $category['subtitle'] ?? '' }}</p>
                    <h3 class="mt-2 card-title text-brand-deep">{{ $category['title'] ?? '' }}</h3>
                    <a href="{{ $category['url'] ?? '#' }}" class="mt-4 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep" wire:navigate.hover>View details</a>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="page-shell page-shell-wide page-section-loose">
    <div class="mb-6">
        <p class="brand-pill">Word on the Street</p>
        <h2 class="mt-3 section-title text-brand-deep">Customer feedback from the field</h2>
    </div>
    <div class="grid gap-5 lg:grid-cols-3">
        @foreach (($home['testimonials'] ?? []) as $item)
            <article class="surface-card p-5">
                <p class="text-sm text-brand-muted">"{{ $item['quote'] ?? '' }}"</p>
                <div class="mt-5 flex items-center gap-3">
                    <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['author'] ?? '' }}" class="size-12 rounded-full object-cover">
                    <div>
                        <p class="text-sm font-semibold text-brand-deep">{{ $item['author'] ?? '' }}</p>
                        <p class="text-xs text-brand-muted">{{ $item['location'] ?? '' }}</p>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="page-shell page-shell-wide page-section-loose pb-4">
    <x-site.partners-grid :partners="$partners" />
</section>

</div>
