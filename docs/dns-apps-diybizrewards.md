# DNS — `apps.diybizrewards.com`

The App Center returns **DNS_PROBE_FINISHED_NXDOMAIN** until this record exists.

DNS for `diybizrewards.com` is on **Google Cloud DNS** (nameservers `ns-cloud-d1.googledomains.com` … `d4`). Manage it in **Squarespace Domains** (Google Domains migrated there).

## Add this record

| Type | Host / name | Value | TTL |
|------|-------------|--------|-----|
| **A** | `apps` | `188.166.230.4` | 300 (default) |

Same IP as `api`, `portal`, and `frosty`.

## Verify (after 5–30 minutes)

```bash
nslookup apps.diybizrewards.com 8.8.8.8
```

Expected: `Address: 188.166.230.4`

## Then in Forge (site `3209532`)

1. **Domains** → **Add certificate** → **Let's Encrypt** → **Continue**
2. Open **https://apps.diybizrewards.com/app-center**

## Squarespace steps

1. Log in at [account.squarespace.com/domains](https://account.squarespace.com/domains)
2. Open **diybizrewards.com** → **DNS** / **DNS settings**
3. **Add record** → Type **A**, Host **apps**, Points to **188.166.230.4**
4. Save
