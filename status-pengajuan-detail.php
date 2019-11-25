<?php
  require_once("templates/header.php");
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

	if (isset($_GET['id'])) {
		$no = $_GET['id'];
	  }
	  else {
		header('Location:unggah.php');
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
              <h3 class="panel-title">
              <?php
                if (isset($_SESSION["namauser"])){
                  echo$_SESSION["namauser"];
                }
              ?>
              </h3>
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
        
        <div class="col-md-9">
          <h1 class="register-title">Status Pengajuan</h1>

          <div class="table-details">
            <table class="table detail-pengajuan table-hover table-bordered table-responsive">
              <tbody>
                <tr>
                  <td><strong>Judul Buku</strong></td>
                  <td id="judulBuku">'.$row['title'].'</td>
                </tr>
                <tr>
                  <td><strong>Nama Penulis</strong></td>
                  <td id="namaPenulis">'.$row['author'].'</td>
                </tr>
                <tr>
                  <td><strong>Kategori</strong></td>
                  <td id="kategori">'.$row['category'].'</td>
                </tr>
                <tr>
                  <td><strong>Deskripsi/Sinopsis Buku</strong></td>
                  <td id="deskripsiBuku">'.$row['description'].'</td>
                </tr>
                <tr>
                  <td><strong>Tanggal Unggah</strong></td>
                  <td id="tanggalUpload">'.$tanggal.'</td>
                </tr>
                <tr>
                  <td><strong>Status Pengajuan</strong></td>
                  <td id="status"><h4 class="status">'.$row['status'].'</h4></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>';
			}
		  ?>


    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
