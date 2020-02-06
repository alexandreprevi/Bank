<?php

class Transaction
{
    // Db
    private $conn;
    private $table = 'transactions';
    private $view = 'vw_users';

    // User properties
    public $id;
    public $transaction_id;
    public $from_amout;
    public $from_account;
    public $from_currency;
    public $to_amount;
    public $to_account;
    public $to_currency;
    public $currency_rate;
    public $date;
    public $balance;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all Transaction
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

    // Get one transaction
    public function readSingle()
    {
        // Create query
        $query = 'SELECT * FROM '.$this->table.' t WHERE t.transaction_id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID param
        $stmt->bindParam(1, $this->transaction_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
         $this->from_amount = $row['from_amount'];
         $this->from_account = $row['from_account'];
         $this->from_currency = $row['from_currency'];
         $this->to_amount = $row['to_amount'];
         $this->to_account = $row['to_account'];
         $this->to_currency = $row['to_currency'];
         $this->currency_rate = $row['currency_rate'];
         $this->date = $row['date'];
    }

    // Get all transactions to one user
    public function readAllToUserTransaction()
    {
        // Create query
        $query = 'SELECT * FROM '.$this->table.' t WHERE t.to_account = ?';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID param
        $stmt->bindParam(1, $this->to_account);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get all transactions from one user
    public function readAllFromUserTransaction()
    {
        // Create query
        $query = 'SELECT * FROM '.$this->table.' t WHERE t.from_account = ? ORDER BY t.date DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID param
        $stmt->bindParam(1, $this->from_account);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get balance of one account
    public function getBalance($account_id)
    {
        // Create query
        $query = 'SELECT balance FROM '.$this->view.' v WHERE v.id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID param
        $stmt->bindParam(1, $account_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set property
        return $this->balance = $row['balance'];
    }

    // Create Transaction
    public function create($amountFromBalance, $amountSended)
    {
        // CONTROL INPUTS
        // $this->controlInputsForm();

        // CONTROL BALANCE
        $this->moneyTransferBalanceControl($amountFromBalance, $amountSended);

        // Create query
        $query = 'INSERT INTO ' . $this->table . ' 
        (from_amount, from_account, from_currency,
        to_amount, to_account, to_currency, currency_rate)
        VALUES
        (:from_amount, :from_account, :from_currency,
        :to_amount, :to_account, :to_currency, :currency_rate)';
    

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->from_amount = htmlspecialchars(strip_tags($this->from_amount));
        $this->from_account = htmlspecialchars(strip_tags($this->from_account));
        $this->from_currency = htmlspecialchars(strip_tags($this->from_currency));
        $this->to_amount = htmlspecialchars(strip_tags($this->to_amount));
        $this->to_account = htmlspecialchars(strip_tags($this->to_account));
        $this->to_currency = htmlspecialchars(strip_tags($this->to_currency));
        $this->currency_rate = htmlspecialchars(strip_tags($this->currency_rate));
        $this->date = htmlspecialchars(strip_tags($this->date));

        // Bind data
        $stmt->bindParam(':from_amount', $this->from_amount);
        $stmt->bindParam(':from_account', $this->from_account);
        $stmt->bindParam(':from_currency', $this->from_currency);
        $stmt->bindParam(':to_amount', $this->to_amount);
        $stmt->bindParam(':to_account', $this->to_account);
        $stmt->bindParam(':to_currency', $this->to_currency);
        $stmt->bindParam(':currency_rate', $this->currency_rate);
//        $stmt->bindParam(':date', $this->date);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function moneyTransferBalanceControl($userFromBalanceAmount, $amountSended)
    {
        if ($userFromBalanceAmount < $amountSended) {
            throw new Exception("You do not have enough money on your account");
        }
        return true;
    }

    public function displayResult()
    {
        
    }

    public function controlInputs()
    {
        // Check that user exists
        // Check that all fields are field in form
    }
}
