<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <a href="{{ route('equipment') }}" class="text-sm font-semibold text-brand-accent hover:text-brand-deep">&larr; Back to Equipment</a>

    <div class="mt-4 grid gap-6 lg:grid-cols-2">
        <div class="surface-card overflow-hidden">
            <img src="{{ $equipment['image'] }}" alt="{{ $equipment['title'] }}" class="h-full min-h-72 w-full object-cover">
        </div>

        <article class="surface-card p-6 md:p-8">
            <p class="brand-pill">Equipment Detail</p>
            <h1 class="mt-3 font-display text-3xl font-semibold text-brand-deep md:text-4xl">{{ $equipment['title'] }}</h1>
            <p class="mt-3 text-base text-brand-muted">{{ $equipment['subtitle'] }}</p>

            <ul class="mt-5 space-y-2">
                @foreach ($equipment['highlights'] as $highlight)
                    <li class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted" wire:key="equipment-highlight-{{ $equipmentSlug }}-{{ $loop->index }}">{{ $highlight }}</li>
                @endforeach
            </ul>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('contact') }}" class="btn-primary">Request Pricing</a>
                <a href="{{ route('services') }}" class="btn-secondary">See Service Options</a>
                @if (isset($equipment['brochure']))
                    <a href="{{ $equipment['brochure'] }}" target="_blank" rel="noopener" class="btn-secondary">Download Brochure</a>
                @endif
            </div>
        </article>
    </div>
</section>
