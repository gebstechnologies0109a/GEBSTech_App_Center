# DNS — `apps.diybizrewards.com`

The App Center returns **DNS_PROBE_FINISHED_NXDOMAIN** until this record exists.

DNS for `diybizrewards.com` uses **Google Cloud DNS** nameservers (`ns-cloud-d1.googledomains.com` … `d4`). Subdomains like `api`, `portal`, and `frosty` already point to `188.166.230.4`; **`apps` is missing**.

Manage DNS in the **same place you added `api` and `portal`** — typically:

1. **[Google Cloud Console → Cloud DNS](https://console.cloud.google.com/net-services/dns/zones)** (project that hosts the `diybizrewards.com` zone), **or**
2. The Google / Squarespace account that still owns the domain registration (not every Squarespace login lists domains; use the account that registered `diybizrewards.com`).

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
