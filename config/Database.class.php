<?php

/* require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load(); */

class Database
{
    private $host = "localhost";
    private $dbName = "bank";
    private $dbPort = 10011;
    private $username = "root";
    private $password = "root";
    private $conn;

    public function connect()
    {
        /* $this->host = $_ENV["DB_HOST"];
        $this->dbName = $_ENV["DB_DATABASE"];
        $this->dbPort = $_ENV["DB_PORT"];
        $this->username = $_ENV["DB_USER"];
        $this->password = $_ENV["DB_PASS"]; */

        /* $this->host = getenv("DB_HOST");
        $this->dbName = getenv("DB_DATABASE");
        $this->dbPort = getenv("DB_PORT");
        $this->username = getenv("DB_USER");
        $this->password = getenv("DB_PASS"); */

        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host='.$this->host.';port='.$this->dbPort.';dbname='.$this->dbName, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed'.$e->getMessage();
        }
        return $this->conn;
    }
}
