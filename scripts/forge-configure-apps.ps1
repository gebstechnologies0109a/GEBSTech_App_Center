# Full Forge setup for apps.diybizrewards.com.
# Usage:
#   .\scripts\forge-configure-apps.ps1 -Token 'eyJ...'
# Or set $env:FORGE_API_TOKEN first, then run without -Token.

param(
    [Parameter(Mandatory = $false)]
    [string]$Token
)

$ErrorActionPreference = 'Stop'
$root = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
Set-Location $root
Write-Host "Working directory: $root" -ForegroundColor Cyan

if ($Token) {
    & "$PSScriptRoot\set-forge-token.ps1" -Token $Token
} elseif (-not $env:FORGE_API_TOKEN) {
    & "$PSScriptRoot\set-forge-token.ps1"
}
& "$PSScriptRoot\forge-update-deploy-script.ps1"
& "$PSScriptRoot\forge-setup-apps.ps1"

Write-Host "`nDone. Open https://apps.diybizrewards.com/app-center" -ForegroundColor Green
