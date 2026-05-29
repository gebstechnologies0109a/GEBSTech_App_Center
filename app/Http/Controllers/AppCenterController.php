<?php

namespace App\Http\Controllers;

use App\Models\AppItem;
use Illuminate\View\View;

class AppCenterController extends Controller
{
    public function index(): View
    {
        $apps = AppItem::where('status', 'active')->get();

        return view('app-center.index', [
            'apps' => $apps,
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
