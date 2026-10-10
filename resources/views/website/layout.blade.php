<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ __('app.website.landing.meta', ['gym' => $gymName]) }}">
    <meta name="theme-color" content="#18231e">
    <title>@yield('title', $gymName)</title>
    <link rel="icon" href="/images/favicon.svg">
    <link rel="preconnect" href="https://images.unsplash.com">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/website.css') }}">
</head>
<body class="min-h-screen font-sans antialiased">
    <a href="#main" class="skip-link">{{ __('app.website.landing.skip') }}</a>
    <header class="site-header"><div class="landing-container header-inner">
        <a href="{{ route('website.home') }}" class="site-brand">
            @if ($hasCustomLogo && $logoUrl)<img src="{{ $logoUrl }}" alt="{{ $gymName }}" width="140" height="40">@else<span class="brand-mark" aria-hidden="true">↗</span>{{ $gymName }}@endif
        </a>
        <nav class="desktop-nav" aria-label="{{ __('app.website.landing.navigation') }}">
            <a href="{{ route('website.home') }}#experience">{{ __('app.website.nav.about') }}</a>
            <a href="{{ route('website.home') }}#fees">{{ __('app.website.nav.plans') }}</a>
            <a href="{{ route('website.home') }}#timings">{{ __('app.website.nav.visit') }}</a>
        </nav>
        <a href="{{ route('website.home') }}#join" class="site-btn header-cta">{{ __('app.website.nav.get_started') }} <span aria-hidden="true">↗</span></a>
    </div></header>
    <main id="main">@yield('content')</main>
    <footer class="site-footer"><div class="landing-container footer-inner"><div><a href="{{ route('website.home') }}" class="footer-brand">{{ $gymName }}</a><p>{{ __('app.website.landing.footer_line') }}</p></div><div class="footer-contact">
        @if ($gymContact)<a href="tel:{{ preg_replace('/[^+0-9]/', '', $gymContact) }}">{{ $gymContact }}</a>@endif
        @if ($gymEmail)<a href="mailto:{{ $gymEmail }}">{{ $gymEmail }}</a>@endif
        <span>&copy; {{ date('Y') }} {{ $gymName }}</span>
    </div></div></footer>
    <script>
        document.querySelectorAll('[data-plan-id]').forEach(link => {
            link.addEventListener('click', () => {
                const select = document.getElementById('enquiry-plan');
                if (select) {
                    select.value = link.dataset.planId;
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        });
    </script>
</body>
</html>
