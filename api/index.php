<?php
$root = __DIR__ . '/..';

// Copy .env.example to .env if missing (Vercel doesn't deploy gitignored files)
$envPath = "$root/.env";
$envExample = "$root/.env.example";
if (!file_exists($envPath) && file_exists($envExample)) {
    copy($envExample, $envPath);
}

// Ensure APP_KEY is set in .env
$envContent = file_get_contents($envPath);
if (preg_match('/^APP_KEY=/m', $envContent)) {
    $envContent = preg_replace('/^APP_KEY=.*$/m', 'APP_KEY=base64:NMtlsBpaCulSGZqcW2ri0iTRmHskki4JKsuiwHYa4N0=', $envContent);
} else {
    $envContent .= "\nAPP_KEY=base64:NMtlsBpaCulSGZqcW2ri0iTRmHskki4JKsuiwHYa4N0=\n";
}
file_put_contents($envPath, $envContent);

// Copy SQLite seed DB to Vercel's writable /tmp/
$seedDb = "$root/database/seed.sqlite";
$runtimeDb = '/tmp/edumarket.sqlite';
if (file_exists($seedDb) && !file_exists($runtimeDb)) {
    copy($seedDb, $runtimeDb);
}

// Set required environment variables (Laravel will merge these with .env)
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
