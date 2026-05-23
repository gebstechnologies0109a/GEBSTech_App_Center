# Set FORGE_API_TOKEN for this PowerShell session.
#
# Option A (clipboard often fails from browser -> VS Code):
#   .\scripts\set-forge-token.ps1 -Token 'eyJ...paste-full-token...'
#
# Option B (clipboard):
#   Copy token in Forge, then: .\scripts\set-forge-token.ps1

param(
    [Parameter(Mandatory = $false)]
    [string]$Token
)

$ErrorActionPreference = 'Stop'

if (-not $Token) {
    $Token = (Get-Clipboard -Raw).Trim()
}

if (-not $Token.StartsWith('eyJ')) {
    throw @"
No valid Forge API token (must start with eyJ).

Use Option A in VS Code PowerShell (replace with your copied token):

  cd C:\laragon\www\GEBSTech_Apps
  .\scripts\set-forge-token.ps1 -Token 'eyJpaste-your-full-token-here'

Create token: https://forge.laravel.com/profile/api
"@
}

$env:FORGE_API_TOKEN = $Token
$projectRoot = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
Write-Host "Project: $projectRoot" -ForegroundColor Cyan
Write-Host "FORGE_API_TOKEN set (length $($Token.Length))." -ForegroundColor Green
