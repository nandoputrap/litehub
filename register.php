<?php
  require_once("templates/header.php");
?>

<div class="register">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="register-title">Daftar Akun Ebookhub</h1>
      </div>

      <div class="col-md-9 form-register-group">
        <form class="" action="" method="post">
          <input type="text" class="form-control form-register" placeholder="Nama lengkap...">
          <input type="text" class="form-control form-register" placeholder="Nama pengguna...">
          <input type="email" class="form-control form-register" placeholder="E-mail...">
          <input type="password" class="form-control form-register" placeholder="Kata sandi...">
          <input type="password" class="form-control form-register" placeholder="Ulangi kata sandi...">
          <label class="checkbox-inline">
            <input type="checkbox" value="">Dengan pembuatan akun, Anda menyetujui <a href="#">syarat & ketentuan</a> dari Ebookhub
          </label>

          <button type="button" class="btn btn-primary btn-block btn-ebookhub btn-register">Daftar</button>
        </form>
      </div>

      <div class="col-md-3">
        <div class="login-social">
          <button type="button" class="btn btn-primary btn-block btn-fb"> <i class="fa fa-facebook"></i>&nbsp;&nbsp;Daftar dengan Facebook</button>
          <button type="button" class="btn btn-primary btn-block btn-google"> <i class="fa fa-google"></i>&nbsp;&nbsp;Daftar dengan Google</button>
        </div>
      </div>
    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
