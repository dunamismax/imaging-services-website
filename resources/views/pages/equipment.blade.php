@extends('layouts.site')

@section('content')
<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <p class="brand-pill">Equipment</p>
    <h1 class="mt-4 font-display text-4xl font-semibold text-brand-deep md:text-5xl">Systems for chiropractic, podiatry, veterinary, mobile, and orthopedic workflows</h1>
    <div class="mt-5 grid gap-3">
        @foreach ($equipment['intro'] as $line)
            <p class="text-base text-brand-muted">{{ $line }}</p>
        @endforeach
    </div>
</section>

<section class="mx-auto mt-10 max-w-7xl px-4 lg:px-8">
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($equipment['categories'] as $item)
            <article class="surface-card overflow-hidden">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-52 w-full object-cover">
                <div class="p-5">
                    <h2 class="font-display text-2xl font-semibold text-brand-deep">{{ $item['name'] }}</h2>
                    <a href="{{ route('equipment.detail', ['equipmentSlug' => $item['slug']]) }}" class="mt-3 inline-flex text-sm font-semibold text-brand-accent hover:text-brand-deep">View product page</a>
                </div>
            </article>
        @endforeach
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
