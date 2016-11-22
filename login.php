<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " + mysqli_connect_error());
		}

		$user = $_POST['username'];
		$pass = $_POST['password'];
		$role = "admin";

		$sql = "SELECT id FROM user WHERE username = '$user' AND password = '$pass' AND role = '$role'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		if($count == 1) {
			$_SESSION['login_user'] = $user;
			header("location: daftar.php");
		} else {
			echo 
				'<script>
				    alert("Username or Password is invalid");
				</script>';		
		}
	}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Personal Library</title>
		<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="obscure-background">
			<h1 class="text-center">My Personal Library</h1>
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
							<form action="login.php" method="post">
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