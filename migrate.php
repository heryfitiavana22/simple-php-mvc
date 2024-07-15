<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

foreach (glob("database/migrations/*.php") as $filename) {
    require  __DIR__ . '/' . $filename;
}

echo "Migrations executed successfully.\n";
