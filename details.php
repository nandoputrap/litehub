<?php
  require_once("templates/header.php");
?>

<div class="shop">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="index.php">Teknologi</a></li>
          <li><a href="index.php">Pemrograman</a></li>
          <li>Buku Sakti Framework Laravel</li>
        </ul>
      </div>
    </div>

    <div class="row">

      <div class="col-md-3">
        <div class="item">
          <div class="card box-shadow text-center card-product-details">
            <img class="card-img-top img-fluid" src="images/ebook-1.png" alt="card-img">
          </div>

          <div class="table-details">
            <table class="table table-hover table-bordered">
              <tbody>
                <tr>
                  <td>Tanggal Terbit</td>
                  <td>1 Januari 2019</td>
                </tr>
                <tr>
                  <td>Jumlah Halaman</td>
                  <td>324</td>
                </tr>
                <tr>
                  <td>Bahasa</td>
                  <td>Indonesia</td>
                </tr>
                <tr>
                  <td>ISBN</td>
                  <td>9786025904532</td>
                </tr>
                <tr>
                  <td>SKU</td>
                  <td>NFTPR001</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>

      <div class="col-md-9 description-box">

        <div class="row">
          <h1 id="ebook-title">Judul Buku</h1>

          <p class="ebook-author">Nama Penulis</p>

          <p class="ebook-description text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

          <p class="ebook-author">Format yang tersedia:</p>
          <ul class="list-inline">
            <li>.pdf</li>
            <li>.epub</li>
            <li>.mobi</li>
          </ul>

          <h4 class="ebook-price ebook-price-single"><strong>Rp. 100.000</strong></h4>

          <a class="btn btn-lg btn-danger btn-beli text-capitalize"><i class="fa fa-shopping-cart"></i>&nbsp; Beli</a>
          <a href="cart.php" class="btn btn-lg btn-info btn-beli text-capitalize"><i class="fa fa-plus"> </i>&nbsp; Tambah ke Keranjang</a>


        </div>
      </div>
    </div>


    </div>

</div>

<?php
  require_once("templates/footer.php");
?>
