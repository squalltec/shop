<?php
$servername = "localhost";
$username = "root";
$password = "asela123";
$databse = "laolmart";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $databse);
$conn -> set_charset("utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$resentID="";

date_default_timezone_set('Asia/Colombo');
?>