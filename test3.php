<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $db = app('db')->connection();
    $db->getPdo();
    echo "PDO success!";
}
catch (\Exception $e) {
    echo "Exception Class: " . get_class($e) . "\n";
    echo "Message: " . $e->getMessage() . "\n";
}
