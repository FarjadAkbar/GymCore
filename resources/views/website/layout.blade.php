<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $gymName)</title>
    <link rel="icon" href="/images/favicon.svg">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f4f1ea] font-sans text-stone-900 antialiased">
    <header class="sticky top-0 z-40 border-b border-stone-200/80 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3 sm:px-6">
            <a href="{{ route('website.home') }}" class="flex min-w-0 items-center gap-3">
                @if ($hasCustomLogo && $logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $gymName }}" class="h-11 w-auto max-w-[160px] object-contain">
                @else
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-gymie-800 text-sm font-bold text-white">{{ strtoupper(substr($gymName, 0, 1)) }}</span>
                    <span class="truncate text-lg font-semibold tracking-tight text-gymie-950">{{ $gymName }}</span>
                @endif
            </a>
            <nav class="hidden items-center gap-7 text-sm font-medium text-stone-600 md:flex">
                <a href="{{ route('website.home') }}#fees" class="hover:text-gymie-800">{{ __('app.website.nav.fees') }}</a>
                <a href="{{ route('website.home') }}#timings" class="hover:text-gymie-800">{{ __('app.website.nav.timings') }}</a>
                <a href="{{ route('website.home') }}#visit" class="hover:text-gymie-800">{{ __('app.website.nav.visit') }}</a>
            </nav>
            <div class="flex items-center gap-2">
                <a href="{{ route('website.home') }}#join" class="rounded-lg bg-gymie-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gymie-900">{{ __('app.website.nav.join') }}</a>
                <a href="{{ url('/admin/login') }}" class="hidden text-sm font-medium text-stone-500 hover:text-gymie-900 sm:inline">{{ __('app.website.nav.staff_login') }}</a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gymie-950 text-stone-300">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-12 sm:px-6 md:grid-cols-3">
            <div>
                <p class="text-lg font-semibold text-white">{{ $gymName }}</p>
                <p class="mt-2 text-sm leading-relaxed text-stone-400">{{ __('app.website.footer.tagline') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gymie-200">{{ __('app.website.footer.contact') }}</p>
                <ul class="mt-3 space-y-1 text-sm">
                    @if ($gymContact)<li>{{ $gymContact }}</li>@endif
                    @if ($gymEmail)<li><a class="hover:text-white" href="mailto:{{ $gymEmail }}">{{ $gymEmail }}</a></li>@endif
                    @if ($gymAddress)<li class="text-stone-400">{{ $gymAddress }}</li>@endif
                </ul>
            </div>
            <div class="text-sm">
                <a href="{{ route('website.home') }}#join" class="font-medium text-white hover:underline">{{ __('app.website.nav.join') }}</a>
                <p class="mt-6 text-stone-500">&copy; {{ date('Y') }} {{ $gymName }}</p>
            </div>
        </div>
    </footer>
</body>
</html>
