@extends('layouts.site')

@section('content')
<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <p class="brand-pill">About Imaging Services</p>
    <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Supporting your workflow with a dedicated team</h1>
    <p class="mt-4 max-w-3xl text-lg text-brand-muted">{{ $about['intro'] }}</p>
    <p class="mt-2 max-w-3xl text-base text-brand-muted">{{ $about['supporting'] }}</p>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <div class="mb-5">
        <p class="brand-pill">Our Team</p>
        <h2 class="mt-3 font-display text-3xl font-semibold text-brand-deep">People behind your imaging success</h2>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($about['team'] as $member)
            <article class="surface-card overflow-hidden">
                <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-64 w-full object-cover">
                <div class="p-4">
                    <h3 class="font-display text-xl font-semibold text-brand-deep">{{ $member['name'] }}</h3>
                    <p class="mt-1 text-sm uppercase tracking-[0.14em] text-brand-accent">{{ $member['role'] }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-12 max-w-7xl px-4 pb-4 lg:px-8">
    <div class="surface-card p-6 md:p-8">
        <p class="brand-pill">Partners</p>
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
