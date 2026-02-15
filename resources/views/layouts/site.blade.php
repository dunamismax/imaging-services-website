<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <title>{{ $meta['title'] ?? config('app.name') }}</title>
    @if (! empty($meta['description']))
        <meta name="description" content="{{ $meta['description'] }}">
    @endif

    <link rel="stylesheet" href="{{ asset('site-assets/css/app.css') }}">
    @livewireStyles
</head>
<body class="site-body antialiased">
    <div class="site-grid-bg"></div>

    @php
        $siteData = is_array($site ?? null) ? $site : [];
        $company = is_array($siteData['company'] ?? null) ? $siteData['company'] : [];
        $navigation = is_array($siteData['navigation'] ?? null) ? $siteData['navigation'] : [];
        $quickLinks = is_array($siteData['quickLinks'] ?? null) ? $siteData['quickLinks'] : [];
        $urls = is_array($siteData['urls'] ?? null) ? $siteData['urls'] : [];
        $currentRoute = request()->route()?->getName();
        $isActiveRoute = static function (string $routeName) use ($currentRoute): bool {
            return $currentRoute === $routeName
                || ($routeName === 'contact' && $currentRoute === 'contact.alias')
                || ($routeName === 'privacy' && $currentRoute === 'privacy.legacy');
        };
    @endphp

    <div class="min-h-screen">
        <header class="site-header sticky top-0 z-40 border-b border-brand-ink/10 backdrop-blur-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 lg:px-8">
                <a href="{{ $navigation[0]['url'] ?? '/' }}" class="flex items-center gap-3" wire:navigate.hover>
                    <img src="/site-assets/images/home/logo.svg" alt="Imaging Services logo" class="h-10 w-auto">
                    <div>
                        <p class="font-display text-lg font-bold tracking-wide text-brand-deep">{{ $company['name'] ?? 'Imaging Services' }}</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-brand-accent">Imaging Services USA</p>
                    </div>
                </a>

                <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
                    @foreach ($navigation as $item)
                        @php
                            $routeName = isset($item['routeName']) && is_string($item['routeName']) ? $item['routeName'] : '';
                            $isActive = $routeName !== '' ? $isActiveRoute($routeName) : false;
                        @endphp
                        <a
                            href="{{ $item['url'] ?? '/' }}"
                            wire:navigate.hover
                            class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $isActive ? 'bg-brand-deep text-white shadow-sm' : 'text-brand-muted hover:bg-brand-soft hover:text-brand-deep' }}"
                        >
                            {{ $item['label'] ?? '' }}
                        </a>
                    @endforeach
                </nav>

                <div class="hidden items-center gap-2 lg:flex">
                    <a href="{{ $urls['tollFreeDial'] ?? '#' }}" class="btn-secondary">{{ $urls['tollFreePhone'] ?? '' }}</a>
                    <a href="{{ $urls['payments'] ?? route('payments') }}" class="btn-primary" wire:navigate.hover>Payments</a>
                </div>
            </div>

            <div class="border-t border-brand-ink/10 bg-white p-4 lg:hidden">
                <div class="mx-auto flex max-w-7xl flex-col gap-2">
                    @foreach ($navigation as $item)
                        @php
                            $routeName = isset($item['routeName']) && is_string($item['routeName']) ? $item['routeName'] : '';
                            $isActive = $routeName !== '' ? $isActiveRoute($routeName) : false;
                        @endphp
                        <a
                            href="{{ $item['url'] ?? '/' }}"
                            wire:navigate.hover
                            class="rounded-xl px-3 py-2 text-sm font-medium {{ $isActive ? 'bg-brand-deep text-white' : 'text-brand-muted hover:bg-brand-soft hover:text-brand-deep' }}"
                        >
                            {{ $item['label'] ?? '' }}
                        </a>
                    @endforeach

                    <a href="{{ $urls['payments'] ?? route('payments') }}" wire:navigate.hover class="rounded-xl bg-brand-deep px-3 py-2 text-sm font-semibold text-white">Payments</a>
                    <a href="{{ $urls['tollFreeDial'] ?? '#' }}" class="rounded-xl border border-brand-ink/20 px-3 py-2 text-sm font-semibold text-brand-deep">{{ $urls['tollFreePhone'] ?? '' }}</a>
                </div>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="mt-20 border-t border-brand-ink/10 bg-brand-deep text-brand-soft">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-14 lg:grid-cols-3 lg:px-8">
                <div>
                    <p class="font-display text-2xl font-bold">{{ $company['name'] ?? 'Imaging Services' }}</p>
                    <p class="mt-3 max-w-md text-sm text-brand-soft/85">{{ $company['tagline'] ?? '' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">Contact</p>
                    <p class="mt-3 text-sm">Toll Free: {{ $company['phone_toll_free'] ?? '' }}</p>
                    <p class="mt-1 text-sm">Main: {{ $company['phone_primary'] ?? '' }}</p>
                    <p class="mt-1 text-sm">Orders: {{ $company['email_orders'] ?? '' }}</p>
                    <p class="mt-1 text-sm">HQ: {{ $company['hq_address'] ?? '' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-brand-accent">Quick Links</p>
                    <div class="mt-3 flex flex-wrap gap-2 text-sm">
                        @foreach ($quickLinks as $link)
                            <a href="{{ $link['url'] ?? '#' }}" wire:navigate.hover class="rounded-full border border-brand-soft/30 px-3 py-1.5 transition hover:bg-brand-soft hover:text-brand-deep">
                                {{ $link['label'] ?? '' }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="border-t border-brand-soft/20">
                <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 text-xs text-brand-soft/85 lg:px-8">
                    <p>&copy; {{ now()->year }} {{ $company['legal_name'] ?? ($company['name'] ?? 'Imaging Services') }}. All rights reserved.</p>
                    <a href="{{ $urls['privacy'] ?? route('privacy') }}" wire:navigate.hover class="hover:text-white">Privacy Policy</a>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
