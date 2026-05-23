#!/usr/bin/env bash
set -e

cd "$FORGE_SITE_PATH"

git pull origin main

composer install --no-interaction --prefer-dist --optimize-autoloader

npm ci
npm run build

php artisan migrate --force
php artisan db:seed --class=AppItemSeeder --force
php artisan optimize
