<div>
@php
    $siteData = is_array($site ?? null) ? $site : [];
    $company = is_array($siteData['company'] ?? null) ? $siteData['company'] : [];
    $hours = is_array($siteData['hours'] ?? null) ? $siteData['hours'] : [];
    $supportContacts = is_array($contact['support_contacts'] ?? null) ? $contact['support_contacts'] : [];
    $locations = is_array($contact['locations'] ?? null) ? $contact['locations'] : [];
    $principals = is_array($contact['principals'] ?? null) ? $contact['principals'] : [];
    $emailSales = is_string($company['email_sales'] ?? null) ? $company['email_sales'] : ($company['email_orders'] ?? '');
@endphp

<section class="page-shell page-shell-wide page-section">
    <div class="surface-card grid gap-6 p-6 md:p-8 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <p class="brand-pill">Contact Us</p>
            <h1 class="mt-4 page-title text-brand-deep">{{ $contact['headline'] ?? '' }}</h1>
            <p class="mt-4 max-w-3xl page-lead">{{ $contact['subhead'] ?? '' }}</p>
        </div>
        <div class="lg:col-span-4">
            <div class="rounded-2xl border border-brand-ink/10 bg-site-panel p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">Quick actions</p>
                <a href="{{ $siteData['urls']['tollFreeDial'] ?? '#' }}" class="btn-primary mt-4 w-full">Call {{ $company['phone_toll_free'] ?? '' }}</a>
                <a href="mailto:{{ $emailSales }}" class="btn-secondary mt-3 w-full">Email sales</a>
            </div>
        </div>
    </div>
</section>

<section class="page-shell page-shell-wide page-section-tight">
    <div class="grid gap-6 lg:grid-cols-3">
        <article class="surface-card p-6 lg:col-span-2">
            <h2 class="card-title text-brand-deep">Branch Locations</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                @foreach ($locations as $state => $address)
                    <div class="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ $state }}</p>
                        <p class="mt-1 text-sm text-brand-muted">{{ $address }}</p>
                    </div>
                @endforeach
            </div>

            <h3 class="mt-6 card-title text-brand-deep">Speak to Principals Directly</h3>
            <div class="mt-3 flex flex-wrap gap-3">
                @foreach ($principals as $person)
                    @php
                        $phone = is_string($person['phone'] ?? null) ? $person['phone'] : '';
                        $dial = 'tel:'.preg_replace('/[^\d+]/', '', $phone);
                    @endphp
                    <a href="{{ $dial }}" class="btn-secondary">
                        {{ $person['name'] ?? '' }}: {{ $phone }}
                    </a>
                @endforeach
            </div>

            <h3 class="mt-6 card-title text-brand-deep">Contact Team</h3>
            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                @foreach ($supportContacts as $person)
                    <article class="rounded-xl border border-brand-ink/10 bg-site-panel px-4 py-3">
                        <p class="text-sm font-semibold text-brand-deep">{{ $person['name'] ?? '' }}</p>
                        <p class="text-xs uppercase tracking-[0.12em] text-brand-accent">{{ $person['role'] ?? '' }}</p>
                        <a href="mailto:{{ $person['email'] ?? '' }}" class="mt-2 block text-sm text-brand-muted hover:text-brand-deep">{{ $person['email'] ?? '' }}</a>
                        @if (! empty($person['phone']))
                            @php
                                $phone = is_string($person['phone']) ? $person['phone'] : '';
                                $dial = 'tel:'.preg_replace('/[^\d+]/', '', $phone);
                            @endphp
                            <a href="{{ $dial }}" class="mt-1 block text-sm text-brand-muted hover:text-brand-deep">{{ $phone }}</a>
                        @endif
                    </article>
                @endforeach
            </div>

            <div class="mt-5 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
                <p>Toll Free: {{ $company['phone_toll_free'] ?? '' }}</p>
                <p class="mt-1">Email Orders: {{ $company['email_orders'] ?? '' }}</p>
                <p class="mt-1">Working Hours: Mon-Fri 8:30 am - 5 pm</p>
            </div>
        </article>

        <div class="surface-card p-6 lg:sticky lg:top-28 lg:h-fit">
            <h2 class="card-title text-brand-deep">Working Hours</h2>
            <dl class="mt-4 space-y-2 text-sm">
                @foreach ($hours as $slot)
                    <div class="flex items-center justify-between border-b border-brand-ink/10 pb-2">
                        <dt class="font-semibold uppercase tracking-wide text-brand-muted">{{ $slot['day'] ?? '' }}</dt>
                        <dd class="text-brand-deep">{{ $slot['hours'] ?? '' }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>

<section class="page-shell page-shell-wide page-section">
    <div class="mb-5">
        <p class="brand-pill">Request a Callback</p>
        <h2 class="mt-3 section-title text-brand-deep">Tell us what you need</h2>
    </div>
    <div class="grid gap-6 xl:grid-cols-2">
        <livewire:forms.contact-sales-form :key="'contact-page-contact-sales'" />

        <livewire:forms.selectable-request-form
            :options="$serviceOptions"
            form-key="service-request"
            options-legend="Select one or more options"
            button-label="Request Service"
            pill-label="Service Request"
            heading-label="Request our service"
            success-message="We received your message and a member of our services team will reach out within one business day."
            :key="'contact-page-service-request'"
        />
    </div>
</section>

<section class="page-shell page-shell-wide page-section-tight">
    <livewire:forms.selectable-request-form
        :options="$trainingOptions"
        form-key="training-request"
        options-legend="Select one or more training options"
        button-label="Request Training"
        pill-label="Training Request"
        heading-label="Request training"
        success-message="We received your message and a member of our training team will reach out within one business day."
        :key="'contact-page-training-request'"
    />
</section>

</div>
