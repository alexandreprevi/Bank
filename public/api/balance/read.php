<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../models/config/Database.class.php';
include_once '../../../models/ControlBalanceAccount.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate balance Object
$balance = new ControlBalanceAccount($db);

// User query
$result = $balance->read();

// Get row count
$num = $result->rowCount();

// Check if balances
if ($num > 0) {
    // balances array
    $balances_arr = array();
    $balances_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $balance_item = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'username' => $username,
            'password' => $password,
            'mobilephone' => $mobilephone,
            'account_id' => $account_id,
            'balance' => $balance
        );

        // Push to "data"
        array_push($balances_arr['data'], $balance_item);
    }
    // Turn to json and output
    echo json_encode($balances_arr);
} else {
    // No balance
    echo json_encode(array('message' => 'No balance found'));
}
