<div>
<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <p class="brand-pill">Services and Training</p>
    <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">On-site and remote support to keep your systems operational</h1>
    <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ $services['intro'] }}</p>
</section>

<section class="mx-auto mt-8 max-w-7xl px-4 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-2">
        <article class="surface-card p-6 md:p-8">
            <h2 class="font-display text-2xl font-semibold text-brand-deep">Service Options</h2>
            <ul class="mt-4 space-y-2">
                @foreach ($services['service_options'] as $option)
                    <li class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted" wire:key="service-option-view-{{ $loop->index }}">{{ $option }}</li>
                @endforeach
            </ul>
        </article>

        <article class="surface-card p-6 md:p-8">
            <h2 class="font-display text-2xl font-semibold text-brand-deep">Training Focus Areas</h2>
            <ul class="mt-4 space-y-2">
                @foreach ($services['training_options'] as $option)
                    <li class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted" wire:key="training-option-view-{{ $loop->index }}">{{ $option }}</li>
                @endforeach
            </ul>
            <p class="mt-5 text-sm text-brand-muted">{{ $services['parts_summary'] }}</p>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($services['brands'] as $brand)
                    <span class="rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold uppercase tracking-wide text-brand-accent" wire:key="service-brand-{{ $brand }}">{{ $brand }}</span>
                @endforeach
            </div>
        </article>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <div class="grid gap-6 xl:grid-cols-2">
        <livewire:forms.service-request-form />
        <livewire:forms.training-request-form />
    </div>
</section>

</div>
