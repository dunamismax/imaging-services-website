<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <script>
        (() => {
            const themeStorageKey = 'site-theme';
            const root = document.documentElement;

            try {
                const storedTheme = window.localStorage.getItem(themeStorageKey);
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const shouldUseDark = storedTheme === 'dark' || (storedTheme === null && prefersDark);

                root.classList.toggle('dark', shouldUseDark);
            } catch {
                root.classList.remove('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body class="site-body antialiased">
    <div class="site-grid-bg"></div>
    @inertia
</body>
</html>
