<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
$servername = "localhost";
//$username = "nucleusvision";
//$password = "nucleus@vision";
$username = "root";
$password = "";
$dbname = "nucleusvision";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
}
catch(PDOException $e)
{
	die("Connection failed: " . $e->getMessage());
}

?>