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
		header('Location:shop.php');
	  }
	
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
          <?php
          $conn = connectDB();
          $query = "SELECT * FROM book where book_id = '$no'";
          $detail_unggah = mysqli_query($conn, $query);

          if (mysqli_num_rows($detail_unggah) > 0) {
            $row = mysqli_fetch_assoc($detail_unggah);
            echo '
            <img class="card-img-top img-fluid" style="height:300px;" src="'.$row['img_path'].'" alt="card-img">
            ';
          }
          ?>
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
        <?php
			$conn = connectDB();
			$query = "SELECT * FROM book where book_id = '$no'";
			$detail_unggah = mysqli_query($conn, $query);

			if (mysqli_num_rows($detail_unggah) > 0) {
				$row = mysqli_fetch_assoc($detail_unggah);
        echo'
        <h1 id="ebook-title">'.$row['title'].'</h1>
        <p class="ebook-author">Penulis : '.$row['author'].'</p>
        <p class="ebook-author">Penerbit : '.$row['publisher'].'</p>
        <p class="ebook-description text-justify">'.$row['description'].'</p>
        <p class="ebook-author">Format yang tersedia:</p>
        <ul class="list-inline">
          <li>.pdf</li>
          <li>.epub</li>
          <li>.mobi</li>
        </ul>
        ';
        if($row['quantity'] > 0) {
          echo '<h4 class="card-title ebook-price"><strong>Rp. '.$row['quantity'].'</strong></h4>';
        } else {
          echo '<h4 class="card-title ebook-price"><strong>Stok Kosong</strong></h4>';
        }
			}
		?>	
          
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
