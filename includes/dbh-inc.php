<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "asset_and_maintenance_management_system";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
$Con = $conn;

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}