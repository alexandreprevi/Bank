<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.class.php';
include_once '../../../models/Transaction.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate Transaction Object
$transaction = new Transaction($db);

// Get ID from URL
$transaction->to_account = isset($_GET['id']) ? $_GET['id'] : die();

// Get transactions
$result = $transaction->readAllToUserTransaction();

// Get row count
$num = $result->rowCount();

// Check if transactions
if ($num > 0) {
    // transactions array
    $transactions_arr = array();
    $transactions_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $transaction_item = array(
            'transaction_id' => $transaction_id,
            'from_amount' => $from_amount,
            'from_account' => $from_account,
            'from_currency' => $from_currency,
            'to_amount' => $to_amount,
            'to_account' => $to_account,
            'to_currency' => $to_currency,
            'currency_rate' => $currency_rate,
            'date' => $date
        );

        // Push to "data"
        array_push($transactions_arr['data'], $transaction_item);
    }
    // Turn to json and output
    echo json_encode($transactions_arr);
} else {
    // No Transaction
    echo json_encode(array('message' => 'No transaction found'));
}
