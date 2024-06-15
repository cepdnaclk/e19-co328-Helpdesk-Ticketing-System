<?php

$sname = "localhost";
$db_name = "techub";

// Fetch credentials from environment variables
$uname = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed!" . mysqli_connect_error();
}

?>
