<?php

/**
 * Run git pull only on Forge (when FORGE_SITE_PATH is set).
 * Used from composer pre-install-cmd so local composer install is unaffected.
 */

if (! getenv('FORGE_SITE_PATH')) {
    return;
}

passthru('git pull origin main 2>&1', $code);

if ($code !== 0) {
    fwrite(STDERR, "git pull failed with exit code {$code}\n");
    exit($code);
}
