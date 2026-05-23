@extends('layouts.app-center')

@section('title', 'GEBSTech App Center — GEBS Technologies')
@section('meta_description', 'Browse GEBS Technologies applications — retail, loyalty, kiosk, and field tools in one premium marketplace.')

@section('content')
    <section class="gebs-hero gebs-hero--banner">
        <div class="gebs-hero__glow" aria-hidden="true"></div>
        <div class="gebs-container gebs-hero__inner">
            <p class="gebs-eyebrow">GEBS Technologies</p>
            <h1 class="gebs-hero__title">App Center</h1>
            <p class="gebs-hero__subtitle">
                A minimalist, premium launchpad for every GEBS system — discover, explore, and deploy with confidence.
            </p>
            <div class="gebs-hero__stats">
                <span class="gebs-hero__stat gebs-glass-card">{{ $totalApps }} live applications</span>
                <span class="gebs-hero__stat gebs-glass-card">{{ $futureApps->count() }} coming soon</span>
            </div>
        </div>
    </section>

    <main class="gebs-main">
        <div class="gebs-container">
            @forelse ($appsByCategory as $category => $apps)
                <section class="gebs-category" aria-labelledby="category-{{ \Illuminate\Support\Str::slug($category) }}">
                    <header class="gebs-category__header">
                        <h2 id="category-{{ \Illuminate\Support\Str::slug($category) }}" class="gebs-category__title">{{ $category }}</h2>
                        <span class="gebs-category__count">{{ $apps->count() }} apps</span>
                    </header>
                    <div class="gebs-grid">
                        @foreach ($apps as $app)
                            @include('app-center.partials.tile', ['app' => $app])
                        @endforeach
                    </div>
                </section>
            @empty
                <div class="gebs-empty gebs-glass-card">
                    <p>No live applications are available at the moment.</p>
                </div>
            @endforelse

            @if ($futureApps->isNotEmpty())
                <section class="gebs-category gebs-category--future" aria-labelledby="category-future">
                    <header class="gebs-category__header">
                        <h2 id="category-future" class="gebs-category__title">Future Apps</h2>
                        <span class="gebs-category__count gebs-badge gebs-badge--soon">Coming soon</span>
                    </header>
                    <p class="gebs-category__intro">
                        Upcoming GEBS Technologies products in active development. Check back for launch details.
                    </p>
                    <div class="gebs-grid gebs-grid--future">
                        @foreach ($futureApps as $app)
                            @include('app-center.partials.tile', ['app' => $app, 'future' => true])
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </main>
@endsection
