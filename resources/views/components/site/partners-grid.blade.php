@props([
    'partners' => [],
    'title' => 'Partners We Work With',
])

<div class="surface-card p-6 md:p-8">
    <div class="flex flex-wrap items-end justify-between gap-3">
        <p class="brand-pill">{{ $title }}</p>
        <p class="text-xs uppercase tracking-[0.12em] text-brand-muted">Manufacturers and Integration Partners</p>
    </div>
    <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
        @foreach ($partners as $partner)
            <div class="flex items-center justify-center rounded-xl border border-brand-ink/10 bg-site-panel p-3 transition duration-200 hover:-translate-y-0.5 hover:border-brand-ink/20">
                <img src="{{ $partner['logo'] ?? '' }}" alt="{{ $partner['name'] ?? '' }}" class="h-10 w-auto object-contain" loading="lazy">
            </div>
        @endforeach
    </div>
</div>
