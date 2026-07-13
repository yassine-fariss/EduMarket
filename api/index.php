<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', '/tmp/php-error.log');

$root = __DIR__ . '/..';

// Set safe production defaults (can be overridden by Vercel env vars)
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = getenv('APP_DEBUG') ?: 'false';
$_ENV['SESSION_SECURE_COOKIE'] = 'true';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['QUEUE_CONNECTION'] = 'sync';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['LOG_LEVEL'] = 'error';
$_ENV['BROADCAST_CONNECTION'] = 'log';
$_ENV['FILESYSTEM_DISK'] = 'local';

// Database: use Vercel env vars if set (Aiven MySQL), otherwise fallback to SQLite
if (getenv('DB_HOST')) {
    $_ENV['DB_CONNECTION'] = getenv('DB_CONNECTION') ?: 'mysql';
} else {
    // Fallback: persistent SQLite in /tmp/ so the app works without env vars
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = '/tmp/edumarket.sqlite';
    // Copy seed database if it exists and runtime DB doesn't
    $seedDb = "$root/database/seed.sqlite";
    $runtimeDb = '/tmp/edumarket.sqlite';
    if (file_exists($seedDb) && !file_exists($runtimeDb)) {
        copy($seedDb, $runtimeDb);
    }
}

// Create writable storage directories in /tmp/
$tmpStorage = '/tmp/storage';
foreach (['framework/views', 'framework/cache', 'logs', 'app/public'] as $dir) {
    @mkdir("$tmpStorage/$dir", 0777, true);
}
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

// Copy cached service/packages files if present in deployment
$tmpBootstrap = '/tmp/bootstrap/cache';
@mkdir($tmpBootstrap, 0777, true);
foreach (['services.php', 'packages.php'] as $file) {
    $src = "$root/bootstrap/cache/$file";
    $dst = "$tmpBootstrap/$file";
    if (file_exists($src) && !file_exists($dst)) {
        copy($src, $dst);
    }
}
$_ENV['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';

foreach ($_ENV as $key => $value) {
    if (is_string($value)) {
        putenv("$key=$value");
    }
}

require "$root/public/index.php";
