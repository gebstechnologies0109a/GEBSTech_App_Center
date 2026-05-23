#!/usr/bin/env bash
# Run on Forge server AFTER apps.diybizrewards.com resolves to 188.166.230.4
set -e
if ! getent hosts apps.diybizrewards.com | grep -q '188.166.230.4'; then
  echo "DNS not ready. Add A record: apps -> 188.166.230.4"
  exit 1
fi
sudo certbot --nginx -d apps.diybizrewards.com --non-interactive --agree-tos --redirect || true
echo "Done. Test: https://apps.diybizrewards.com/app-center"
