<?php
	session_start();
	function connectDB() {
		$servername = "sql12.freesqldatabase.com";
		$username = "sql12313869";
		$password = "qy1jlUjdiy";
		$dbname = "sql12313869";

		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if (!$conn) {
			die("Connection failed: " + mysqli_connect_error());
		}
		return $conn;
	}

	if(!isset($_SESSION["namauser"])) {
		header("Location: daftar.php");
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

	function selectBooks() {
		$pinjam = selectRowsFromSubmission();
		$arraysubmission = array();
		while ($baris = mysqli_fetch_row($pinjam)) {
			array_push($arraysubmission, $baris[1]);
		}
		return $arraysubmission;
	}

	function selectAllFromBook($book_id) {
		$conn = connectDB();

		$sql = "SELECT * FROM book WHERE book_id = $book_id";
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
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
		header("Location: home.php");
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ($_POST['command'] === 'balik') {
			balikBuku($_POST['book_id'],$_SESSION["user_id"]);
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>EBOOKHUB.ID</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
	<div class="jumbotron">
		<h1 style="font-size: 6em;">EBOOKHUB.ID</h1>
		<div class="welcome-text">
		<h2>Selamat Datang <b>
			<?php
			if (isset($_SESSION["namauser"])){
				echo $_SESSION["namauser"];
			}
			?></b>
		</h2>
		<?php
			if(!isset($_SESSION['namauser'])) {
				echo '<button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#loginModal">Log in</button>';
			}
		?>
		</div>
	</div>
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="insertModalLabel">Login</h4>
				</div>
				<div class="modal-body">
					<form action="index.php" method="post">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="insert-username" name="username" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="insert-password" name="password" placeholder="Password">
						</div>
						<input type="hidden" id="insert-command" name="command" value="insert">
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				 <a class="navbar-brand" href="#">My Personal Library</a>
			</div>
			<ul class="nav navbar-nav">
				<?php
				if (isset($_SESSION["namauser"])) {
					echo '
					<li class="active"><a href="home.php">Home</a></li>
					';
				}
				?>
				<li><a href="daftar.php">Daftar Buku</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
					if (isset($_SESSION["namauser"])){
						echo "<li><a href='services/logout.php'><span class='glyphicon glyphicon-log-out'></span>Logout</a></li>";
					}
				?>
			</ul>
		</div>
	</nav>
	<div class="container">
		<?php
			if(isset($_SESSION['namauser']) && $_SESSION['role'] === 'user') {
				echo '
					<div class="well well-sm">
						<strong>Tampilan</strong>
						<div class="btn-group">
							<a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
							</span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
							class="glyphicon glyphicon-th"></span>Grid</a>
						</div>
					</div>
				';
			}
		?>
		<div id="products" class="row list-group">
			<?php
			$arraybook = selectBooks();
			for ($i=0; $i < count($arraybook); $i++) { 
				$buku = selectAllFromBook($arraybook[$i]);
				while ($row = mysqli_fetch_row($buku)) {
					echo '
					<div class="item  col-xs-4 col-lg-4">
						<div class="thumbnail">
							<img class="list-group-image" style="width:300px; height:300px;" src="'.$row[1].'" />
							<div class="caption">
								<h4 class="title-book">'.$row[2].'</h4>
								<p class="list-group-item-text">Penulis : '.$row[3].'</p>
								<p class="list-group-item-text">Penerbit : '.$row[4].'</p>';
								echo '
								<div class="row">
									<div class="col-md-6">
										<button type="button" class="btn btn-default" style="width:100%;" data-toggle="modal" data-target="#detailModal" onclick="detailBuku('.$row[0].')">
										Detail
										</button>
									</div>
									<div id="tombolPinjam'.$row[0].'" class="col-md-6">
										<form action="home.php" method="post">
											<input type="hidden" name="book_id" value="'.$row[0].'">
											<input type="hidden" name="command" value="balik">
											<button type="submit" class="btn btn-default" style="width:100%;">Balik</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					';
				}
			}
			?>
		</div>
		<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title black-modal" id="detailModalLabel">Detail Buku</h4>
                        </div>
                        <div class="modal-body">
							<fieldset>
                        		<legend>Display Buku</legend>
								<div id="displayBuku">
								</div>
							</fieldset>
							<fieldset>
                        		<legend>Judul Buku</legend>
								<div id="judulBuku">
								</div>
							</fieldset>
                        	<fieldset>
                        		<legend>Deskripsi Buku</legend>
								<div id="deskripsiBuku">
								</div>
							</fieldset>
							<div style="overflow-x:auto;">
								<table class='table'>
									<thead> <tr><th>Book ID</th> <th>Pengarang</th> <th>Penerbit</th> <th>Stock</th> </tr> </thead>
									<tbody id="detailBuku">
									</tbody>
								</table>
							</div>
							<?php
								echo '
									<div style="overflow-x:auto;">
										<table class="table">
											<thead> <tr><th>Purchase ID</th> <th>Book ID</th> <th>User ID</th> <th>Date</th> </tr> </thead>
											<tbody id="detailPurchase">
											</tbody>
										</table>
									</div>
									<fieldset>
										<legend>Book Purchase</legend>
										<div id="bookPurchase">
										</div>
									</fieldset>';
								if(isset($_SESSION['namauser']) && $_SESSION['role'] === 'user') {
									echo 
									'<div class="form-group">
										<label for="bookPurchase">Book Purchase</label>
										<input type="text" class="form-control" id="update-bookPurchase" name="bookPurchase" placeholder="Book Purchase">
									</div>
									<button type="button" class="btn btn-default" style="width:100%;" onclick="komenBuku(';
									echo $_SESSION["user_id"];
									echo ')">Submit</button><br>';
									echo '<br><div id="detailPinjam"></div>';
								}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
	</div>
	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/home.js"></script>	
	<script type="text/javascript" src="js/ajax.js"></script>
</body>
<footer>
	<hr>
	<h4>&copy; 2019 Litehub Inc. All rights reserved</h4>
</footer>
</html>							