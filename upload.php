<?php
  require_once("templates/header.php");
?>

<div class="register">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="register-title">Unggah Buku</h1>
      </div>

      <div class="col-md-9 form-register-group">
        <form class="" action="" method="post">
          <input type="text" class="form-control form-register" placeholder="Judul buku...">
          <input type="text" class="form-control form-register" placeholder="Nama penulis...">
          <div class="form-group">
            <label for="kategori"></label>
            <select class="form-control form-register form-group-kategori" id="kategori" placeholder="Deskripsi/Sinopsis buku...">
              <!-- <option>-Pilih kategori-</option> -->
              <option>Kategori 1</option>
              <option>Kategori 2</option>
              <option>Kategori 3</option>
              <option>Kategori 4</option>
              <option>Kategori 5</option>
            </select>
          </div>
          <div class="form-group">
           <textarea class="form-control" rows="5" id="comment" placeholder="Deskripsi/Sinopsis buku..."></textarea>
          </div>

          <form>
            <div class="form-group">
              <label for="exampleFormControlFile1">
                Format buku dalam bentuk .doc atau .docx. Format penulisan dan layout dapat melihat pada halaman <a href="#">ini.</a> Ukuran file maksimal 50 MB.
              </label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
          </form>

          <button type="button" class="btn btn-primary btn-block btn-ebookhub btn-register">Daftar</button>
        </form>
      </div>

      
    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
