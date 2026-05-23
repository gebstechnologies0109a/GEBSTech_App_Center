# Updates Forge deploy script for apps.diybizrewards.com (site 3209532).
# Usage: $env:FORGE_API_TOKEN = 'paste-from-forge-profile-api'; .\scripts\forge-update-deploy-script.ps1

$ErrorActionPreference = 'Stop'
if (-not $env:FORGE_API_TOKEN) {
    throw 'Set FORGE_API_TOKEN first. Run: .\scripts\set-forge-token.ps1'
}

$scriptContent = @'
cd $FORGE_SITE_PATH

git pull origin main

composer install --no-interaction --prefer-dist --optimize-autoloader

npm ci
npm run build

php artisan migrate --force
php artisan db:seed --class=AppItemSeeder --force
php artisan optimize
'@

$uri = 'https://forge.laravel.com/api/v1/servers/1205324/sites/3209532/deployment/script'
$body = @{ content = $scriptContent.TrimEnd(); auto_source = $false } | ConvertTo-Json

$response = Invoke-RestMethod -Method Put -Uri $uri -Headers @{
    Authorization = "Bearer $($env:FORGE_API_TOKEN)"
    Accept          = 'application/json'
    'Content-Type'  = 'application/json'
} -Body $body

Write-Host 'Deploy script updated.' -ForegroundColor Green
$response
