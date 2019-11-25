<?php
	session_start();
	function connectDB() {
		// require 'config/connect.php';
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
	}

	if(!isset($_SESSION["namauser"])) {
		header("Location: daftar.php");
	}
	
	function daftarBuku($table) {
		$conn = connectDB();
		
		$sql = "SELECT no, title, author, category, description, file, upload_date, status FROM $table";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

	function selectRowsFromSubmission() {
		$conn = connectDB();

		$sql = "SELECT * FROM submission WHERE user_id = ".$_SESSION["user_id"]."";
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['command'] === 'insert') {
			unggahBuku();
		}
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
		<style>
			.labelunggah{
                font-style: normal;
                font-weight: bold;
                color: #0A5494;
                font-size: 20px;
            }
			.field-pengajuan{
                font-weight: bold;
                vertical-align: text-top;
                width: 130px; 
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
					<li class="active"><a href="unduh.php">Unduh Buku</a></li>
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
		<div class="container">
			<div class="uploadpage">
				<form action="#" method="post">
					<label class="labelunggah">Daftar Pengajuan</label>
					<table class="table info-upload">
						<thead>
							<tr>
								<th>Judul Buku</th>
								<th>Penulis</th>
								<th>Tanggal Unggah</th>
								<th>Detail</th>
								<th>Download</th>
							</tr>
						</thead>
						<?php
							$daftarbuku = daftarBuku("unggah");
							if(isset($_SESSION['namauser'])) {
								$daftardiunggah = selectRowsFromSubmission();
							    $arraysubmission = array();
							    while ($baris = mysqli_fetch_row($daftardiunggah)) {
							    	array_push($arraysubmission, $baris[1]);
							    }
							}
							while ($row = mysqli_fetch_row($daftarbuku)) {
								 if($row[7] == "Dalam Proses Penyuntingan") {
									echo'
									<tbody>
									<tr>
										<td>'.$row[1].'</td>
										<td>'.$row[2].'</td>
										<td>'.$row[6].'</td>
										<td><a data-toggle="modal" data-target="#detailUpload" href="#detailUpload?id='.$row[1].'">Detail</a></td>
										<td><a href="services/download.php?nama='.$row[5].'">Download</a></td>
										<td><a href="services/publish.php?id='.$row[0].'"><button type="button" class="btn-addbook btn btn-primary">
										Ubah Status Buku
									</button></a></td>
									</tr>
									</tbody>';
								 }
							}
						?>
					</table>
					<label class="labelunggah">Daftar Publikasi</label>
					<table class="table info-upload">
						<thead>
							<tr>
								<th>Judul Buku</th>
								<th>Penulis</th>
								<th>Tanggal Unggah</th>
								<th>Detail</th>
								<th>Publikasi</th>
							</tr>
						</thead>
						<?php
							$daftarbuku = daftarBuku("unggah");
							if(isset($_SESSION['namauser'])) {
								$daftardiunggah = selectRowsFromSubmission();
							    $arraysubmission = array();
							    while ($baris = mysqli_fetch_row($daftardiunggah)) {
							    	array_push($arraysubmission, $baris[1]);
							    }
							}
							while ($row = mysqli_fetch_row($daftarbuku)) {
								 if($row[7] == "Sudah Diterima") {
									echo'
									<tbody>
									<tr>
										<td>'.$row[1].'</td>
										<td>'.$row[2].'</td>
										<td>'.$row[6].'</td>
										<td><a data-toggle="modal" data-target="#detailUpload">Detail</a></td>
										<td><button type="button" class="btn-addbook btn btn-primary" data-toggle="modal" data-target="#insertModal">
										Publikasi Buku
									</button></td>
									</tr>
									</tbody>';
								 }
							}	
						?>
					</table>
				</form>
			</div>
			<?php
				$daftarbuku = daftarBuku("unggah");
				if(isset($_SESSION['namauser'])) {
					$daftardiunggah = selectRowsFromSubmission();
				    $arraysubmission = array();
				    while ($baris = mysqli_fetch_row($daftardiunggah)) {
				    	array_push($arraysubmission, $baris[1]);
				    }
				}
				while ($row = mysqli_fetch_array($daftarbuku)) {
					echo'
					<div class="modal fade" id="detailUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title black-modal" id="detailModalLabel">Detail Buku</h4>
								</div>
								<div class="modal-body">
									<table class="detail-pengajuan">
										<tbody>
											<tr>
												<td class="field-pengajuan">Judul Buku</td>
												<td class="isi-pengajuan">'.$row[1].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Nama Penulis</td>
												<td class="isi-pengajuan">'.$row[2].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Kategori</td>
												<td class="isi-pengajuan">'.$row[3].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Deskripsi</td>
												<td class="isi-pengajuan">'.$row[4].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Tanggal unggah</td>
												<td class="isi-pengajuan">'.$row[6].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Status pengajuan</td>
												<td class="isi-pengajuan" style="font-weight: bold">'.$row[7].'</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>';
				}
			?>
			 <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title black-modal" id="insertModalLabel">Add Book</h4>
                        </div>
                        <div class="modal-body">
                            <form action="services/sell.php" method="post">
                                <div class="form-group">
                                    <label for="displayBuku">Display Buku</label>
                                    <input type="url" class="form-control" id="insert-displayBuku" name="displayBuku" placeholder="Link Buku">
                                </div>
                                <div class="form-group">
                                    <label for="judulBuku">Judul Buku</label>
                                    <input type="text" class="form-control" id="insert-judulBuku" name="judulBuku" placeholder="Judul Buku" required>
                                </div>
                                <div class="form-group">
                                    <label for="pengarangBuku">Pengarang Buku</label>
                                    <input type="text" class="form-control" id="insert-pengarangBuku" name="pengarangBuku" placeholder="Pengarang Buku">
                                </div>
                                <div class="form-group">
                                    <label for="penerbitBuku">Penerbit Buku</label>
                                    <input type="text" class="form-control" id="insert-penerbitBuku" name="penerbitBuku" placeholder="Penerbit Buku">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsiBuku">Deskripsi Buku</label>
                                    <input type="text" class="form-control" id="insert-deskripsiBuku" name="deskripsiBuku" placeholder="Deskripsi Buku">
                                </div>
                                <div class="form-group">
                                    <label for="stokBuku">Harga Buku</label>
                                    <input type="number" class="form-control" id="insert-stokBuku" name="stokBuku" placeholder="Stok Buku" required>
                                </div>
                                <input type="hidden" id="insert-command" name="command" value="insert">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<script src="js/jquery-3.1.0.min.js"> </script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>	
	</body>
	<footer>
		<hr>
		<h4>&copy; 2019 Litehub Inc. All rights reserved</h4>
	</footer>
</html>							