<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['gebs-embed' => request()->boolean('embed')])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'GEBSTech App Center — GEBS Technologies public app marketplace.')">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ asset('logos/gebs-brand.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="gebs-app-center @yield('body_class')">
    <div class="gebs-bg" aria-hidden="true"></div>

    <header class="gebs-site-header">
        <div class="gebs-container gebs-site-header__inner">
            <a href="{{ route('app-center.index') }}{{ $gebsEmbedSuffix }}" class="gebs-brand">
                <img
                    src="{{ asset('logos/gebs-brand.svg') }}"
                    alt="GEBS Technologies"
                    class="gebs-brand__logo"
                    width="40"
                    height="40"
                >
                <span class="gebs-brand__text">
                    <span class="gebs-brand__name">GEBS Technologies</span>
                    <span class="gebs-brand__tag">App Center</span>
                </span>
            </a>
        </div>
    </header>

    <div class="gebs-page">
        @yield('content')
    </div>

    <footer class="gebs-footer">
        <div class="gebs-container gebs-footer__inner">
            <img src="{{ asset('logos/gebs-brand.svg') }}" alt="" class="gebs-footer__mark" width="28" height="28" aria-hidden="true">
            <span class="gebs-footer__copy">&copy; {{ date('Y') }} GEBS Technologies. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
