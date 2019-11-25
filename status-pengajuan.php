<?php
require_once("templates/header.php");
session_start();
?>

<?php
	// session_start();
	function connectDB() {
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

<div class="status-pengajuan-detail section-margin">
  <div class="container">

    <div class="row">
      <div class="col-md-3">
        <div class="item">
          <div class="card  text-center card-product-details">
            <img class='card-img-top img-circle img-fluid' src='images/avatar.png' alt='card-img'>
            <!-- <h2>Nando Putra Pratama</h2> -->
          </div>
        </div>

        <div class="panel panel-default sidebar-menu">
          <div class="panel-harga">
            <div class="panel-heading text-center">
              <h3 class="panel-title">Nando Putra Pratama</h3>
            </div>

            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked category-menu">
                <li>
                  <a href="lihat-profil.php">Profil</a>
                </li>
                <li>
                  <a href="edit-password.php">Edit Password</a>
                </li>
                <li class="active-profil">
                  <a href="status-pengajuan.php">Status Pengajuan</a>
                </li>
                <li>
                  <a href="buku-saya.php">Buku Saya</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <h1 class="register-title">Status Pengajuan</h1>

        <h2>Menunggu Proses Pengajuan</h2>

        <div class="table-details">
          <table class="table table-hover table-bordered table-responsive">
            <thead>
              <tr>
                <th class="text-center tabel-header">Judul Buku</th>
                <th class="text-center tabel-header">Kategori</th>
                <th class="text-center tabel-header">Tanggal Unggah</th>
                <th class="text-center tabel-header">Status</th>
                <th class="text-center tabel-header">Aksi</th>
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
  										<td class="text-center">'.$row['title'].'</td>
  										<td class="text-center">'.$row['category'].'</td>
  										<td class="text-center">'.$tanggal.'</td>
  										<td class="text-center">'.$row['status'].'</td>
  										<td class="text-center"><a class="btn btn-info" href="unggah_detail.php?id='.$row['no'].'">Detail</a></td>

  									</tr>
  									</tbody>';
  								}
  							}
  						}

  					?>
          </table>
        </div>

        <h2>Sudah Diterbitkan</h2>


        <div class="table-details">
          <table class="table table-hover table-bordered table-responsive">
            <thead>
              <tr>
                <th class="text-center tabel-header">Judul Buku</th>
                <th class="text-center tabel-header">Kategori</th>
                <th class="text-center tabel-header">Tanggal Terbit</th>
                <th class="text-center tabel-header">Status</th>
                <th class="text-center tabel-header">Jumlah Terjual</th>
                <th class="text-center tabel-header">Aksi</th>
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
  											<td class="text-center">'.$row['title'].'</td>
  											<td class="text-center">'.$row['category'].'</td>
  											<td class="text-center">'.$tanggal.'</td>
  											<td class="text-center">'.$row['status'].'</td>
  											<td class="text-center">'.$row['status'].'</td>
  											<td class="text-center"><a class="btn btn-info" href="unggah_detail.php?id='.$row['no'].'">Detail</a></td>
  										</tr>
  										</tbody>';
  								}
  							}
  						}
  					?>
          </table>
        </div>
      </div>


    </div>


  </div>
</div>

<?php
require_once("templates/footer.php");
?>
