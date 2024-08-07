<?php
class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        // Connection chain to DDBB
        $dsn = 'pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
