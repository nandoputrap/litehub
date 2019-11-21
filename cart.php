<?php
require_once("templates/header.php");
?>

<?php
session_start();
function connectDB() {
  // require 'config/connect.php';
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

if (isset($_GET['id'])) {
  $no = $_GET['id'];
}
else {
  echo  "<script type='text/javascript'>alert('Masukkan ke cart gagal');window.location = './shop.php';</script>";
}

?>

<div class="cart section-mini-margin">
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
                      <?php
                      $conn = connectDB();
                      $query = "SELECT * FROM book where book_id = '$no'";
                      $detail_unggah = mysqli_query($conn, $query);

                      if (mysqli_num_rows($detail_unggah) > 0) {
                        $row = mysqli_fetch_assoc($detail_unggah);
                        echo '
                        <td class="col-md-2"><img class="card-img-top img-responsive img-cart" src="'.$row['img_path'].'" alt="card-img"></td>
                        <td>
                        <h2 id="ebook-title">'.$row['title'].'</h2>
                        <h4 class="ebook-author">'.$row['author'].'</h4>
                        <p>Penerbit : '.$row['publisher'].'</p>
                        <p>SKU : '.$row['book_id'].'</p>
                        </td>

                        <td> <h4> Rp. '.$row['quantity'].'</h4> </td>
                        <td> <a class="btn btn-danger btn-hapus text-capitalize"><i class="fa fa-trash"> &nbsp; Hapus</i></a> </td>
                        ';
                      }
                      ?>

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
