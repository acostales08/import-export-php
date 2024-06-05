<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "employeedb";
$connectionString = "mysql:host=$host; dbname=$db_name";

try {
    $conn = new PDO($connectionString, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Throwable $th) {
    echo "not connected";
}
