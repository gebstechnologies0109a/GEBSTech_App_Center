<?php

namespace App\Http\Controllers;

use App\Models\AppItem;
use Illuminate\View\View;

class AppCenterController extends Controller
{
    public function index(): View
    {
        $appsByCategory = AppItem::query()
            ->listed()
            ->get()
            ->groupBy('category');

        $futureApps = AppItem::query()->future()->get();

        return view('app-center.index', [
            'appsByCategory' => $appsByCategory,
            'futureApps' => $futureApps,
            'totalApps' => $appsByCategory->flatten()->count(),
        ]);
    }

    public function show(string $slug): View
    {
        $app = AppItem::query()
            ->where('slug', $slug)
            ->where(function ($query): void {
                $query->where('status', AppItem::STATUS_ACTIVE)
                    ->orWhere('category', AppItem::CATEGORY_FUTURE);
            })
            ->firstOrFail();

        return view('app-center.show', [
            'app' => $app,
        ]);
    }
}
