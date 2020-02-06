<?php

class ReadUsers
{
    // Db
    private $conn;
    private $table = 'users';

    // User properties
    public $id;
    public $first_name;
    public $last_name;
    public $user_name;
    public $password;
    public $mobilephone;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all Users
    public function read()
    {
        // Create query
        $query = 'SELECT * FROM '.$this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // Get one user
    public function readSingle()
    {
        // Create query
        $query = 'SELECT * FROM '.$this->table.' u WHERE u.id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID param
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row['id'];
        $this->first_name = $row['firstName'];
        $this->last_name = $row['lastName'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->mobilephone = $row['mobilephone'];
    }
}
