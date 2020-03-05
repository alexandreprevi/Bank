<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../models/config/Database.class.php';
include_once '../../../models/Transaction.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate transaction Object
$transaction = new Transaction($db);

// Get ID from URL
$transaction->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get User balance
$transaction->getBalance($transaction->id);

$transaction_amount = $transaction->balance;

print_r($transaction_amount);
