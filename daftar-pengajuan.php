<?php
require_once("templates/header.php");
?>

<div class="daftar-pengajuan section-margin">
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
        <h1 class="register-title">Status Pengajuan</h1>

        <h2>Menunggu Proses Pengajuan</h2>

        <div class="table-details">
          <table class="table table-hover table-bordered table-responsive">
            <thead>
              <tr>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Nama Penulis</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Tanggal Unggah</th>
                <th colspan="2" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">How to Code 101</td>
                <td class="text-center">Nando P. Pratama</td>
                <td class="text-center">Komputer</td>
                <td class="text-center">1 Januari 2019</td>
                <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='status-pengajuan-detail-editor.php'"> <i class="fa fa-info"></i> &nbsp;Detail</button></td>
                <td class="text-center"><button type="button" class="btn btn-primary" onclick="window.location='status-pengajuan-detail.php'"><i class="fa fa-download"></i> &nbsp;Unduh</button></td>
              </tr>

              <tr>
                <td class="text-center">How to Code 101</td>
                <td class="text-center">Nando P. Pratama</td>
                <td class="text-center">Komputer</td>
                <td class="text-center">1 Januari 2019</td>
                <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='status-pengajuan-detail-editor.php'"><i class="fa fa-info"></i> &nbsp;Detail</button></td>
                                <td class="text-center"><button type="button" class="btn btn-primary" onclick="window.location='status-pengajuan-detail.php'"><i class="fa fa-download"></i> &nbsp;Unduh</button></td>
              </tr>

              <tr>
                <td class="text-center">How to Code 101</td>
                <td class="text-center">Nando P. Pratama</td>
                <td class="text-center">Komputer</td>
                <td class="text-center">1 Januari 2019</td>
                <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='status-pengajuan-detail-editor.php'"><i class="fa fa-info"></i> &nbsp;Detail</button></td>
                                <td class="text-center"><button type="button" class="btn btn-primary" onclick="window.location='status-pengajuan-detail.php'"><i class="fa fa-download"></i> &nbsp;Unduh</button></td>
              </tr>

              <tr>
                <td class="text-center">How to Code 101</td>
                <td class="text-center">Nando P. Pratama</td>
                <td class="text-center">Komputer</td>
                <td class="text-center">1 Januari 2019</td>
                <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='status-pengajuan-detail-editor.php'"><i class="fa fa-info"></i> &nbsp;Detail</button></td>
                                <td class="text-center"><button type="button" class="btn btn-primary" onclick="window.location='status-pengajuan-detail.php'"><i class="fa fa-download"></i> &nbsp;Unduh</button></td>
              </tr>

            </tbody>
          </table>
        </div>

        <h2>Sudah Diterbitkan</h2>


        <div class="table-details">
          <table class="table table-hover table-bordered table-responsive">
            <thead>
              <tr>
                <th class="text-center">Judul Buku</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Tanggal Terbit</th>
                <th class="text-center">Status</th>
                <th class="text-center">Jumlah Terjual</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">How to Code 101</td>
                <td class="text-center">Komputer</td>
                <td class="text-center">1 Juni 2019</td>
                <td class="text-center">Sudah Diterbitkan</td>
                <td class="text-center">509</td>
                <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='status-pengajuan-detail.php'">Detail</button></td>
              </tr>

              <tr>
                <td class="text-center">How to Code 101</td>
                <td class="text-center">Komputer</td>
                <td class="text-center">12 Oktober 2019</td>
                <td class="text-center">Sudah Diterbitkan</td>
                <td class="text-center">159</td>
                <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='status-pengajuan-detail.php'">Detail</button></td>
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
