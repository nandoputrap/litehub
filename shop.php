<?php
  require_once("templates/header.php");
  session_start();
?>

<?php
	session_start();
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

	function daftarBuku($table) {
		$conn = connectDB();

		$sql = "SELECT book_id, img_path, title, author, publisher, quantity FROM $table";

		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

	function selectRowsFromSubmission() {
		$conn = connectDB();

		$sql = "SELECT * FROM submission WHERE user_id = ".$_SESSION["user_id"]."";
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

	function pinjamBuku($book_id, $user_id) {
		$conn = connectDB();
		$sqlsubmission = "INSERT into submission (book_id, user_id) values ('$book_id','$user_id')";

		$sqlbook = "UPDATE book SET quantity = quantity-1 where book_id = $book_id";
		if(!$result = mysqli_query($conn, $sqlsubmission)) {
			die("Error: $sqlsubmission");
		}
		if(!$result = mysqli_query($conn, $sqlbook)) {
			die("Error: $sqlbook");
		}
		mysqli_close($conn);
		header("Location: daftar.php");
	}

	function balikBuku($book_id, $user_id) {
		$conn = connectDB($book_id, $user_id);
		$sqlsubmission = "DELETE FROM submission WHERE book_id = $book_id AND user_id = $user_id";

		$sqlbook = "UPDATE book SET quantity = quantity+1 where book_id = $book_id";
		if(!$result = mysqli_query($conn, $sqlsubmission)) {
			die("Error: $sqlsubmission");
		}
		if(!$result = mysqli_query($conn, $sqlbook)) {
			die("Error: $sqlbook");
		}
		mysqli_close($conn);
		header("Location: daftar.php");
	}

	function showActButton($arraysubmission, $bookid, $stocknum) {
		$flag = false;
		for ($i=0; $i < count($arraysubmission); $i++) {
			if ($arraysubmission[$i] == $bookid) {
				echo '
				<form action="daftar.php" method="post">
					<input type="hidden" name="book_id" value="'.$bookid.'">
					<input type="hidden" name="command" value="balik">
					<button type="submit" class="btn btn-default" style="width:100%;">Balik</button>
				</form>
				';
				$flag = true;
			}
		}
		if($flag == false) {
			if($stocknum > 0) {
				echo '
				<form action="daftar.php" method="post">
					<input type="hidden" name="book_id" value="'.$bookid.'">
					<input type="hidden" name="command" value="pinjam">
					<button type="submit" class="btn btn-default" style="width:100%;">Pinjam</button>
				</form>
				';
			}
		}
	}

	function insertBuku() {
		$conn = connectDB();

		$displayBuku = $_POST['displayBuku'];
		$judulBuku = $_POST['judulBuku'];
		$pengarangBuku = $_POST['pengarangBuku'];
		$penerbitBuku = $_POST['penerbitBuku'];
		$deskripsiBuku = $_POST['deskripsiBuku'];
		$stokBuku = $_POST['stokBuku'];

		$daftarbuku = daftarBuku("book");
		$sdhAda = false;
		$bookid = 0;
		while ($row = mysqli_fetch_row($daftarbuku)) {
			if($row[2] == $judulBuku) {
				$sdhAda = true;
				$bookid = $row[0];
				break;
			}
		}
		$_SESSION["titlebookadded"] = $judulBuku;

		if($sdhAda == true) {
			$sql = "UPDATE book SET quantity = quantity + $stokBuku where book_id = $bookid";
		} else {
			$sql = "INSERT into book (img_path, title, author, publisher, description, quantity) values('$displayBuku', '$judulBuku', '$pengarangBuku', '$penerbitBuku', '$deskripsiBuku', $stokBuku)";
		}

		if($result = mysqli_query($conn, $sql)) {
			echo "New record created successfully <br/>";
			header("Location: detail.php");
			} else {
			die("Error: $sql");
		}
		mysqli_close($conn);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['command'] === 'insert') {
			insertBuku();
		}else if ($_POST['command'] === 'pinjam') {
			pinjamBuku($_POST['book_id'],$_SESSION["user_id"]);
		} else if ($_POST['command'] === 'balik') {
			balikBuku($_POST['book_id'],$_SESSION["user_id"]);
		}
	}

?>

<div class="shop">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li>Shop</li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <?php require_once("templates/sidebar.php"); ?>
      </div>

      <div class="col-md-9">
        <h4>Menampilkan 1-6 dari 200 e-book Teknologi</h4>

        <div class="row">
          <div class="product">
          <?php
              $daftarbuku = daftarBuku("book");
              if(isset($_SESSION['namauser'])) {
                $daftarpinjaman = selectRowsFromSubmission();
                  $arraysubmission = array();
                  while ($baris = mysqli_fetch_row($daftarpinjaman)) {
                    array_push($arraysubmission, $baris[1]);
                  }
              }

            while ($row = mysqli_fetch_row($daftarbuku)) {
              echo '
                    <div class="col-md-4 col-sm-6">
                      <div class="item">
                        <div class="card box-shadow text-center card-product">
                          <img class="card-img-top img-fluid" style="height:300px;" src="'.$row[1].'" alt="card-img">
                          <div class="card-body">
                          <a href="details.php?id='.$row[0].'"><h3 class="card-title ebook-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><strong>'.$row[2].'</strong></h3></a>
                            <p class="card-text ebook-author" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$row[3].'</p>
                            <p class="card-text ebook-author" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$row[4].'</p>';
                            if($row[5] > 0) {
                              echo '<h4 class="card-title ebook-price"><strong>Rp. '.$row[5].'</strong></h4>';
                            } else {
                              echo '<h4 class="card-title ebook-price"><strong>Stok Kosong</strong></h4>';
                            }
                            echo '
                            <a class="btn btn-lg btn-danger btn-beli text-capitalize"><i class="fa fa-shopping-cart"> </i>&nbsp; Beli</a>
                            ';
                            echo '
                        </div>
                        </div>
                      </div>
                    </div>';
            }
          ?>



          </div>
        </div>

        <div class="row">
          <div class="row text-center">
                  <ul class="pagination pagination-lg">
                    <li class="active active-pagination"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li> <a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                  </ul>
                </div>

        </div>
      </div>
    </div>


    </div>

</div>

<?php
  require_once("templates/footer.php");
?>
