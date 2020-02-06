<?php

class ControlBalanceAccount
{
    // Db
    private $conn;
    private $view = 'vw_users';

    // properties
    public $id;
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    public $mobilephone;
    public $account_id;
    public $balance;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get balance for all accounts
    public function read()
    {
        // Create query
        $query = 'SELECT * FROM '.$this->view;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // Get balance for one account
    public function readSingle()
    {
        // Create query
        $query = 'SELECT * FROM '.$this->view.' v WHERE v.id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID param
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
         $this->id = $row['id'];
         $this->firstName = $row['firstName'];
         $this->lastName = $row['lastName'];
         $this->username = $row['username'];
         $this->password = $row['password'];
         $this->mobilephone = $row['mobilephone'];
         $this->account_id = $row['account_id'];
         $this->balance = $row['balance'];
    }
}
