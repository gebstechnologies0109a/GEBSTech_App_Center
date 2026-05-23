<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(
            ['layouts.app-center', 'app-center.*', 'app-center.partials.*'],
            function ($view): void {
                $view->with(
                    'gebsEmbedSuffix',
                    request()->boolean('embed') ? '?embed=1' : ''
                );
            }
        );
    }
}
