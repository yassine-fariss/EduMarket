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
    if (!copy($seedDb, $runtimeDb)) {
        echo "Failed to copy seed DB\n";
    }
}

// Create writable storage directories in /tmp/
$tmpStorage = '/tmp/storage';
$dirs = ['framework/views', 'framework/cache', 'framework/sessions', 'logs'];
foreach ($dirs as $dir) {
    $path = "$tmpStorage/$dir";
    if (!is_dir($path)) {
        @mkdir($path, 0777, true);
    }
}

// Set required environment variables
$envVars = [
    'APP_KEY' => 'base64:NMtlsBpaCulSGZqcW2ri0iTRmHskki4JKsuiwHYa4N0=',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'true',
    'APP_URL' => 'https://edumarket.vercel.app',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => '/tmp/edumarket.sqlite',
    'SESSION_DRIVER' => 'database',
    'CACHE_STORE' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'APP_MAINTENANCE_DRIVER' => 'file',
];

foreach ($envVars as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}

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
