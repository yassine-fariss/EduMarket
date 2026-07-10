<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');
ini_set('error_log', '/tmp/php-error.log');

$root = __DIR__ . '/..';

// Copy SQLite seed DB to Vercel's writable /tmp/
$seedDb = "$root/database/seed.sqlite";
$runtimeDb = '/tmp/edumarket.sqlite';
if (file_exists($seedDb) && !file_exists($runtimeDb)) {
    copy($seedDb, $runtimeDb);
}

// Create writable storage directories in /tmp/
$tmpStorage = '/tmp/storage';
$dirs = ['framework/views', 'framework/cache', 'framework/sessions', 'logs', 'app/public', 'app/private'];
foreach ($dirs as $dir) {
    @mkdir("$tmpStorage/$dir", 0777, true);
}

// Create writable bootstrap cache directory in /tmp/ and copy cache files
$tmpBootstrap = '/tmp/bootstrap/cache';
@mkdir($tmpBootstrap, 0777, true);
foreach (['services.php', 'packages.php'] as $file) {
    $src = "$root/bootstrap/cache/$file";
    $dst = "$tmpBootstrap/$file";
    if (file_exists($src) && !file_exists($dst)) {
        copy($src, $dst);
    }
}

// Redirect Laravel cache paths to /tmp/ via env vars (read by normalizeCachePath)
$_ENV['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';

// Bootstrap Laravel with error handling
try {
    require "$root/public/index.php";
} catch (Throwable $e) {
    header('Content-Type: text/plain');
    http_response_code(500);
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
