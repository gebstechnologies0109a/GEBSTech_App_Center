@php
    $isFuture = $future ?? false;
    $href = $isFuture && ! $app->isActive()
        ? route('app-center.show', $app->slug) . $gebsEmbedSuffix
        : route('app-center.show', $app->slug) . $gebsEmbedSuffix;
@endphp

<a href="{{ $href }}" class="gebs-tile gebs-glass-card @if ($isFuture) gebs-tile--future @endif">
    <div class="gebs-tile__logo-wrap" aria-hidden="true">
        @if ($app->logoUrl())
            <img class="gebs-tile__logo" src="{{ $app->logoUrl() }}" alt="" width="80" height="80" loading="lazy">
        @else
            <span class="gebs-tile__initials">{{ strtoupper(substr($app->name, 0, 2)) }}</span>
        @endif
    </div>
    <div class="gebs-tile__body">
        <span class="gebs-tile__category">{{ $app->category }}</span>
        <h3 class="gebs-tile__title">{{ $app->name }}</h3>
        <p class="gebs-tile__desc">{{ \Illuminate\Support\Str::limit($app->descriptionSummary(), 120) }}</p>
    </div>
    <span class="gebs-tile__cta">
        @if ($isFuture && ! $app->isActive())
            Preview <span aria-hidden="true">&rarr;</span>
        @else
            View details <span aria-hidden="true">&rarr;</span>
        @endif
    </span>
</a>
