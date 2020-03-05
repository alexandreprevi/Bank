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

// Get ID from URL
$balance->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get User
$balance->readSingle();

// Create array
$balance_arr = array(
    'id' => $balance->id,
    'firstName' => $balance->firstName,
    'lastName' => $balance->lastName,
    'username' => $balance->username,
    'password' => $balance->password,
    'mobilephone' => $balance->mobilephone,
    'account_id' => $balance->account_id,
    'balance' => $balance->balance
);

// Make Json
print_r(json_encode($balance_arr));
