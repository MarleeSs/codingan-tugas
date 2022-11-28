<?php

namespace Example\Config;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO('mysql:host=localhost;dbname=example', 'root', 'marleess771');
        }
        return self::$pdo;
    }
}