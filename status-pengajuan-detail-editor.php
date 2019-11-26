<?php
  require_once("templates/header.php");

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
              <h3 class="panel-title">Nando Putra Pratama</h3>
            </div>

            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked category-menu">
                <li>
                  <a href="lihat-profil.php">Edit Profil</a>
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

                    <!-- <select class="form-control" id="kategori" style="height: 100%;">
                      <option>Dalam Proses Penyuntingan</option>
                      <option>Sudah Diterbitkan</option>
                    </select> -->
                    <div class="button dropdown">
                      <select id="status-pengajuan" class="form-control" id="kategori" style="height: 100%;">
                       <option>Dalam Proses Penyuntingan</option>
                       <option value="form-publish">Sudah Diterbitkan</option>
                      </select>
                    </div>

                </td>
              </tr>


            </tbody>
          </table>
        </div>
        <br><br>

        <!-- Jika select option nya = Sudah Diterbitkan, maka akan muncul form buku untuk diterbitkan
             Use JavaScript ehehe.. :))
       -->

        <!-- Begin Form buku untuk diterbitkan -->
        <div class="output">
          <div class="form-publish">
            <div class="text-center">
              <h2>Masukkan info buku untuk diterbitkan</h2>
            </div>

            <form action="services/upload.php" method="post" enctype="multipart/form-data">
              <input type="text" class="form-control form-register" id="insert-judulBuku" name="judulBuku" placeholder="Judul buku...">
              <input type="text" class="form-control form-register" id="insert-namaPenulis" name="namaPenulis" placeholder="Nama penulis...">
              <input type="text" class="form-control form-register" id="insert-namaPenerbit" name="namaPenerbit" placeholder="Nama penerbit...">
              <input type="text" class="form-control form-register" id="insert-harga" name="Harga" placeholder="Harga...">
              <div class="form-group">
                <label for="kategori"></label>
                <select class="form-control form-register form-group-kategori" name="kategori" id="kategori">
                        <option>-Pilih Kategori-</option>
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
                <label for="subkategori"></label>
                <select class="form-control form-register form-group-kategori" id="subkategori">
                  <!-- <option>-Pilih kategori-</option> -->
                  <option>-Pilih Sub Kategori-</option>
                  <option>SubKategori 1</option>
                  <option>SubKategori 2</option>
                  <option>SubKategori 3</option>
                  <option>SubKategori 4</option>
                  <option>SubKategori 5</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-register" placeholder="ISBN...">
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-register" placeholder="SKU...">
              </div>
              <div class="form-group">
               <textarea class="form-control" rows="5" id="comment" name="deskripsiBuku" placeholder="Deskripsi/Sinopsis buku..."></textarea>
              </div>

              <div class="form-group">
                <label for="exampleFormControlFile1">
                  Pilih Cover Buku
                </label>
                <input type="file" class="form-control-file" name="fileToUpload" id="exampleFormControlFile1">
              </div>

              <div class="form-group">
                <label for="exampleFormControlFile1">
                  Format buku dalam bentuk .doc atau .docx. Format penulisan dan layout dapat melihat pada halaman <a href="#">ini.</a> Ukuran file maksimal 50 MB.
                </label>
                <input type="file" class="form-control-file" name="fileToUpload" id="exampleFormControlFile1">
              </div>

              <input type="hidden" id="insert-command" name="command" value="insert">
            </form>



          </div>
        </div>

        <!-- tandai -->
        <button type="button" class="btn btn-primary btn-block btn-ebookhub btn-register">Simpan</button>

        <!-- End Form buku untuk diterbitkan -->


      </div>


    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
