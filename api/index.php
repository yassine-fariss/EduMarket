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

// Create cart_items table in runtime database (migration not run on Vercel)
try {
    $pdo = new PDO("sqlite:$runtimeDb");
    $pdo->exec("CREATE TABLE IF NOT EXISTS cart_items (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        product_id INTEGER NOT NULL,
        quantity INTEGER NOT NULL DEFAULT 1,
        created_at TEXT,
        updated_at TEXT,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        UNIQUE(user_id, product_id)
    )");
} catch (Exception $e) {
    // Table creation failed, will be handled by Laravel's migration if possible
}

// Create writable storage directories in /tmp/
$tmpStorage = '/tmp/storage';
foreach (['framework/views', 'framework/cache', 'framework/sessions', 'logs', 'app/public', 'app/private'] as $dir) {
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

// Set all environment variables for Laravel (Vercel may not load .env)
$env = [
    'APP_NAME' => 'EduMarket',
    'APP_KEY' => 'base64:NMtlsBpaCulSGZqcW2ri0iTRmHskki4JKsuiwHYa4N0=',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'true',
    'APP_URL' => 'https://edumarket.vercel.app',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => '/tmp/edumarket.sqlite',
    'SESSION_DRIVER' => 'cookie',
    'SESSION_SECURE_COOKIE' => 'true',
    'CACHE_STORE' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'LOG_CHANNEL' => 'stderr',
    'LOG_LEVEL' => 'error',
    'APP_MAINTENANCE_DRIVER' => 'file',
    'BROADCAST_CONNECTION' => 'log',
    'FILESYSTEM_DISK' => 'local',
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
];
foreach ($env as $key => $value) {
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
