<div>
@php
    $siteData = is_array($site ?? null) ? $site : [];
    $partners = is_array($siteData['partners'] ?? null) ? $siteData['partners'] : [];
@endphp

<section class="page-shell page-shell-wide page-section">
    <div class="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <p class="brand-pill">Equipment</p>
            <h1 class="mt-4 page-title text-brand-deep">Imaging systems for chiropractic, podiatry, veterinary, mobile, and orthopedic workflows</h1>
            <div class="mt-5 grid gap-3">
                @foreach (($equipment['intro'] ?? []) as $line)
                    <p class="page-body">{{ $line }}</p>
                @endforeach
            </div>
        </div>
        <aside class="lg:col-span-4">
            <div class="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">Need guidance?</p>
                <p class="mt-2 text-sm text-brand-muted">Our team helps you choose the right system for your room size, workflow, and budget.</p>
                <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-secondary mt-5 w-full" wire:navigate.hover>Talk to Equipment Sales</a>
            </div>
        </aside>
    </div>
</section>

<section class="page-shell page-shell-wide page-section">
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        @foreach (($equipment['categories'] ?? []) as $item)
            <article class="surface-card group overflow-hidden">
                <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['name'] ?? '' }}" class="h-52 w-full object-cover">
                <div class="bg-site-panel p-5">
                    <h2 class="card-title text-brand-deep">{{ $item['name'] ?? '' }}</h2>
                    <a href="{{ $item['url'] ?? '#' }}" class="mt-3 inline-flex text-sm font-semibold text-brand-accent transition group-hover:translate-x-0.5 hover:text-brand-deep" wire:navigate.hover>View product page</a>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="page-shell page-shell-wide page-section-loose pb-4">
    <x-site.partners-grid :partners="$partners" />
</section>

</div>
