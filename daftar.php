<?php
	function connectDB() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "test";
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " + mysqli_connect_error());
		}
		return $conn;
	}
	
	function insertPaket() {
		$conn = connectDB();
		
		$namaPaket = $_POST['namaPaket'];
		$tujuan = $_POST['tujuan'];
		$fitur = $_POST['fitur'];
		$harga = $_POST['harga'];
		$sql = "INSERT into paket (nama_paket, tujuan, fitur, harga) values('$namaPaket', '$tujuan', '$fitur', '$harga')";
		
		if($result = mysqli_query($conn, $sql)) {
			echo "New record created successfully <br/>";
			header("Location: latihan.php");
			} else {
			die("Error: $sql");
		}
		mysqli_close($conn);
	}
	
	function updatePaket($id) {
		$conn = connectDB();
		
		$namaPaket = $_POST['namaPaket'];
		$tujuan = $_POST['tujuan'];
		$fitur = $_POST['fitur'];
		$harga = $_POST['harga'];
		$sql = "UPDATE paket SET nama_paket='$namaPaket', tujuan='$tujuan', fitur='$fitur', harga='$harga' WHERE id=$id";
		
		if($result = mysqli_query($conn, $sql)) {
			echo "New record created successfully <br/>";
			header("Location: latihan.php");
			} else {
			die("Error: $sql");
		}
		mysqli_close($conn);
	}
	
	function deletePaket($id) {
		$conn = connectDB();
		
		$sql = "DELETE FROM paket WHERE id=$id";
		
		if($result = mysqli_query($conn, $sql)) {
			echo "New record created successfully <br/>";
			header("Location: latihan.php");
			} else {
			die("Error: $sql");
		}
		mysqli_close($conn);
	}
	
	function selectAllFromTable($table) {
		$conn = connectDB();
		
		$sql = "SELECT img_path, title, author, publisher, quantity FROM $table";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['command'] === 'insert') {
			insertPaket();
		}else if($_POST['command'] === 'update') {
			updatePaket($_POST['userid']);
		} else if($_POST['command'] === 'delete') {
			deletePaket($_POST['userid']);
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>My Personal Library</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="container">
			  <div class="jumbotron">
				<h1>My Personal Library</h1>
				<p>My Personal Library is my first online library.</p>
			  </div>
			</div>
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand" href="home.html">My Personal Library</a>
				</div>
				<ul class="nav navbar-nav">
				  <li><a href="home.html">Home</a></li>
				  <li class="active"><a href="daftar.php">Daftar Buku</a></li>
				  <!--<li><a href="#">Page 2</a></li> -->
				</ul>
				<!-- <form class="navbar-form navbar-left">
				  <div class="form-group">
					<input type="text" class="form-control" placeholder="Username">
					<input type="password" class="form-control" placeholder="Password">
				  </div>
				  <button type="submit" class="btn btn-default">Login</button>
				</form> -->
				<ul class="nav navbar-nav navbar-right">
					<!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
					<?php 
						session_start();
						if (!isset($_SESSION["namauser"])){
							echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span>Login</a></li>";
						}else if (isset($_SESSION["namauser"])){
							echo "<li><a href='services/logout.php'><span class='glyphicon glyphicon-log-out'></span>Logout</a></li>";
						}
					?>
				</ul>
			  </div>
			</nav>
			<h4>
			Selamat Datang
			<?php
				if (isset($_SESSION["namauser"])){
					echo $_SESSION["namauser"];
				}
			?>
			</h4>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertModal">
				Add Buku
			</button>
			<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="insertModalLabel">Add Buku</h4>
						</div>
						<div class="modal-body">
							<form action="latihan.php" method="post">
								<div class="form-group">
									<label for="namaPaket">Judul Buku</label>
									<input type="text" class="form-control" id="insert-namaPaket" name="namaPaket" placeholder="Nama Paket">
								</div>
								<div class="form-group">
									<label for="tujuan">Pengarang</label>
									<input type="text" class="form-control" id="insert-tujuan" name="tujuan" placeholder="Tujuan">
								</div>
								<div class="form-group">
									<label for="fitur">Penerbit</label>
									<input type="text" class="form-control" id="insert-fitur" name="fitur" placeholder="Fitur">
								</div>
								<div class="form-group">
									<label for="harga">Deskripsi</label>
									<input type="text" class="form-control" id="insert-harga" name="harga" placeholder="Harga">
								</div>
								<input type="hidden" id="insert-command" name="command" value="insert">
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class='table'>
					<thead> <tr> <th>Display</th> <th>Judul Buku</th> <th>Pengarang</th> <th>Penerbit</th> <th>Stok</th> </tr> </thead>
					<tbody>
						<?php
							
							$buku = selectAllFromTable("book");
							while ($row = mysqli_fetch_row($buku)) {
								echo "<tr>";
								foreach($row as $key => $value) {
									if ($key == "img_path"){
										echo "<td><img class='img-responsive' src='$value' alt='$value'></td>";
									}else {
										echo "<td>$value</td>";
									}
								}
								echo '<td>
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#updateModal" onclick="setUpdateData(\''.$row[0].'\',\''.$row[1].'\',\''.$row[2].'\',\''.$row[3].'\',\''.$row[4].'\')">
								Detail
								</button>
								</td>';
								echo '<td>
								<form action="latihan.php" method="post">
									<input type="hidden" id="delete-userid" name="userid" value="'.$row[0].'">
									<input type="hidden" id="delete-command" name="command" value="delete">
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
								</td>';
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="updateModalLabel">Update Buku</h4>
						</div>
						<div class="modal-body">
							<form action="latihan.php" method="post">
								<div class="form-group">
									<label for="namaPaket">Judul Buku</label>
									<input type="text" class="form-control" id="update-namaPaket" name="namaPaket" placeholder="Nama Paket">
								</div>
								<div class="form-group">
									<label for="tujuan">Pengarang</label>
									<input type="text" class="form-control" id="update-tujuan" name="tujuan" placeholder="Tujuan">
								</div>
								<div class="form-group">
									<label for="fitur">Penerbit</label>
									<input type="text" class="form-control" id="update-fitur" name="fitur" placeholder="Fitur">
								</div>
								<div class="form-group">
									<label for="harga">Deskripsi</label>
									<input type="text" class="form-control" id="update-harga" name="harga" placeholder="Harga">
								</div>
								<input type="hidden" id="update-userid" name="userid">
								<input type="hidden" id="update-command" name="command" value="update">
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="src/script/jquery-3.1.1.min.js"></script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>		
		<script>
			function setUpdateData(id, namaPaket, tujuan, fitur, harga) {
				$("#update-userid").val(id);
				$("#update-fullname").val(namaPaket);
				$("#update-email").val(tujuan);
				$("#update-username").val(fitur);
				$("#update-role").val(harga);
			}
		</script>
	</body>
</html>							