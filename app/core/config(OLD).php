<?php
namespace Public\app\core;

use PDO;
use PDOException;

class Config
{
    private static $pdo; 

    public static function getPDO(): PDO 
    {
        if (self::$pdo === null) { 
            $host = 'MySQL-8.0';
            $db = 'comp';
            $user = 'root';
            $pass = '';
            $charset = 'utf8';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$pdo = new PDO($dsn, $user, $pass, $opt);
                echo 'true'; 
            } catch (PDOException $e) {
                echo "ERROR: " . $e->getMessage();
                die(); 
            }
        }

        return self::$pdo;
    }
}