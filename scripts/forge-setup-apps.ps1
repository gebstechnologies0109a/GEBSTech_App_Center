<#
.SYNOPSIS
    Deploy GEBSTech App Center on Forge site apps.diybizrewards.com (3209532).

.DESCRIPTION
    Requires:
      $env:FORGE_API_TOKEN
      DNS A record: apps -> 188.166.230.4 (see docs/dns-apps-diybizrewards.md)

    Actions:
      1. Install GitHub repo gebstechnologies0109a/GEBSTech_App_Center @ main
      2. Trigger deployment
      3. Request Let's Encrypt for apps.diybizrewards.com

.NOTES
    Server 1205324 | Site 3209532
#>
[CmdletBinding()]
param(
    [string]$Domain = 'apps.diybizrewards.com',
    [string]$Repository = 'gebstechnologies0109a/GEBSTech_App_Center',
    [string]$Branch = 'main',
    [int]$ServerId = 1205324,
    [int]$SiteId = 3209532
)

$ErrorActionPreference = 'Stop'
$apiBase = 'https://forge.laravel.com/api/v1'

function Get-ForgeHeaders {
    if (-not $env:FORGE_API_TOKEN) {
        throw 'Set FORGE_API_TOKEN (Forge → Account → API). DNS must point apps to 188.166.230.4 first for SSL.'
    }
    @{
        Authorization = "Bearer $($env:FORGE_API_TOKEN)"
        Accept          = 'application/json'
        'Content-Type'  = 'application/json'
    }
}

function Invoke-Forge([string]$Method, [string]$Uri, $Body = $null) {
    $params = @{ Method = $Method; Uri = $Uri; Headers = (Get-ForgeHeaders) }
    if ($null -ne $Body) { $params.Body = ($Body | ConvertTo-Json -Depth 8) }
    return Invoke-RestMethod @params
}

Write-Host "`n=== Install Git repository ===" -ForegroundColor Cyan
try {
    Invoke-Forge Post "$apiBase/servers/$ServerId/sites/$SiteId/git" @{
        provider   = 'github'
        repository = $Repository
        branch     = $Branch
    } | Out-Null
    Write-Host "Repository linked: $Repository @ $Branch"
} catch {
    Write-Warning "Git install API call failed (site may already have a repo): $($_.Exception.Message)"
}

Write-Host "`n=== Deploy ===" -ForegroundColor Cyan
Invoke-Forge Post "$apiBase/servers/$ServerId/sites/$SiteId/deployment/deploy" @{} | Out-Null
Write-Host 'Deployment triggered.'

Write-Host "`n=== Let's Encrypt ===" -ForegroundColor Cyan
try {
    Invoke-Forge Post "$apiBase/servers/$ServerId/sites/$SiteId/certificates/letsencrypt" @{
        domains = @($Domain)
    } | Out-Null
    Write-Host "SSL requested for $Domain"
} catch {
    Write-Warning "SSL failed (add DNS A record apps -> 188.166.230.4, wait, retry): $($_.Exception.Message)"
}

Write-Host "`nVerify: https://$Domain/app-center" -ForegroundColor Green
