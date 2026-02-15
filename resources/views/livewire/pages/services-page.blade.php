<div>
@php
    $siteData = is_array($site ?? null) ? $site : [];
@endphp

<section class="page-shell page-shell-wide page-section">
    <div class="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <p class="brand-pill">Services and Training</p>
            <h1 class="mt-4 page-title text-brand-deep">Call. We'll be there in an instant.</h1>
            <p class="mt-4 max-w-3xl page-lead">{{ $services['intro'] ?? '' }}</p>
        </div>
        <div class="lg:col-span-4">
            <div class="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">Fast support path</p>
                <p class="mt-2 text-sm text-brand-muted">Choose service or training options below and our team follows up within one business day.</p>
                <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-secondary mt-5 w-full" wire:navigate.hover>Contact support team</a>
            </div>
        </div>
    </div>
</section>

<section class="page-shell page-shell-wide page-section-tight">
    <div class="grid gap-6 lg:grid-cols-2">
        <article class="surface-card p-6 md:p-8">
            <h2 class="card-title text-brand-deep">Service Options</h2>
            <ul class="mt-4 space-y-2">
                @foreach (($services['service_options'] ?? []) as $option)
                    <li class="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted">
                        <span class="text-brand-accent">•</span> {{ $option }}
                    </li>
                @endforeach
            </ul>
        </article>

        <article class="surface-card p-6 md:p-8">
            <h2 class="card-title text-brand-deep">Training Focus Areas</h2>
            <ul class="mt-4 space-y-2">
                @foreach (($services['training_options'] ?? []) as $option)
                    <li class="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3 text-sm text-brand-muted">
                        <span class="text-brand-accent">•</span> {{ $option }}
                    </li>
                @endforeach
            </ul>
            <p class="mt-5 text-sm text-brand-muted">{{ $services['parts_summary'] ?? '' }}</p>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach (($services['brands'] ?? []) as $brand)
                    <span class="rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold uppercase tracking-wide text-brand-accent">
                        {{ $brand }}
                    </span>
                @endforeach
            </div>
        </article>
    </div>
</section>

<section class="page-shell page-shell-wide page-section">
    <div class="mb-5">
        <p class="brand-pill">Request Service or Training</p>
        <h2 class="mt-3 section-title text-brand-deep">Send your request to our team</h2>
    </div>
    <div class="grid gap-6 xl:grid-cols-2">
        <livewire:forms.selectable-request-form
            :options="is_array($services['service_options'] ?? null) ? $services['service_options'] : []"
            form-key="service-request"
            options-legend="Select one or more options"
            button-label="Request Service"
            pill-label="Service Request"
            heading-label="Request our service"
            success-message="We received your message and a member of our services team will reach out within one business day."
            :key="'services-page-service-request'"
        />

        <livewire:forms.selectable-request-form
            :options="is_array($services['training_options'] ?? null) ? $services['training_options'] : []"
            form-key="training-request"
            options-legend="Select one or more training options"
            button-label="Request Training"
            pill-label="Training Request"
            heading-label="Request training"
            success-message="We received your message and a member of our training team will reach out within one business day."
            :key="'services-page-training-request'"
        />
    </div>
</section>

</div>
