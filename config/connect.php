<?php
$databaseServer = "sql12.freesqldatabase.com";
$databaseUsername = "sql12310568";
$databasePassword = "wmiLAF7a6g";
$databaseName = "sql12310568";
		
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
		
// Check connection
if (!$conn) {
	die("Connection failed: " + mysqli_connect_error());
}
return $conn;
?> 