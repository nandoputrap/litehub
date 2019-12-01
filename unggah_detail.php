<?php
	session_start();
	function connectDB() {
		// require 'config/connect.php';
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
	
	if (isset($_GET['id'])) {
		$no = $_GET['id'];
	  } 
	  else {
		header('Location:unggah.php');
	  }
	
?>

<!-- start fungsinya -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EBOOKHUB.ID</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<style>
			.detailPage{
				margin-left: 50px;
				margin-right: 50px;
			}
			.detailLabel{
                font-style: normal;
                font-weight: bold;
                color: #0A5494;
                font-size: 30px;
				margin-bottom: 30px;
            }
			.detail-pengajuan{
				font-size: 16px;
			}
			.field-pengajuan{
                font-weight: bold;
                vertical-align: text-top;
                width: 160px; 
        	}
            .isi-pengajuan{
                text-align:justify;
            }
		</style>
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
					<a class="navbar-brand" href="#">Ebookhub.ID</a>
				</div>
				<ul class="nav navbar-nav">
					<?php
					if(isset($_SESSION['namauser']) && $_SESSION['role'] === 'user') {
						echo '
						<li><a href="home.php">Home</a></li>
						';
					}
					?>
					<li><a href="daftar.php">Daftar Buku</a></li>
					<li class="active"><a href="unggah.php">Unggah Buku</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
						if (isset($_SESSION["namauser"])){
							echo "<li><a href='services/logout.php'><span class='glyphicon glyphicon-log-out'></span>Logout</a></li>";
						}else if(!isset($_SESSION['namauser'])) {
							echo '
								<form class="form-inline navbar-form navbar-left" action="index.php" method="post">
									<div class="form-group">
										<label style="color:white;" for="username">Username</label>
										<input type="text" class="form-control" id="insert-username" name="username" placeholder="Username" required>
									</div>
									<div class="form-group">
										<label style="color:white;" for="password">Password</label>
										<input type="password" class="form-control" id="insert-password" name="password" placeholder="Password" required>
									</div>
									<input type="hidden" id="insert-command" name="command" value="insert">
									<button type="submit" class="btn btn-default">Login</button>
								</form>
							';
						}
					?>
				</ul>
			</div>
		</nav>
		<?php
			$conn = connectDB();
			$query = "SELECT * FROM unggah where no = '$no'";
			$detail_unggah = mysqli_query($conn, $query);

			if (mysqli_num_rows($detail_unggah) > 0) {
				$row = mysqli_fetch_assoc($detail_unggah);
				$olddate = $row['upload_date'];
					$bulan = array (1 =>   	'Januari',
											'Februari',
											'Maret',
											'April',
											'Mei',
											'Juni',
											'Juli',
											'Agustus',
											'September',
											'Oktober',
											'November',
											'Desember'
									);
				$split = explode('-', $olddate);
				$tanggal = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
				echo'
					<div class="detailPage">
						<h4 class="detailLabel">Deskripsi Pengajuan</h4>
						<table class="detail-pengajuan">
								<tbody>
									<tr>
										<td class="field-pengajuan">Judul Buku</td>
										<td class="isi-pengajuan" id="judulBuku">'.$row['title'].'</td>
									</tr>
									<tr>
										<td class="field-pengajuan">Nama Penulis</td>
										<td class="isi-pengajuan" id="namaPenulis">'.$row['author'].'</td>
									</tr>
									<tr>
										<td class="field-pengajuan">Kategori</td>
										<td class="isi-pengajuan" id="kategori">'.$row['category'].'</td>
									</tr>
									<tr>
										<td class="field-pengajuan">Deskripsi</td>
										<td class="isi-pengajuan" id="deskripsiBuku">'.$row['description'].'</td>
									</tr>
									<tr>
										<td class="field-pengajuan">Tanggal unggah</td>
										<td class="isi-pengajuan" id="tanggalUpload">'.$tanggal.'</td>
									</tr>
									<tr>
										<td class="field-pengajuan">Status pengajuan</td>
										<td class="isi-pengajuan" style="font-weight: bold" id="status">'.$row['status'].'</td>
									</tr>
								</tbody>
						</table>
					</div>';
			}
		?>		
        </div>
		<script src="js/jquery-3.1.0.min.js"> </script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
	<footer>
		<hr>
		<h4>&copy; 2019 Litehub Inc. All rights reserved</h4>
	</footer>
</html>							