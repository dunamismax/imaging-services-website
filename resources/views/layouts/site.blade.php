<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? config('site_content.company.tagline') }}">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="site-body antialiased">
    @php
        $company = config('site_content.company');
        $navItems = [
            ['label' => 'Home', 'route' => 'home'],
            ['label' => 'Equipment', 'route' => 'equipment'],
            ['label' => 'Services', 'route' => 'services'],
            ['label' => 'Accessories', 'route' => 'accessories'],
            ['label' => 'About', 'route' => 'about'],
            ['label' => 'Media', 'route' => 'media'],
            ['label' => 'Contact', 'route' => 'contact'],
        ];
    @endphp

    <div class="site-grid-bg"></div>

    <header class="site-header sticky top-0 z-40 border-b border-brand-ink/10 backdrop-blur-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="/site-assets/images/home/logo.svg" alt="Imaging Services logo" class="h-10 w-auto">
                <div>
                    <p class="font-display text-lg font-bold tracking-wide text-brand-deep">{{ $company['name'] }}</p>
                    <p class="text-xs uppercase tracking-[0.2em] text-brand-accent">Imaging Services USA</p>
                </div>
            </a>

            <nav class="hidden items-center gap-2 lg:flex" aria-label="Primary">
                @foreach ($navItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition hover:bg-brand-soft hover:text-brand-deep {{ request()->routeIs($item['route']) ? 'bg-brand-deep text-white shadow-sm' : 'text-brand-muted' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden items-center gap-3 lg:flex">
                <a href="tel:{{ preg_replace('/[^\d+]/', '', $company['phone_toll_free']) }}" class="btn-secondary">{{ $company['phone_toll_free'] }}</a>
                <a href="{{ route('payments') }}" class="btn-primary">Payments</a>
            </div>

            <details class="lg:hidden">
                <summary class="cursor-pointer rounded-full border border-brand-ink/20 px-4 py-2 text-sm font-semibold text-brand-deep">Menu</summary>
                <div class="absolute right-4 mt-2 w-64 rounded-2xl border border-brand-ink/10 bg-white p-4 shadow-xl">
                    <div class="flex flex-col gap-2">
                        @foreach ($navItems as $item)
                            <a href="{{ route($item['route']) }}" class="rounded-xl px-3 py-2 text-sm font-medium text-brand-muted hover:bg-brand-soft hover:text-brand-deep">{{ $item['label'] }}</a>
                        @endforeach
                        <a href="{{ route('payments') }}" class="rounded-xl bg-brand-deep px-3 py-2 text-sm font-semibold text-white">Payments</a>
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $company['phone_toll_free']) }}" class="rounded-xl border border-brand-ink/20 px-3 py-2 text-sm font-semibold text-brand-deep">{{ $company['phone_toll_free'] }}</a>
                    </div>
                </div>
            </details>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="mt-20 border-t border-brand-ink/10 bg-brand-deep text-brand-soft">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-14 lg:grid-cols-3 lg:px-8">
            <div>
                <p class="font-display text-2xl font-bold">{{ $company['name'] }}</p>
                <p class="mt-3 max-w-md text-sm text-brand-soft/85">{{ $company['tagline'] }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">Contact</p>
                <p class="mt-3 text-sm">Toll Free: {{ $company['phone_toll_free'] }}</p>
                <p class="mt-1 text-sm">Main: {{ $company['phone_primary'] }}</p>
                <p class="mt-1 text-sm">Orders: {{ $company['email_orders'] }}</p>
                <p class="mt-1 text-sm">HQ: {{ $company['hq_address'] }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">Quick Links</p>
                <div class="mt-3 flex flex-wrap gap-2 text-sm">
                    <a href="{{ route('privacy') }}" class="rounded-full border border-brand-soft/30 px-3 py-1.5 hover:bg-brand-soft hover:text-brand-deep">Privacy & Terms</a>
                    <a href="{{ route('marketing.page', ['pageSlug' => 'refund_returns']) }}" class="rounded-full border border-brand-soft/30 px-3 py-1.5 hover:bg-brand-soft hover:text-brand-deep">Refunds</a>
                    <a href="{{ route('marketing.page', ['pageSlug' => 'careers']) }}" class="rounded-full border border-brand-soft/30 px-3 py-1.5 hover:bg-brand-soft hover:text-brand-deep">Careers</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
