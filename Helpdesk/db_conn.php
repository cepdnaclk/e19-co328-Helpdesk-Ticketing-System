<?php

require __DIR__ . '/vendor/autoload.php'; // Include Composer's autoloader

use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$sname = "localhost";
$db_name = "techub";

// Fetch credentials from environment variables
$uname = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed!" . mysqli_connect_error();
}

?>
