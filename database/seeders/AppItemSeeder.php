<?php

namespace Database\Seeders;

use App\Models\AppItem;
use Illuminate\Database\Seeder;

class AppItemSeeder extends Seeder
{
    public function run(): void
    {
        $apps = [
            [
                'name' => 'FrostySystem',
                'slug' => 'frosty-system',
                'category' => 'Retail Operations',
                'description' => "Complete cold-chain and frozen inventory operations for GEBS retail.\n\n- Real-time freezer and cold-chain monitoring\n- Multi-location inventory with rotation rules\n- Compliance-ready audit trails and alerts\n- Deep integration with FrostyPOS",
                'logo_path' => 'logos/frosty-system.svg',
                'download_link' => '#frosty-system',
                'status' => AppItem::STATUS_ACTIVE,
            ],
            [
                'name' => 'FrostyPOS',
                'slug' => 'frosty-pos',
                'category' => 'Retail Operations',
                'description' => "Point of sale tuned for frozen and convenience retail.\n\n- Lightning-fast checkout for high-volume lanes\n- Loyalty and member lookup at the register\n- Live inventory sync with FrostySystem\n- Operator-friendly touchscreen workflows",
                'logo_path' => 'logos/frosty-pos.svg',
                'download_link' => '#frosty-pos',
                'status' => AppItem::STATUS_ACTIVE,
            ],
            [
                'name' => 'DIY-Biz-Rewards',
                'slug' => 'diy-biz-rewards',
                'category' => 'Loyalty & Engagement',
                'description' => "Member rewards, referrals, and premium engagement for your brand.\n\n- Branded member portals and referral programs\n- Points, tiers, and redemption rules\n- Premium DIY Biz design system out of the box\n- Embeddable widgets for partner sites",
                'logo_path' => 'logos/diy-biz-rewards.svg',
                'download_link' => 'https://portal.diybizrewards.com',
                'status' => AppItem::STATUS_ACTIVE,
            ],
            [
                'name' => 'DIY-Biz-Shop',
                'slug' => 'diy-biz-shop',
                'category' => 'Loyalty & Engagement',
                'description' => "Curated storefront and catalog for reward redemptions.\n\n- Reward catalog with categories and search\n- Inventory-aware redemption limits\n- Order and fulfillment tracking\n- Tight coupling with DIY-Biz-Rewards balances",
                'logo_path' => 'logos/diy-biz-shop.svg',
                'download_link' => '#diy-biz-shop',
                'status' => AppItem::STATUS_ACTIVE,
            ],
            [
                'name' => 'GEBS Kiosk Manager',
                'slug' => 'gebs-kiosk-manager',
                'category' => 'Field & Infrastructure',
                'description' => "Deploy, monitor, and update self-service kiosks remotely.\n\n- Remote kiosk health and uptime dashboards\n- Content and playlist deployment\n- Transaction summaries by location\n- Alerting for offline or error states",
                'logo_path' => 'logos/gebs-kiosk-manager.svg',
                'download_link' => '#gebs-kiosk-manager',
                'status' => AppItem::STATUS_ACTIVE,
            ],
            [
                'name' => 'GEBS Equipment Tools',
                'slug' => 'gebs-equipment-tools',
                'category' => 'Field & Infrastructure',
                'description' => "Maintenance, assets, and equipment lifecycle for field teams.\n\n- Asset registry with serial and warranty data\n- Preventive maintenance scheduling\n- Field technician mobile workflows\n- Partner and vendor assignment",
                'logo_path' => 'logos/gebs-equipment-tools.svg',
                'download_link' => '#gebs-equipment-tools',
                'status' => AppItem::STATUS_ACTIVE,
            ],
            [
                'name' => 'GEBS Analytics Hub',
                'slug' => 'gebs-analytics-hub',
                'category' => AppItem::CATEGORY_FUTURE,
                'description' => "Unified executive dashboards across the entire GEBS product suite.\n\n- Cross-app KPI rollups and trend analysis\n- Role-based views for operators and partners\n- Exportable reports and scheduled digests\n- Early access for select GEBS partners",
                'logo_path' => 'logos/gebs-analytics-hub.svg',
                'download_link' => '#gebs-analytics-hub',
                'status' => AppItem::STATUS_INACTIVE,
            ],
            [
                'name' => 'GEBS Partner Portal',
                'slug' => 'gebs-partner-portal',
                'category' => AppItem::CATEGORY_FUTURE,
                'description' => "A dedicated hub for GEBS partners to manage installs, billing, and support.\n\n- Partner onboarding and certification tracking\n- Shared ticketing with GEBS support\n- Co-branded assets and documentation\n- Revenue and commission visibility",
                'logo_path' => 'logos/gebs-partner-portal.svg',
                'download_link' => '#gebs-partner-portal',
                'status' => AppItem::STATUS_INACTIVE,
            ],
            [
                'name' => 'GEBS Mobile Command',
                'slug' => 'gebs-mobile-command',
                'category' => AppItem::CATEGORY_FUTURE,
                'description' => "Mobile-first command center for owners on the go.\n\n- Push alerts for critical store events\n- Approvals and overrides from any device\n- Snapshot metrics from all connected GEBS apps\n- Biometric sign-in for field leaders",
                'logo_path' => 'logos/gebs-mobile-command.svg',
                'download_link' => '#gebs-mobile-command',
                'status' => AppItem::STATUS_INACTIVE,
            ],
        ];

        foreach ($apps as $app) {
            AppItem::query()->updateOrCreate(
                ['slug' => $app['slug']],
                $app
            );
        }
    }
}
