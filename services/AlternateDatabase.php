<?php
class AlternateDatabase {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "booking";
    public $connection;

    public function __construct() {
        $this->connection = new mysqli(
            $this->servername, 
            $this->username, 
            $this->password, 
            $this->database
        );

        // Kiểm tra kết nối
        if ($this->connection->connect_error) {
            die("Kết nối thất bại: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
