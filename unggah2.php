<?php
  require_once("templates/header.php");
  session_start();
?>

<?php
	// session_start();
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

<div class="container">
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
								if($row['status'] == "Dalam Proses Penyuntingan") {
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

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="js/Chart.min.js"></script>

<?php
  require_once("templates/footer.php");
?>