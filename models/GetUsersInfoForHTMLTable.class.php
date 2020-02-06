<?php

class GetUsersInfoForHTMLTable
{
    // Db
    private $conn;
    private $table1 = 'users';
    private $table2 = 'account';

    // Properties
    public $id;
    public $first_name;
    public $last_name;
    public $account_id;
    public $mobilephone;
    
    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get users name, account number and mobilephone
    public function read()
    {
        // Create query
        $query = 'SELECT a.id as account_id,
                u.id,
                u.firstName,
                u.lastName,
                u.mobilephone
                FROM
                ' . $this->table1 . ' u
                LEFT JOIN
                ' . $this->table2 . ' a
                ON u.id = a.id';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID param
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
