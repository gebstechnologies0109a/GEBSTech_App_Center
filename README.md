# GEBSTech App Center

Public app marketplace for **GEBS Technologies**.  
**Production:** https://apps.diybizrewards.com

## Routes

| URL | Description |
|-----|-------------|
| `/app-center` | Landing grid by category + future apps |
| `/app/{slug}` | App detail (features parsed from description bullets) |

## Database: `apps`

| Column | Type |
|--------|------|
| `name` | string |
| `slug` | string (unique) |
| `category` | string |
| `description` | text (summary + `-` bullet features) |
| `logo_path` | string, nullable |
| `download_link` | string, nullable |
| `status` | `active` \| `inactive` |

## Paths

| | Path |
|--|------|
| **Local (Windows)** | `C:\laragon\www\GEBSTech_Apps` |
| **Production server** | `/home/forge/apps.diybizrewards.com` |

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
php artisan serve
```

## Deployment

See [FORGE.md](FORGE.md) and `forge-deploy.sh`.

## Embed

```html
<iframe
  src="https://apps.diybizrewards.com/app-center"
  title="GEBSTech App Center"
  style="width:100%; height:100vh; border:none;"
></iframe>
```
