<?php

namespace Tests\Feature;

use App\Models\AppItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppCenterTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_redirects_to_app_center(): void
    {
        $this->get('/')
            ->assertRedirect('/app-center');
    }

    public function test_app_center_lists_all_active_apps(): void
    {
        AppItem::query()->create([
            'name' => 'Test App',
            'slug' => 'test-app',
            'category' => 'Retail Operations',
            'description' => "Summary line.\n\n- Feature A",
            'status' => AppItem::STATUS_ACTIVE,
        ]);

        AppItem::query()->create([
            'name' => 'Hidden',
            'slug' => 'hidden',
            'category' => 'Retail Operations',
            'description' => 'Hidden app',
            'status' => AppItem::STATUS_INACTIVE,
        ]);

        $this->get('/app-center')
            ->assertOk()
            ->assertSee('Test App')
            ->assertSee('Summary line.')
            ->assertDontSee('Hidden');
    }

    public function test_app_detail_page_shows_features_and_cta(): void
    {
        AppItem::query()->create([
            'name' => 'Demo App',
            'slug' => 'demo-app',
            'category' => 'Loyalty',
            'description' => "A demo application.\n\n- Feature one\n- Feature two",
            'download_link' => '#demo',
            'status' => AppItem::STATUS_ACTIVE,
        ]);

        $this->get('/app/demo-app')
            ->assertOk()
            ->assertSee('Demo App')
            ->assertSee('Feature one')
            ->assertDontSee('Download / Learn More');
    }

    public function test_future_app_detail_is_accessible(): void
    {
        AppItem::query()->create([
            'name' => 'Future Only',
            'slug' => 'future-only',
            'category' => AppItem::CATEGORY_FUTURE,
            'description' => "Coming soon.\n\n- Planned feature",
            'status' => AppItem::STATUS_INACTIVE,
        ]);

        $this->get('/app/future-only')->assertOk()->assertSee('Coming soon');
    }

    public function test_inactive_non_future_app_returns_not_found(): void
    {
        AppItem::query()->create([
            'name' => 'Inactive',
            'slug' => 'inactive',
            'category' => 'Retail Operations',
            'description' => 'Nope',
            'status' => AppItem::STATUS_INACTIVE,
        ]);

        $this->get('/app/inactive')->assertNotFound();
    }

    public function test_iframe_embedding_headers_are_set(): void
    {
        $response = $this->get('/app-center');

        $response->assertHeaderMissing('X-Frame-Options');
        $this->assertStringContainsString(
            'frame-ancestors',
            (string) $response->headers->get('Content-Security-Policy')
        );
    }
}
