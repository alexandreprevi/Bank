<?php

include_once './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

echo  getenv("DB_HOST");
echo  getenv("DB_DATABASE");
echo  getenv("DB_PORT");
echo  getenv("DB_USER");
echo  getenv("DB_PASS");
