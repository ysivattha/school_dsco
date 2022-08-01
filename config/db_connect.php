<?php 

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "school_dso_db";
	
// creating the connection
$connect = new mysqli($servername, $username, $password, $dbname);

// checking the connection
if(!$connect->connect_error) {
	session_start();
	ob_start();
	date_default_timezone_set("Asia/Bangkok");
	
}
else {
	die("Connection Failed : " . $connect->connect_error);
}
?>