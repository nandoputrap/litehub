<?php
	session_start();
	function connectDB() {
		$servername = "sql12.freesqldatabase.com";
		$username = "sql12313869";
		$password = "qy1jlUjdiy";
		$dbname = "sql12313869";
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " + mysqli_connect_error());
		}
		return $conn;
	}
	
	if(!isset($_SESSION["titlebookadded"])) {
		header("Location: daftar.php");
	}
	
	function daftarBuku($table) {
		$conn = connectDB();
		
		$sql = "SELECT * FROM $table";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EBOOKHUB.ID</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	<body>
		<div class="jumbotron">
			<h1 style="font-size: 6em;">EBOOKHUB.ID</h1>
			<div class="welcome-text">
			<h2>Selamat Datang <b>
				<?php
				if (isset($_SESSION["namauser"])){
					echo $_SESSION["namauser"];
				}
				?></b>
			</h2>
			</div>
		</div>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					 <a class="navbar-brand" href="#">My Personal Library</a>
				</div>
				<ul class="nav navbar-nav">
					<?php
					if(isset($_SESSION['namauser']) && $_SESSION['role'] === 'user') {
						echo '
						<li><a href="home.php">Home</a></li>
						';
					}
					?>
					<li class="active"><a href="daftar.php">Detail Buku</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
						if (isset($_SESSION["namauser"])){
							echo "<li><a href='services/logout.php'><span class='glyphicon glyphicon-log-out'></span>Logout</a></li>";
						}
					?>
				</ul>
			</div>
		</nav>
		<div class="container">
			<div class="row">
			<?php
			$daftarbuku = daftarBuku("book");
			while ($baris = mysqli_fetch_row($daftarbuku)) {
            	if($baris[2] == $_SESSION["titlebookadded"]) {
            		echo '<div class="col-md-4"><img class="list-group-image" style="width:300px; height:300px;" src="'.$baris[1].'" /></div>
            		<div class="col-md-8">
            			<h1>'.$baris[2].'</h1>
            			<p>Penulis : '.$baris[3].'</p>
            			<p>Penerbit : '.$baris[4].'</p>
            			<p>Deskripsi : 
            			'.$baris[5].'</p>
            			<p>Jumlah buku : '.$baris[6].'</p>
            		';	 
            		break;
            	}
            }
			?>
				<a href="daftar.php"><button type="button" class="btn btn-lg btn-default">Kembali ke halaman daftar buku</button></a>
				</div>
			</div>
		</div>
		<script src="js/jquery-3.1.0.min.js"> </script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/home.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
	</body>
	<footer>
		<hr>
		<h4>&copy; 2019 Litehub Inc. All rights reserved</h4>
	</footer>
</html>