<?php

include_once '../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../../../');
$dotenv->load();

 
class Database
{
     
    private $host;
    private $dbName;
    private $dbPort;
    private $username;
    private $password;
    private $conn;

    

    public function connect()
    {
         $this->host = getenv("DB_HOST");
         $this->dbName = getenv("DB_DATABASE");
         $this->dbPort = getenv("DB_PORT");
         $this->username = getenv("DB_USER");
         $this->password = getenv("DB_PASS");
 
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
