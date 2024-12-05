<?php
class Database {
    private static $instance = null;
    private $connection;
    
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "booking";

    private function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        try {
            $this->connection = new mysqli(
                $this->hostname, 
                $this->username, 
                $this->password, 
                $this->dbname,
                3307
            );
            $this->connection->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    // Prevent cloning of the instance
    private function __clone() {}

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function __destruct() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
?>
