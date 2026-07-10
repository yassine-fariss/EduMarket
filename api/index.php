<?php
// On Vercel's read-only filesystem, copy the seed DB to writable /tmp/
$seedDb = __DIR__ . '/../database/seed.sqlite';
$runtimeDb = getenv('DB_DATABASE') ?: '/tmp/edumarket.sqlite';

if (file_exists($seedDb) && !file_exists($runtimeDb)) {
    @copy($seedDb, $runtimeDb);
}

// Set environment for Laravel
$_ENV['DB_DATABASE'] = $runtimeDb;
putenv("DB_DATABASE=$runtimeDb");

require __DIR__.'/../public/index.php';
