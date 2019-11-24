<?php
  require_once("templates/header.php");
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
                  <a href="edit-profil.php">Edit Profil</a>
                </li>
                <li>
                  <a href="status-pengajuan.php">Status Pengajuan</a>
                </li>
              </ul>
            </div>
          </div>
        </div>


        <div class="panel panel-default sidebar-menu">
          <div class="panel-harga">
            <div class="panel-heading text-center">
              <h3 class="panel-title">Editor Area</h3>
            </div>

            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked category-menu">
                <li class="active-profil">
                  <a href="daftar-pengajuan.php">Daftar Pengajuan</a>
                </li>
                <li>
                  <a href="status-pengajuan.php">Status Pengajuan</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <h1 class="register-title">Edit Status Pengajuan</h1>

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
                <td>

                    <select class="form-control" id="kategori" style="height: 100%;">
                      <option>Dalam Proses Penyuntingan</option>
                      <option>Sudah Diterbitkan</option>
                    </select>

                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <button type="button" class="btn btn-primary btn-block btn-ebookhub btn-register">Simpan</button>
      </div>


    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
