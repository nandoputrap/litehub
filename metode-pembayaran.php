<?php
  require_once("templates/header.php");
?>

<div class="metode-pembayaran">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="register-title">Pilih Metode Pembayaran</h1>
      </div>

      <div class="col-md-4 form-register-group">
        <form class="" action="" method="post">
          <div class="radio">
            <label><input type="radio" name="optradio"> <img src="images/bni.png" alt="" class="img-bank radio-bank"> </label>
          </div>

          <div class="radio">
            <label><input type="radio" name="optradio"> <img src="images/bri.png" alt="" class="img-bank radio-bank"> </label>
          </div>

          <div class="radio">
            <label><input type="radio" name="optradio"> <img src="images/bca.png" alt="" class="img-bank radio-bank"> </label>
          </div>

        </form>
      </div>

      <div class="col-md-4 form-register-group">
        <form class="" action="" method="post">
          <div class="radio">
            <label><input type="radio" name="optradio"> <img src="images/mandiri.png" alt="" class="img-bank radio-bank"> </label>
          </div>

          <div class="radio">
            <label><input type="radio" name="optradio"> <img src="images/gopay.png" alt="" class="img-bank radio-bank"> </label>
          </div>


        </form>
      </div>

      <div class="col-md-3 pull-right">
        <div class="panel-ringkasan-belanja">
          <div class="panel-heading">
            <h3 class="panel-title">Ringkasan belanja</h3>
          </div>

          <div class="panel-body">
            <ul class="nav nav-pills nav-stacked category-menu">
              <a href="#"></a>
              <li><p href="#">Jumlah</p></li>
              <li><p href="#">Total</p></li>

              <button type="button" class="btn btn-primary btn-block btn-ebookhub btn-register">Bayar sekarang</button>
            </ul>
          </div>
        </div>

      </div>


    </div>

    <div class="row panduan-pembayaran">
      <div class="col-md-12">
        <h1 class="register-title">Panduan Pembayaran</h1>
      </div>

      <div class="col-md-12">
        <div class="panel-group" id="accordion">
          <div class="panel panel-danger">
            <div class="panel-heading panel-transfer">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Transfer Bank BNI</a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse out">
              <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat.</div>
            </div>
          </div>

          <div class="panel panel-danger">
            <div class="panel-heading panel-transfer">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Transfer Bank BRI</a>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse out">
              <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat.</div>
            </div>
          </div>

          <div class="panel panel-danger">
            <div class="panel-heading panel-transfer">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Transfer Bank BCA</a>
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse out">
              <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat.</div>
            </div>
          </div>

          <div class="panel panel-danger">
            <div class="panel-heading panel-transfer">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Transfer Bank Mandiri</a>
              </h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse out">
              <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat.</div>
            </div>
          </div>

          <div class="panel panel-danger">
            <div class="panel-heading panel-transfer">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Transfer Gopay</a>
              </h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse out">
              <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat.</div>
            </div>
          </div>


        </div>
      </div>
    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
