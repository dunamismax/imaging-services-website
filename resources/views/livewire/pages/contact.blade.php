<div>
<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <p class="brand-pill">Contact Us</p>
    <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">{{ $contact['headline'] }}</h1>
    <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ $contact['subhead'] }}</p>
</section>

<section class="mx-auto mt-8 max-w-7xl px-4 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-3">
        <article class="surface-card p-6 lg:col-span-2">
            <h2 class="font-display text-2xl font-semibold text-brand-deep">Branch Locations</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                @foreach ($contact['locations'] as $state => $address)
                    <div class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3" wire:key="location-{{ $state }}">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-accent">{{ $state }}</p>
                        <p class="mt-1 text-sm text-brand-muted">{{ $address }}</p>
                    </div>
                @endforeach
            </div>

            <h3 class="mt-6 font-display text-xl font-semibold text-brand-deep">Speak to Principals Directly</h3>
            <div class="mt-3 flex flex-wrap gap-3">
                @foreach ($contact['principals'] as $person)
                    <a href="tel:{{ preg_replace('/[^\d+]/', '', $person['phone']) }}" class="btn-secondary" wire:key="principal-{{ $person['name'] }}">{{ $person['name'] }}: {{ $person['phone'] }}</a>
                @endforeach
            </div>

            <div class="mt-5 rounded-xl border border-brand-ink/10 bg-brand-soft p-4 text-sm text-brand-muted">
                <p>Toll Free: {{ $company['phone_toll_free'] }}</p>
                <p class="mt-1">Email Orders: {{ $company['email_orders'] }}</p>
                <p class="mt-1">Working Hours: Mon-Fri 8:30 am - 5:00 pm</p>
            </div>
        </article>

        <div class="surface-card p-6">
            <h2 class="font-display text-xl font-semibold text-brand-deep">Working Hours</h2>
            <dl class="mt-4 space-y-2 text-sm">
                @foreach ($hours as $slot)
                    <div class="flex items-center justify-between border-b border-brand-ink/10 pb-2" wire:key="contact-hour-{{ $slot['day'] }}">
                        <dt class="font-semibold uppercase tracking-wide text-brand-muted">{{ $slot['day'] }}</dt>
                        <dd class="text-brand-deep">{{ $slot['hours'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <div class="grid gap-6 xl:grid-cols-2">
        <livewire:forms.contact-sales-form />
        <livewire:forms.service-request-form />
    </div>
</section>

<section class="mx-auto mt-6 max-w-7xl px-4 lg:px-8">
    <livewire:forms.training-request-form />
</section>

</div>
