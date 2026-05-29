@php
    $isFuture = $future ?? false;
    $href = route('app-center.show', $app->slug) . $gebsEmbedSuffix;
@endphp

<a href="{{ $href }}" class="gebs-tile gebs-glass-card @if ($isFuture) gebs-tile--future @endif">
    <div class="gebs-tile__logo-wrap" aria-hidden="true">
        @if ($app->logoUrl())
            <img class="gebs-tile__logo" src="{{ $app->logoUrl() }}" alt="" height="40" loading="lazy">
        @else
            <span class="gebs-tile__initials">{{ strtoupper(substr($app->name, 0, 2)) }}</span>
        @endif
    </div>
    <h3 class="gebs-tile__title">{{ $app->name }}</h3>
    @if ($app->description)
        <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($app->descriptionSummary(), 100) }}</p>
    @endif
</a>
