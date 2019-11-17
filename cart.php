<?php
  require_once("templates/header.php");
?>

<div class="cart">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1>Keranjang</h1>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 items-cart">
        <div class="row">
          <div class="box">
            <form class="" action="cart.php" method="post" enctype="multipart/form-data">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th colspan="2">Produk</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="col-md-3"><img class="card-img-top img-responsive img-cart" src="images/ebook-1.png" alt="card-img"></td>
                      <td>
                        <h1 id="ebook-title">Judul Buku</h1>
                        <h2 class="ebook-author">Nama Penulis</h2>
                        <p>ISBN : 987654321</p>
                        <p>SKU : 1234567</p>
                      </td>

                      <td> <h2>Rp. 100.000</h2> </td>
                      <td> <a class="btn btn-lg btn-danger btn-beli text-capitalize"><i class="fa fa-trash"> &nbsp; Hapus</i></a> </td>
                    </tr>

                    <tr>
                      <th> <a href="#">Lanjutkan belanja</a> </th>
                      <th class="pull-right">Total</th>
                      <th>Rp. 100.000</th>
                      <th> <a href="#">Lanjut ke pembayaran</a> </th>
                    </tr>
                  </tbody>
                </table>

                <hr>

                <table class="table">
                  <thead>

                  </thead>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
