<?php
require_once("templates/header.php");
?>

<?php
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
                        echo$_SESSION["nama_lengkap"];
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
                <li>
                  <a href="status-pengajuan.php">Status Pengajuan</a>
                </li>
                <li class="active-profil">
                  <a href="buku-saya.php">Buku Saya</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <h1 class="register-title">Buku Saya</h1>

        <h2>Daftar Pembelian Buku Saya</h2>

        <div class="table-details">
          <table class="table table-hover table-bordered table-responsive">
            <thead>
              <tr>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Tanggal Beli</th>
                <th colspan="3" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">How to Code 101</td>
                <td class="text-center">Komputer</td>
                <td class="text-center">1 Januari 2019</td>
                <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='buku-saya-detail.php'"> <i class="fa fa-info"></i>&nbsp; Detail </button></td>
                <td class="text-center"><button type="button" class="btn btn-warning"> <i class="fa fa-book"></i>&nbsp;Baca</button></td>
                <td class="text-center"><button type="button" class="btn btn-success"> <i class="fa fa-download"></i>&nbsp;Download</button></td>
              </tr>

            </tbody>
          </table>
        </div>


        <!-- Jika belum beli buku, maka akan muncul tampilan ini
             Use JavaScript ehehe.. :))
       -->
        <div class="belum-punya-buku text-center">
          <h4>Maaf kamu belum punya buku yang dibeli :(</h4>
        </div>

      </div>


    </div>


  </div>
</div>

<?php
require_once("templates/footer.php");
?>
