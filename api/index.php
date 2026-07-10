<?php
$root = __DIR__ . '/..';

// Copy SQLite seed DB to Vercel's writable /tmp/
$seedDb = "$root/database/seed.sqlite";
$runtimeDb = '/tmp/edumarket.sqlite';
if (file_exists($seedDb) && !file_exists($runtimeDb)) {
    copy($seedDb, $runtimeDb);
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

// Set required environment variables (Laravel uses these when .env is absent)
$envVars = [
    'APP_KEY' => 'base64:NMtlsBpaCulSGZqcW2ri0iTRmHskki4JKsuiwHYa4N0=',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
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

require "$root/public/index.php";
