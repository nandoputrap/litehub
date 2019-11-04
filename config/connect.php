<?php
$servername = "sql12.freesqldatabase.com";
$username = "sql12310568";
$password = "wmiLAF7a6g";
$dbname = "sql12310568";
		
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
		
// Check connection
if (!$conn) {
	die("Connection failed: " + mysqli_connect_error());
}
return $conn;
?> 