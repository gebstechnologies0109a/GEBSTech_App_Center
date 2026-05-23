# Forge deployment — GEBSTech App Center

**URL:** https://apps.diybizrewards.com  
**Web directory:** `/public`  
**PHP:** 8.3+ (server may run 8.4) · **Database:** MySQL/MariaDB · **SSL:** Let's Encrypt

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
