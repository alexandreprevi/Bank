<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../../config/Database.class.php';
include_once '../../../models/Transaction.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate Transaction Object
$transaction = new Transaction($db);

// Get transaction data
$data = json_decode(file_get_contents('php://input'));

$transaction->from_account_balance = $data->from_account_balance;
$transaction->from_amount = $data->from_amount;
$transaction->from_account = $data->from_account;
$transaction->from_currency = $data->from_currency;
$transaction->to_amount = $data->to_amount;
$transaction->to_account = $data->to_account;
$transaction->to_currency = $data->to_currency;
$transaction->currency_rate = $data->currency_rate;

// Control if monay is available for transfer
try {
    // Create transaction
    if ($transaction->create($transaction->getBalance($transaction->from_account), $transaction->from_amount)) {
        echo json_encode(array('message' => 'Transaction created'));
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}
