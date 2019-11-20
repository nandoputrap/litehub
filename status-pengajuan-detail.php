<?php
  require_once("templates/header.php");
?>

<div class="status-pengajuan-detail section-margin">
  <div class="container">

    <div class="row">
      <div class="col-md-3">
        <?php require_once("profil.php"); ?>
      </div>

      <div class="col-md-9">
        <h1 class="register-title">Status Pengajuan</h1>

        <div class="table-details">
          <table class="table table-hover table-bordered table-responsive">
            <tbody>
              <tr>
                <td><strong>Judul Buku</strong></td>
                <td>How to Code 101</td>
              </tr>
              <tr>
                <td><strong>Nama Penulis</strong></td>
                <td>Nando P. Pratama</td>
              </tr>
              <tr>
                <td><strong>Kategori</strong></td>
                <td>Teknologi</td>
              </tr>
              <tr>
                <td><strong>Deskripsi/Sinopsis Buku</strong></td>
                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
              </tr>
              <tr>
                <td><strong>Tanggal Unggah</strong></td>
                <td>1 Januari 2019</td>
              </tr>
              <tr>
                <td><strong>Status Pengajuan</strong></td>
                <td> <h4 class="status">Dalam proses penyuntingan</h4></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>


    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
