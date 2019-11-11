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
	
	function daftarBuku($table) {
		$conn = connectDB();
		
		$sql = "SELECT no, title, author, category, description, file, upload_date, status FROM $table";
		
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
		<div class="container">
            <?php
                if (isset($_SESSION["namauser"]) && $_SESSION["role"] === "admin"){
                    echo "<br><button type='button' class='btn-addbook btn btn-primary' data-toggle='modal' data-target='#insertModal'>
                        Unggah Buku
                    </button>";
                }
            ?>
            <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title black-modal" id="insertModalLabel">Unggah Buku</h4>
                        </div>
                        <div class="modal-body">
                            <form action="services/upload.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
                                    <label for="judulBuku">Judul Buku</label>
                                    <input type="text" class="form-control" id="insert-judulBuku" name="judulBuku" placeholder="Masukkan Judul Buku" required>
                                </div>
								<div class="form-group">
                                    <label for="namaPenulis">Nama Penulis</label>
                                    <input type="text" class="form-control" id="insert-namaPenulis" name="namaPenulis" placeholder="Masukkan Nama Penulis">
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
									<select class="form-control" id="insert-kategori" name="kategori" placeholder="Pilih Kategori">
										<option>Umum</option>
										<option>Filsafat</option>
										<option>Psikologi</option>
										<option>Agama</option>
										<option>Sejarah</option>
										<option>Sosial</option>
										<option>Bahasa</option>
										<option>Sains</option>
										<option>Geografi</option>
										<option>Teknologi</option>
										<option>Seni</option>
										<option>Literatur</option>
										<option>Sastra</option>
										<option>Biografi</option>
										<option>Matematika</option>
										<option>Novel</option>
										<option>Cerpen</option>
										<option>Puisi</option>
										<option>Drama</option>
										<option>Komik</option>
										<option>Dongeng</option>
										<option>Fabel</option>
										<option>Mitos</option>
									</select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsiBuku">Deskripsi Buku</label>
                                    <textarea class="form-control" id="insert-deskripsiBuku" name="deskripsiBuku" placeholder="Deskripsi Buku" rows="3"></textarea>
                                </div>
                                <div class="form-group">
									<input type="file" name="fileToUpload" id="fileToUpload">
									<!-- <button class="btn btn-secondary" method="post" action="upload.php" enctype="multipart/form-data">Upload Buku</button> -->
                					<h6>Format buku dalam bentuk .doc atau .docx. Format penulisan dan layout dapat dilihat pada halaman <a href="#">ini</a>. Ukuran file maksimal 50 MB.</h6>
                                </div>
                                <input type="hidden" id="insert-command" name="command" value="insert">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<div class="uploadpage">
				<form action="#" method="post">
					<label class="labelunggah">Menunggu Proses Pengajuan</label>
					<table class="table info-upload">
						<thead>
							<tr>
								<th>Judul Buku</th>
								<th>Kategori</th>
								<th>Tanggal Unggah</th>
								<th>Status</th>
								<th>Detail</th>
							</tr>
						</thead>
						<?php
							$daftarbuku = daftarBuku("unggah");
							if (mysqli_num_rows($daftarbuku) > 0) {
								while ($row = mysqli_fetch_assoc($daftarbuku)) {
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
									 if($row['status'] = "Dalam Proses Penyuntingan") {
										echo'
										<tbody>
										<tr>
											<td>'.$row['title'].'</td>
											<td>'.$row['category'].'</td>
											<td>'.$tanggal.'</td>
											<td>'.$row['status'].'</td>
											<td><a href="unggah_detail.php?id='.$row['no'].'">Detail</a></td>
										</tr>
										</tbody>';
									 }
								}
							}
							
						?>
					</table>
					<label class="labelunggah">Sudah Diterima</label>
					<table class="table info-upload">
						<thead>
							<tr>
								<th>Judul Buku</th>
								<th>Kategori</th>
								<th>Tanggal Unggah</th>
								<th>Status</th>
								<th>Detail</th>
							</tr>
						</thead>
						<?php
							$daftarbuku = daftarBuku("unggah");
							if (mysqli_num_rows($daftarbuku) > 0) {
								while ($row = mysqli_fetch_assoc($daftarbuku)) {
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
									 if($row['status'] == "Sudah Diterima") {
										echo'
										<tbody>
										<tr>
											<td>'.$row['title'].'</td>
											<td>'.$row['category'].'</td>
											<td>'.$tanggal.'</td>
											<td>'.$row['status'].'</td>
											<td><a href="unggah_detail.php?id='.$row['no'].'">Detail</a></td>
										</tr>
										</tbody>';
									 }
								}
							}
						?>
					</table>
				</form>
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