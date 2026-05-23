<?php

/**
 * Run git pull only on the Forge server during deploy.
 * Skips on Windows/local dev even if FORGE_SITE_PATH is set in the shell.
 */

if (PHP_OS_FAMILY !== 'Linux') {
    return;
}

$forgePath = getenv('FORGE_SITE_PATH');
if (! $forgePath || ! is_dir($forgePath)) {
    return;
}

$cwd = getcwd() ?: '';
if ($cwd !== $forgePath && realpath($cwd) !== realpath($forgePath)) {
    return;
}

passthru('git pull origin main 2>&1', $code);

if ($code !== 0) {
    fwrite(STDERR, "git pull failed with exit code {$code}\n");
    exit($code);
}
