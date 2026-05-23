# Forge deployment — GEBSTech App Center

**URL:** https://apps.diybizrewards.com  
**Forge site ID:** `3209532` on server `1205324` (`188.166.230.4`)  
**Web directory:** `/public`  
**PHP:** 8.3+ (server may run 8.4) · **Database:** MySQL/MariaDB · **SSL:** Let's Encrypt

## DNS & SSL (live)

| Type | Name | Value |
|------|------|--------|
| **A** | `apps` | `188.166.230.4` |

Manage in **Shopify** → Domains → `diybizrewards.com` → DNS (see [docs/dns-apps-diybizrewards.md](docs/dns-apps-diybizrewards.md)).

**Site:** https://forge.laravel.com/gebs-6l1/diybizrewards/3209532

## GitHub → Forge (push to deploy)

This site was created **without** a Forge-linked repository (no **Git** section in Forge Settings). Code on the server already tracks:

`gebstechnologies0109a/GEBSTech_App_Center` @ `main`

### Option A — Forge API (links Git + webhook)

1. Forge → profile menu → **API** → copy a token (or create one with `site:manage-project`).
2. In PowerShell:

```powershell
$env:FORGE_API_TOKEN = 'paste-token-here'
.\scripts\forge-setup-apps.ps1
```

This calls `POST …/sites/3209532/git` and triggers a deploy.

### Option B — Deploy hook webhook

1. Forge → [Deployments settings](https://forge.laravel.com/gebs-6l1/diybizrewards/3209532/settings/deployments) → copy the full **Deploy hook** URL.
2. GitHub → **GEBSTech_App_Center** → **Settings → Webhooks → Add webhook**
   - Payload URL: deploy hook URL
   - Content type: `application/json`
   - Events: **Just the push event**

(GitHub may ask for email verification before saving webhooks.)

### Option C — GitHub Actions

1. Add repo secret **`FORGE_DEPLOY_HOOK`** = full deploy hook URL from Forge.
2. Workflow `.github/workflows/forge-deploy.yml` runs on every push to `main`.

Deploy script in Forge should match `forge-deploy.sh` (composer, npm build, migrate, seed, optimize).

## Environment (`.env`)

Copy from `forge.env.production.example` and set `APP_KEY` plus `DB_PASSWORD`.

```env
APP_NAME="GEBSTech App Center"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://apps.diybizrewards.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gebstech_app_center
DB_USERNAME=forge
DB_PASSWORD=xxxx

GEBS_FRAME_ANCESTORS=https://api.diybizrewards.com https://portal.diybizrewards.com https://frosty.diybizrewards.com https://diybizrewards.com https://www.diybizrewards.com
```

## Deploy script (Forge)

Paste `forge-deploy.sh` or:

```bash
cd $FORGE_SITE_PATH

composer install --no-interaction --prefer-dist --optimize-autoloader

npm ci
npm run build

php artisan migrate --force
php artisan db:seed --class=AppItemSeeder --force
php artisan optimize
```

## DNS

| Type | Name | Value |
|------|------|--------|
| A | `apps` | Your Forge server IP |

## Embed (iframe)

```html
<iframe
  src="https://apps.diybizrewards.com/app-center"
  title="GEBSTech App Center"
  style="width:100%; height:100vh; border:none;"
></iframe>
```

Allowed parent origins: `GEBS_FRAME_ANCESTORS` in `.env`.
