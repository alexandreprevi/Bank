<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.class.php';
include_once '../../../models/GetUsersInfoForHTMLTable.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate usersInfo Object
$usersInfo = new GetUsersInfoForHTMLTable($db);

// User query
$result = $usersInfo->read();

// Get row count
$num = $result->rowCount();

// Check if users
if ($num > 0) {
    // Users array
    $usersInfo_arr = array();
    $usersInfo_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_item = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'mobilephone' => $mobilephone,
            'account_id' => $account_id
        );

        // Push to "data"
        array_push($usersInfo_arr['data'], $user_item);
    }
    // Turn to json and output
    echo json_encode($usersInfo_arr);
} else {
    // No user
    echo json_encode(array('message' => 'No user found'));
}
