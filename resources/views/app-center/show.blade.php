@extends('layouts.app-center')

@section('title', $app->name . ' — GEBSTech App Center')
@section('meta_description', \Illuminate\Support\Str::limit($app->descriptionSummary(), 160))

@section('content')
    <section class="gebs-hero gebs-hero--compact">
        <div class="gebs-container">
            <a href="{{ route('app-center.index') }}{{ $gebsEmbedSuffix }}" class="gebs-back-link">&larr; Back to App Center</a>
            <div class="gebs-detail-header">
                <div class="gebs-detail-header__logo gebs-glass-card">
                    @if ($app->logoUrl())
                        <img src="{{ $app->logoUrl() }}" alt="{{ $app->name }} logo" height="80">
                    @else
                        <span class="gebs-tile__initials gebs-tile__initials--lg">{{ strtoupper(substr($app->name, 0, 2)) }}</span>
                    @endif
                </div>
                <div class="gebs-detail-header__copy">
                    <div class="gebs-detail-badges">
                        <span class="gebs-badge">{{ $app->category }}</span>
                        @if ($app->isFuture())
                            <span class="gebs-badge gebs-badge--soon">Coming soon</span>
                        @endif
                    </div>
                    <h1 class="gebs-hero__title gebs-hero__title--sm">{{ $app->name }}</h1>
                    <p class="gebs-hero__subtitle gebs-hero__subtitle--left">{{ $app->descriptionSummary() }}</p>
                </div>
            </div>
        </div>
    </section>

    <main class="gebs-main gebs-main--detail">
        <div class="gebs-container gebs-detail-layout">
            <article class="gebs-panel gebs-glass-card">
                <h2 class="gebs-panel__title">About</h2>
                <div class="gebs-panel__body">
                    {!! nl2br(e($app->descriptionSummary())) !!}
                </div>
            </article>

            @if (count($app->featureList()) > 0)
                <article class="gebs-panel gebs-glass-card">
                    <h2 class="gebs-panel__title">Features</h2>
                    <ul class="gebs-features">
                        @foreach ($app->featureList() as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </article>
            @endif
        </div>
    </main>
@endsection
