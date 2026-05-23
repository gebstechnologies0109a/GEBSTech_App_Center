# DNS & SSL — `apps.diybizrewards.com`

**Status (May 2026):** Live at [https://apps.diybizrewards.com/app-center](https://apps.diybizrewards.com/app-center) with Let's Encrypt on Forge site `3209532`.

## DNS record

| Type | Host / name | Value | TTL |
|------|-------------|--------|-----|
| **A** | `apps` | `188.166.230.4` | 300 (default) |

Same IP as `api`, `portal`, `frosty`, and `rewards`.

### Where to manage DNS

Subdomains for `diybizrewards.com` are managed in **Shopify admin → Settings → Domains → diybizrewards.com → DNS settings** (not every Squarespace login lists this domain).

If you use Google Cloud DNS for the zone instead, add the same **A** record there.

## Verify DNS

```bash
nslookup apps.diybizrewards.com 8.8.8.8
```

Expected: `Address: 188.166.230.4`

## SSL in Forge

1. **Settings → Domains** → set redirects to **No redirect** (do not use “Redirect from www” unless `www.apps` has its own DNS record).
2. **Domains → Add certificate → Let's Encrypt** → domain **`apps.diybizrewards.com`** → **HTTP-01** → **Obtain certificate**.
3. Open **https://apps.diybizrewards.com/app-center**

## Embed URL

Use in GEBS apps:

`https://apps.diybizrewards.com/app-center?embed=1`

Allowed parent origins are set via `GEBS_FRAME_ANCESTORS` in production `.env`.
