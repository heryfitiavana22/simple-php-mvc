<?php

namespace Framework;

class DbConnection {
    public static function get() {
        $driver = $_ENV['DB_DRIVER'];
        $database = $_ENV['DB_DATABASE'];

        if($driver == "sqlite") {
            $database = __DIR__ . '/../database/' . $database;
            if (!file_exists($database)) {
                file_put_contents($database, '');
            }
        }

        return [
            'driver'    => $driver,
            'host'      => $_ENV['DB_HOST'],
            'database' => $database,
            'username'  => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'charset'   => $_ENV['DB_CHARSET'],
            'collation' => $_ENV['DB_COLLATION'],
            'prefix'    => $_ENV['DB_PREFIX'],
        ];
    }
}