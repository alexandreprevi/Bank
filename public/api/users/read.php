<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../models/config/Database.class.php';
include_once '../../../models/ReadUsers.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate readUsers Object
$readUsers = new ReadUsers($db);

// User query
$result = $readUsers->read();

// Get row count
$num = $result->rowCount();

// Check if users
if ($num > 0) {
    // Users array
    $users_arr = array();
    $users_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_item = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'username' => $username,
            'password' => $password,
            'mobilephone' => $mobilephone
        );

        // Push to "data"
        array_push($users_arr['data'], $user_item);
    }
    // Turn to json and output
    echo json_encode($users_arr);
} else {
    // No user
    echo json_encode(array('message' => 'No user found'));
}
