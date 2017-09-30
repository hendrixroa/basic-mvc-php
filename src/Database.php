<?php
 
namespace YourNamespaceApp\Database;
 
/**
 * Represent the Connection
 */
class Connection {
 
    /**
     * Connection
     * @var type 
     */
    private static $conn;
 
    /**
     * Connect to the database and return an instance of pg object
     * @return pg
     * @throws \Exception
     */
    public function connect() {
 
        // read parameters in the ini configuration file
        var_dump(__DIR__);
        //$params = parse_ini_file( __DIR__ . '/../config/database.ini');
        if ($params === false) {
            throw new \Exception("Error reading database configuration file");
        }
        // connect to the postgresql database
        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);
 
        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 
        return $pdo;
    }
 
    /**
     * return an instance of the Connection object
     * @return type
     */
    public static function get() {
        if (null === static::$conn) {
            static::$conn = new static();
        }
 
        return static::$conn;
    }

    public function closeConnection(){
        static::$conn = null;
    }
 
    public function __construct() {
    }
 
    private function __clone() {
        
    }
 
    private function __wakeup() {
        
    }
 
}
