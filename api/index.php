<?php
$root = __DIR__ . '/..';

// Copy SQLite seed DB to Vercel's writable /tmp/
$seedDb = "$root/database/seed.sqlite";
$runtimeDb = '/tmp/edumarket.sqlite';
if (file_exists($seedDb) && !file_exists($runtimeDb)) {
    copy($seedDb, $runtimeDb);
}

// Set required environment variables (Laravel uses these when .env is absent)
$envVars = [
    'APP_KEY' => 'base64:NMtlsBpaCulSGZqcW2ri0iTRmHskki4JKsuiwHYa4N0=',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => '/tmp/edumarket.sqlite',
    'SESSION_DRIVER' => 'database',
    'CACHE_STORE' => 'array',
    'QUEUE_CONNECTION' => 'sync',
];

foreach ($envVars as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}

require "$root/public/index.php";
