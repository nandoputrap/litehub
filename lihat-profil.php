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
            <form class="" action="" method="post">
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
                <li class="active-profil">
                  <a href="lihat-profil.php">Profil</a>
                </li>
                <li>
                  <a href="edit-password.php">Edit Password</a>
                </li>
                <li>
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
        <h1 class="register-title">Profil</h1>

          <?php
            if (isset($_SESSION["namauser"])){
              echo '
              <div class="form-group">
                <label for="">Nama Lengkap:</label>
                <input type="text" class="form-control form-register" value="'.$_SESSION["nama_lengkap"].'" disabled>
              </div>
    
              <div class="form-group">
                <label for="">Nama Pengguna:</label>
                <input type="text" class="form-control form-register" value="'.$_SESSION["namauser"].'" disabled>
              </div>
    
              <div class="form-group">
                <label for="">E-mail:</label>
                <input type="email" class="form-control form-register" value="'.$_SESSION["email"].'" disabled>
              </div>
  
              ';
            }
          ?>

          <!-- <div class="form-group">
            <label for="">Nama Lengkap:</label>
            <input type="text" class="form-control form-register" value="Nando Putra Pratama" disabled>
          </div>

          <div class="form-group">
            <label for="">Nama Pengguna:</label>
            <input type="text" class="form-control form-register" value="nandoputrap" disabled>
          </div>

          <div class="form-group">
            <label for="">E-mail:</label>
            <input type="email" class="form-control form-register" value="nandoputrap@gmail.com" disabled>
          </div> -->








          <button type="button" class="btn btn-primary btn-block btn-ebookhub btn-register" onclick="window.location='edit-profil.php'">Edit Profil</button>
        </form>


      </div>


    </div>


  </div>
</div>

<?php
require_once("templates/footer.php");
?>
