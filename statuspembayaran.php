<?php
  require_once("templates/header.php");
?>

<div class="register">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="register-title">Status Pembayaran?</h1>
      </div>

      <div class="col-md-9 form-register-group">
        <form action="services/statuspembayaran.php" method="post">
          <input type="text" class="form-control form-register" id="insert-username" name="username" placeholder="Username...">
          <input type="hidden" id="insert-command" name="command" value="insert">
          <button type="submit" class="btn btn-success btn-block btn-register">SUCCESS</button>
          <button type="submit" class="btn btn-danger btn-block btn-register">FAILED</button>
        </form>
      </div>

    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
