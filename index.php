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
			
			$_SESSION["user_id"] = $row["user_id"];
			$_SESSION["namauser"] = $row["username"];
			$_SESSION["role"] = $row["role"];
			header("Location: daftar.php");

		}else {
			echo  "<script type='text/javascript'>alert('Login Gagal');</script>";
		}
		
	}
	
	mysqli_close($databaseConnection);
	
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Personal Library</title>
		<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="css/index.css">
	</head>
	<body>
		<div class="obscure-background">
			<h1 id="loginTitle" class="text-center">My Personal Library</h1>
			<div class="span7 text-center">
				<button type="button" class="btn-lg btn-primary" data-toggle="modal" data-target="#insertModal">
					Masuk
				</button>
			</div>
			<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="insertModalLabel">Login Page</h4>
						</div>
						<div class="modal-body">
							<form action="index.php" method="post">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="insert-username" name="username" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="insert-password" name="password" placeholder="Password">
								</div>
								<input type="hidden" id="insert-command" name="command" value="insert">
								<button type="submit" class="btn btn-primary">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
			<script type="text/javascript" src="bootstrap/dist/js/bootstrap.min.js"></script>
		</div>
	</body>
</html>