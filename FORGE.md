# Forge deployment — GEBSTech App Center

| | |
|--|--|
| **URL** | https://apps.diybizrewards.com |
| **Forge site** | [3209532](https://forge.laravel.com/gebs-6l1/diybizrewards/3209532) on server `1205324` (`188.166.230.4`) |
| **Server path** | `/home/forge/apps.diybizrewards.com` |
| **Web root** | `/public` |
| **GitHub** | `gebstechnologies0109a/GEBSTech_App_Center` @ `main` |

## DNS (live)

| Type | Name | Value |
|------|------|--------|
| **A** | `apps` | `188.166.230.4` |

Details: [docs/dns-apps-diybizrewards.md](docs/dns-apps-diybizrewards.md)

## Push to deploy

Push to **`main`** → Forge runs the deploy script (Git linked on the site).

Optional GitHub Actions workflow (`.github/workflows/forge-deploy.yml`) POSTs the Forge deploy hook if repo secret **`FORGE_DEPLOY_HOOK`** is set; otherwise the job skips (green).

## One-time Forge API setup (local PC)

```powershell
cd C:\laragon\www\GEBSTech_Apps
.\scripts\forge-configure-apps.ps1 -Token 'eyJ...'
```

Or: `.\scripts\set-forge-token.ps1 -Token 'eyJ...'` then `forge-update-deploy-script.ps1` and `forge-setup-apps.ps1`.

## Deploy script

Use `forge-deploy.sh` in Forge **Settings → Deployments** (or the API script updater):

```bash
cd $FORGE_SITE_PATH
git pull origin main
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
npm ci
npm run build
php artisan migrate --force
php artisan db:seed --class=AppItemSeeder --force
php artisan optimize
```

On Forge only, `composer.json` runs `scripts/composer-forge-git-pull.php` before install (when `FORGE_SITE_PATH` is set).

## Production `.env` (Forge)

Copy from `forge.env.production.example`. Required:

- **`APP_KEY`** — run `php artisan key:generate --force` once if empty
- **`DB_PASSWORD`**
- **`GEBS_FRAME_ANCESTORS`** — must be **quoted** (spaces):

```env
GEBS_FRAME_ANCESTORS="https://api.diybizrewards.com https://portal.diybizrewards.com https://frosty.diybizrewards.com https://diybizrewards.com https://www.diybizrewards.com"
```

Fix on server if needed: `bash scripts/fix-server-env-frame-ancestors.sh`

## Manual deploy (SSH)

```bash
ssh forge@188.166.230.4
cd /home/forge/apps.diybizrewards.com
bash forge-deploy.sh
```

## Embed

```html
<iframe
  src="https://apps.diybizrewards.com/app-center?embed=1"
  title="GEBSTech App Center"
  style="width:100%; height:100vh; border:none;"
></iframe>
```

Allowed parents: `GEBS_FRAME_ANCESTORS` in `.env`.
