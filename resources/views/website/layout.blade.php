<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $gymName)</title>
    <link rel="icon" href="/images/favicon.svg">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|bebas-neue:400" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display { font-family: 'Bebas Neue', ui-sans-serif, system-ui, sans-serif; letter-spacing: 0.04em; }
    </style>
</head>
<body class="min-h-screen bg-neutral-950 font-sans text-white antialiased">
    <header class="absolute inset-x-0 top-0 z-50">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-5 sm:px-6 lg:px-8">
            <a href="{{ route('website.home') }}" class="flex min-w-0 items-center">
                @if ($hasCustomLogo && $logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $gymName }}" class="h-10 max-w-[180px] w-auto brightness-0 invert">
                @else
                    <span class="font-display text-2xl tracking-wide text-white">{{ $gymName }}</span>
                @endif
            </a>
            <nav class="hidden items-center gap-8 text-sm font-medium uppercase tracking-wider text-white/80 md:flex">
                <a href="#about" class="hover:text-white">{{ __('app.website.nav.about') }}</a>
                <a href="#programs" class="hover:text-white">{{ __('app.website.nav.programs') }}</a>
                <a href="#plans" class="hover:text-white">{{ __('app.website.nav.plans') }}</a>
            </nav>
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="#enquiry" class="rounded-full bg-lime-400 px-4 py-2 text-xs font-bold uppercase tracking-wide text-neutral-950 hover:bg-lime-300 sm:px-5 sm:text-sm">{{ __('app.website.nav.get_started') }}</a>
                <a href="{{ url('/admin/login') }}" class="hidden rounded-full border border-white/30 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white hover:bg-white/10 sm:inline-block">{{ __('app.website.nav.staff_login') }}</a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-white/10 bg-neutral-950">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-3 lg:px-8">
            <div>
                <p class="font-display text-2xl text-white">{{ $gymName }}</p>
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-neutral-400">{{ __('app.website.footer.tagline') }}</p>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-lime-400">{{ __('app.website.footer.contact') }}</p>
                <ul class="mt-4 space-y-2 text-sm text-neutral-300">
                    @if ($gymEmail)
                        <li><a href="mailto:{{ $gymEmail }}" class="hover:text-white">{{ $gymEmail }}</a></li>
                    @endif
                    @if ($gymContact)
                        <li>{{ $gymContact }}</li>
                    @endif
                    @if ($gymAddress)
                        <li class="text-neutral-400">{{ $gymAddress }}</li>
                    @endif
                </ul>
            </div>
            <div class="flex flex-col gap-3 text-sm">
                <a href="#enquiry" class="font-semibold text-white hover:text-lime-400">{{ __('app.website.nav.get_started') }}</a>
                <a href="{{ url('/admin/login') }}" class="text-neutral-400 hover:text-white">{{ __('app.website.nav.staff_login') }}</a>
                <p class="mt-4 text-neutral-500">&copy; {{ date('Y') }} {{ $gymName }}</p>
            </div>
        </div>
    </footer>
</body>
</html>
