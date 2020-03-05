<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../models/config/Database.class.php';
include_once '../../../models/Transaction.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate Transaction Object
$transaction = new Transaction($db);

// Get ID from URL
$transaction->transaction_id = isset($_GET['id']) ? $_GET['id'] : die();

// Get User
$transaction->readSingle();

// Create array
$transaction_arr = array(
    'transaction_id' => $transaction->transaction_id,
    'from_amount' => $transaction->from_amount,
    'from_currency' => $transaction->from_currency,
    'to_amount' => $transaction->to_amount,
    'to_currency' => $transaction->to_currency,
    'currency_rate' => $transaction->currency_rate,
    'date' => $transaction->date
);

// Make Json
print_r(json_encode($transaction_arr));
