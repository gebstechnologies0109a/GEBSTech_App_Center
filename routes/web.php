<?php

use App\Http\Controllers\AppCenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $target = '/app-center';

    if (request()->boolean('embed')) {
        $target .= '?embed=1';
    }

    return redirect($target);
});

Route::get('/app-center', [AppCenterController::class, 'index'])->name('app-center.index');
Route::get('/app/{slug}', [AppCenterController::class, 'show'])->name('app-center.show');
