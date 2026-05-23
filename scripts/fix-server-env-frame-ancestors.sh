#!/usr/bin/env bash
set -euo pipefail
ENV_FILE="${1:-/home/forge/apps.diybizrewards.com/.env}"
LINE='GEBS_FRAME_ANCESTORS="https://api.diybizrewards.com https://portal.diybizrewards.com https://frosty.diybizrewards.com https://diybizrewards.com https://www.diybizrewards.com"'
grep -v '^GEBS_FRAME_ANCESTORS=' "$ENV_FILE" > "${ENV_FILE}.new"
echo "$LINE" >> "${ENV_FILE}.new"
mv "${ENV_FILE}.new" "$ENV_FILE"
grep '^GEBS_FRAME_ANCESTORS=' "$ENV_FILE"
