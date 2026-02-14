<div>
<section class="mx-auto mt-10 grid max-w-7xl gap-8 px-4 lg:grid-cols-5 lg:px-8">
    <div class="reveal-up lg:col-span-3">
        <p class="brand-pill">Imaging Services USA</p>
        <h1 class="mt-4 font-display text-4xl font-semibold leading-tight text-brand-deep md:text-5xl">{{ $home['hero']['headline'] }}</h1>
        <p class="mt-4 max-w-2xl text-lg text-brand-muted">{{ $home['hero']['subheadline'] }}</p>
        <p class="mt-3 max-w-2xl text-base text-brand-muted">{{ $home['hero']['summary'] }}</p>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route($home['hero']['primary_cta']['route']) }}" class="btn-primary">{{ $home['hero']['primary_cta']['label'] }}</a>
            <a href="{{ route($home['hero']['secondary_cta']['route']) }}" class="btn-secondary">{{ $home['hero']['secondary_cta']['label'] }}</a>
        </div>
    </div>

    <aside class="surface-card reveal-up p-5 lg:col-span-2">
        <h2 class="font-display text-xl font-semibold text-brand-deep">Typical Working Hours</h2>
        <dl class="mt-4 space-y-2 text-sm">
            @foreach ($hours as $slot)
                <div class="flex items-center justify-between border-b border-brand-ink/10 pb-2" wire:key="hour-{{ $slot['day'] }}">
                    <dt class="font-semibold uppercase tracking-wide text-brand-muted">{{ $slot['day'] }}</dt>
                    <dd class="text-brand-deep">{{ $slot['hours'] }}</dd>
                </div>
            @endforeach
        </dl>
        <p class="mt-4 text-sm text-brand-muted">Toll free: {{ $company['phone_toll_free'] }}</p>
        <p class="mt-1 text-sm text-brand-muted">Coverage: {{ implode(', ', $company['states_served']) }}</p>
    </aside>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 lg:px-8">
    <div class="surface-card p-6 md:p-8">
        <p class="brand-pill">Our Main Advantages</p>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            @foreach ($home['advantages'] as $advantage)
                <article class="rounded-2xl border border-brand-ink/10 bg-white p-4" wire:key="advantage-{{ $loop->index }}">
                    <p class="text-base text-brand-muted">{{ $advantage }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 lg:px-8">
    <div class="mb-6 flex items-end justify-between gap-3">
        <div>
            <p class="brand-pill">Types of Equipment</p>
            <h2 class="mt-3 font-display text-3xl font-semibold text-brand-deep">Built for real clinical workflows</h2>
        </div>
        <a href="{{ route('equipment') }}" class="btn-secondary">View All</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2">
        @foreach ($home['categories'] as $category)
            <article class="surface-card overflow-hidden" wire:key="home-category-{{ $category['slug'] }}">
                <img src="{{ $category['image'] }}" alt="{{ $category['title'] }}" class="h-56 w-full object-cover">
                <div class="p-5">
                    <p class="text-sm font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ $category['subtitle'] }}</p>
                    <h3 class="mt-2 font-display text-2xl font-semibold text-brand-deep">{{ $category['title'] }}</h3>
                    <a href="{{ route('equipment.detail', ['equipmentSlug' => $category['slug']]) }}" class="mt-4 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep">View details</a>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 lg:px-8">
    <div class="mb-6">
        <p class="brand-pill">Word on the Street</p>
        <h2 class="mt-3 font-display text-3xl font-semibold text-brand-deep">Customer feedback from the field</h2>
    </div>
    <div class="grid gap-5 lg:grid-cols-3">
        @foreach ($home['testimonials'] as $item)
            <article class="surface-card p-5" wire:key="home-testimonial-{{ $loop->index }}">
                <p class="text-sm text-brand-muted">"{{ $item['quote'] }}"</p>
                <div class="mt-5 flex items-center gap-3">
                    <img src="{{ $item['image'] }}" alt="{{ $item['author'] }}" class="size-12 rounded-full object-cover">
                    <div>
                        <p class="text-sm font-semibold text-brand-deep">{{ $item['author'] }}</p>
                        <p class="text-xs text-brand-muted">{{ $item['location'] }}</p>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 pb-4 lg:px-8">
    <div class="surface-card overflow-hidden px-5 py-8 md:px-8">
        <p class="brand-pill">Partners We Work With</p>
        <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($partners as $partner)
                <div class="flex items-center justify-center rounded-xl border border-brand-ink/10 bg-white p-3" wire:key="home-partner-{{ $partner['name'] }}">
                    <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="h-10 w-auto object-contain" loading="lazy">
                </div>
            @endforeach
        </div>
    </div>
</section>

</div>
