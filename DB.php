<?php
$serverName = "localhost:3306";
$userName = "root";
$password = "";
$db = "dee";
$conn = new mysqli($serverName, $userName, $password, $db);
if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}
