<?php

class Connect
{
    private static ?PDO $pdo = null;
    private static string $dsn = "mysql:host=%s;dbname=%s;charset=%s";

    /**
     * Connect once to the database with a single PDO object
     * Sprintf : For better readability
     * @return PDO|null
     */
     public static function dbConnect():?PDO {
        if (self::$pdo === null) {
            try {
                $dsn = sprintf(self::$dsn,Config::BD_SERVER,Config::BD_DB,Config::BD_CHARSET);
                self::$pdo = new PDO($dsn,Config::BD_USER,Config::BD_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                echo "ok";
            }
            catch (PDOException $e) {
                die();
            }
        }
        return self::$pdo;
    }
}