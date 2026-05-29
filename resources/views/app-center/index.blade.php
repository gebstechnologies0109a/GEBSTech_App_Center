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
        </div>
    </section>

    <main class="gebs-main">
        <div class="gebs-container">
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @forelse ($apps as $app)
                    <div class="col">
                        @include('app-center.partials.tile', ['app' => $app])
                    </div>
                @empty
                    <div class="gebs-empty gebs-glass-card">
                        <p>No applications are available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
