<?php

// Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.class.php';
include_once '../../../models/ReadUsers.class.php';

// Instantiate Db and connect
$database = new Database();
$db = $database->connect();

// Instantiate readUsers Object
$readUsers = new ReadUsers($db);

// Get ID from URL
$readUsers->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get User
$readUsers->readSingle();

// Create array
$user_arr = array(
    'id' => $readUsers->id,
    'firstName' => $readUsers->first_name,
    'lastName' => $readUsers->last_name,
    'username' => $readUsers->user_name,
    'password' => $readUsers->password,
    'mobilephone' => $readUsers->mobilephone
);

// Make Json
print_r(json_encode($user_arr));
