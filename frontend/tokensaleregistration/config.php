<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
$servername = "localhost";
//$username = "nucleusvision";
//$password = "nucleus@vision";
$username = "root";
$password = "";
$dbname = "nucleusvision";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>