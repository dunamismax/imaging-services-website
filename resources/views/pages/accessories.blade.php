@extends('layouts.site')

@section('content')
<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <p class="brand-pill">Accessories</p>
    <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Complete your imaging order with practical accessories</h1>
    <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ $accessories['summary'] }}</p>
</section>

<section class="mx-auto mt-8 max-w-7xl px-4 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-2">
        <article class="surface-card p-6 md:p-8">
            <h2 class="font-display text-2xl font-semibold text-brand-deep">Ordering Process</h2>
            <ul class="mt-4 space-y-3">
                @foreach ($accessories['notes'] as $note)
                    <li class="rounded-xl border border-brand-ink/10 bg-white px-4 py-3 text-sm text-brand-muted">{{ $note }}</li>
                @endforeach
            </ul>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ $accessories['catalog_pdf'] }}" target="_blank" rel="noopener" class="btn-primary">Download Accessories Catalog</a>
                <a href="{{ route('payments') }}" class="btn-secondary">Go to Payments</a>
            </div>
        </article>

        <div class="surface-card overflow-hidden">
            <img src="{{ $accessories['catalog_image'] }}" alt="Accessories catalog preview" class="h-full min-h-80 w-full object-cover">
        </div>
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 pb-4 lg:px-8">
    <div class="surface-card p-6 md:p-8">
        <p class="brand-pill">Partners We Work With</p>
        <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($partners as $partner)
                <div class="flex items-center justify-center rounded-xl border border-brand-ink/10 bg-white p-3">
                    <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="h-10 w-auto object-contain" loading="lazy">
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
