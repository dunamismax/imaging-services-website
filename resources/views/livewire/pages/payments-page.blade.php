@php
    $siteData = is_array($site ?? null) ? $site : [];
    $company = is_array($siteData['company'] ?? null) ? $siteData['company'] : [];
@endphp

<section class="page-shell page-shell-medium page-section">
    <div class="surface-card p-6 md:p-8">
        <p class="brand-pill">Payments</p>
        <h1 class="mt-4 page-title text-brand-deep">Send deposits and checks to Imaging Services</h1>
        <p class="mt-4 max-w-3xl page-body">Need help choosing the right payment method? Contact our team before sending funds and we will route you to the correct process.</p>
    </div>

    <div class="mt-8 grid gap-5 md:grid-cols-2">
        <article class="surface-card p-6">
            <h2 class="card-title text-brand-deep">Send Deposits and Checks</h2>
            <p class="mt-4 text-sm uppercase tracking-[0.14em] text-brand-accent">{{ $payments['mailing']['company'] ?? '' }}</p>
            <p class="mt-2 page-body">{{ $payments['mailing']['address'] ?? '' }}</p>
        </article>

        <article class="surface-card p-6">
            <h2 class="card-title text-brand-deep">{{ $payments['bank_transfer']['title'] ?? '' }}</h2>
            <p class="mt-3 page-body">{{ $payments['bank_transfer']['note'] ?? '' }}</p>
            <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-secondary mt-5" wire:navigate.hover>Request Transfer Details</a>
        </article>
    </div>

    <article class="surface-card mt-5 p-6">
        <h2 class="card-title text-brand-deep">Credit Cards</h2>
        <p class="mt-3 page-body">{{ $payments['card_note'] ?? '' }}</p>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ $siteData['urls']['tollFreeDial'] ?? '#' }}" class="btn-primary">Call {{ $company['phone_toll_free'] ?? '' }}</a>
            <a href="{{ $siteData['urls']['contact'] ?? route('contact') }}" class="btn-secondary" wire:navigate.hover>Submit Payment Question</a>
        </div>
    </article>
</section>
