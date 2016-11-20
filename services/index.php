<?php
	
	$databaseServer = "localhost";
	$databaseUsername = "root";
	$databasePassword = "";
	$databaseName = "test";
	
	$databaseConnection = mysqli_connect($databaseServer, $databaseUsername, $databasePassword, $databaseName);
	
	if (!$databaseConnection){
		die ("Connection to database failed");
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// username and password sent from form 
		session_start();
		
		$username = $_POST['username'];
		$password = $_POST['password']; 
				
		$queryLogin = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
		$resultLogin = mysqli_query($databaseConnection,$queryLogin);
		
		$row = mysqli_fetch_array($resultLogin,MYSQLI_ASSOC);
		$active = $row['active'];
		  
		$count = mysqli_num_rows($resultLogin);
		// If result matched $myusername and $mypassword, table row must be 1 row
			
		if($count == 1) {
			
			$_SESSION["namauser"] = $row["username"];
			$_SESSION["role"] = $row["role"];
			header("Location: ../home.html");

		}else {
			echo  "<script type='text/javascript'>alert('Login Gagal');</script>";
			header("Location: ../index.html");
		}
		
	}
	
	mysqli_close($databaseConnection);
	
?>