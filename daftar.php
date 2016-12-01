<?php
	session_start();
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
	
	function insertBuku() {
		$conn = connectDB();
		
		$displayBuku = $_POST['displayBuku'];
		$judulBuku = $_POST['judulBuku'];
		$pengarangBuku = $_POST['pengarangBuku'];
		$penerbitBuku = $_POST['penerbitBuku'];
		$deskripsiBuku = $_POST['deskripsiBuku'];
		$stokBuku = $_POST['stokBuku'];
		$sql = "INSERT into book (img_path, title, author, publisher, description, quantity) values('$displayBuku', '$judulBuku', '$pengarangBuku', '$penerbitBuku', '$deskripsiBuku', $stokBuku)";
		
		if($result = mysqli_query($conn, $sql)) {
			echo "New record created successfully <br/>";
			header("Location: daftar.php");
			} else {
			die("Error: $sql");
		}
		mysqli_close($conn);
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

	function selectRowsFromLoan($userid) {
		$conn = connectDB();

		$sql = "SELECT * FROM loan WHERE user_id = $userid";
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

	function deskripsiBuku($table) {
		$conn = connectDB();

		$sql = "SELECT book_id, description FROM $table";

		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

	function reviewBuku($table) {
		$conn = connectDB();

		$sql = "SELECT book_id, user_id, date, content FROM $table";

		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}

	function pinjamBuku($book_id, $user_id) {
		$conn = connectDB();
		$sqlloan = "INSERT into loan (book_id, user_id) values ('$book_id','$user_id')";

		$sqlbook = "UPDATE book SET quantity = quantity-1 where book_id = $book_id";
		if(!$result = mysqli_query($conn, $sqlloan)) {
			die("Error: $sqlloan");
		}
		if(!$result = mysqli_query($conn, $sqlbook)) {
			die("Error: $sqlbook");
		}
		mysqli_close($conn);
		header("Location: daftar.php");
	}

	function balikinBuku($book_id, $user_id) {
		$conn = connectDB($book_id, $user_id);

		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		
		mysqli_close($conn);
		header("Location: daftar.php");
	}

	$detail = Array();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['command'] === 'insert') {
			insertBuku();
		}else if($_POST['command'] === 'update') {
			
		}else if ($_POST['command'] === 'detail'){
			$detail = detailBuku($_POST['book_id']);
			mysql_fetch_row($detail);
		} else if ($_POST['command'] === 'pinjam') {
			pinjamBuku($_POST['book_id'],$_SESSION["user_id"]);
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
		<style>
			#fotoBuku {
				height: 50%;
			}
		</style>
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
						<a class="navbar-brand" href="home.php">My Personal Library</a>
					</div>
					<ul class="nav navbar-nav">
						<li><a href="home.php">Home</a></li>
						<li class="active"><a href="daftar.php">Daftar Buku</a></li>
						<?php
							if (isset($_SESSION['namauser'])){
								echo '<li><a href="profile.php">Daftar Pinjaman</a></li>';
							}
						?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php
							if (!isset($_SESSION["namauser"])){
								echo "<li><a href='index.php'><span class='glyphicon glyphicon-log-in'></span>Login</a></li>";
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
            <?php
                if (isset($_SESSION["namauser"]) && $_SESSION["role"] === "admin"){
                    echo "<br><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#insertModal'>
                        Add Buku
                    </button>";
                }
            ?>
            <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title black-modal" id="insertModalLabel">Add Book</h4>
                        </div>
                        <div class="modal-body">
                            <form action="daftar.php" method="post">
                                <div class="form-group">
                                    <label for="displayBuku">Display Buku</label>
                                    <input type="url" class="form-control" id="insert-displayBuku" name="displayBuku" placeholder="Link Buku">
                                </div>
                                <div class="form-group">
                                    <label for="judulBuku">Judul Buku</label>
                                    <input type="text" class="form-control" id="insert-judulBuku" name="judulBuku" placeholder="Judul Buku">
                                </div>
                                <div class="form-group">
                                    <label for="pengarangBuku">Pengarang Buku</label>
                                    <input type="text" class="form-control" id="insert-pengarangBuku" name="pengarangBuku" placeholder="Pengarang Buku">
                                </div>
                                <div class="form-group">
                                    <label for="penerbitBuku">Penerbit Buku</label>
                                    <input type="text" class="form-control" id="insert-penerbitBuku" name="penerbitBuku" placeholder="Penerbit Buku">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsiBuku">Deskripsi Buku</label>
                                    <input type="text" class="form-control" id="insert-deskripsiBuku" name="deskripsiBuku" placeholder="Deskripsi Buku">
                                </div>
                                <div class="form-group">
                                    <label for="stokBuku">Stok Buku</label>
                                    <input type="number" class="form-control" id="insert-stokBuku" name="stokBuku" placeholder="Stok Buku">
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
                    <thead> <tr><th>Book ID</th> <th>Display</th> <th>Judul Buku</th> <th>Pengarang</th> <th>Penerbit</th> <th>Stock</th> </tr> </thead>
                    <tbody>
                        <?php
                            $daftarbuku = daftarBuku("book");
                            $daftarpinjaman = selectRowsFromLoan($_SESSION["user_id"]);
                            $arrayloan = array();
                            while ($baris = mysqli_fetch_row($daftarpinjaman)) {
                            	array_push($arrayloan, $baris);
                            }
                           	while ($row = mysqli_fetch_row($daftarbuku)) {
                                echo "<tr>";
                                foreach($row as $key => $value) {
	                            	if($key == 1) {
	                            		echo "<td><img class='img-responsive' src='$value' alt='$value'></td>";	
	                            	}
	                                else {
	                                	echo "<td>$value</td>";
	                            	}
                                }
								if ($row[0] == 5 || $row[0] == 6 || $row[0] == 7){
								}else {
									echo '<td>
									<button type="button" class="btn btn-default" data-toggle="modal" data-target="#detailModal" onclick="detailBuku('.$row[0].')">
									Detail
									</button>
									</td>';
								}
								$flag = false;
								for ($i=0; $i < count($arrayloan); $i++) { 
									if ($arrayloan[$i][1] == $row[0]) {
										echo '<td>
										<button type="button" class="btn btn-default" onclick="balikinBuku('.$row[0].','.$arrayloan[$i][2].')">
										Restore
										</button>
										</td>';
										$flag = true;
									}
								}
								if($flag == false) {
									echo '<td>
									<form action="daftar.php" method="post">
										<input type="hidden" name="book_id" value="'.$row[0].'">
										<input type="hidden" name="command" value="pinjam">
										<button type="submit" class="btn btn-default">Pinjam</button>
									</form>
									</td>';
								}
								echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
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
								if (isset($_SESSION["namauser"])){
									echo '
										<div style="overflow-x:auto;">
											<table class="table">
												<thead> <tr><th>Review ID</th> <th>Book ID</th> <th>User ID</th> <th>Date</th> </tr> </thead>
												<tbody id="detailReview">
												</tbody>
											</table>
										</div>
										<fieldset>
											<legend>Review Buku</legend>
											<div id="reviewBuku">
											</div>
										</fieldset>
										<form action="daftar.php" method="post">
											<div class="form-group">
												<label for="reviewBuku">Review Buku</label>
												<input type="text" class="form-control" id="update-reviewBuku" name="reviewBuku" placeholder="Review Buku">
											</div>
											<button type="button" class="btn btn-primary" onclick="komenBuku(<?php echo $_SESSION["namauser"];?>)">Submit</button>
											<button type="button" class="btn btn-default">Pinjam</button>
										</form>
									';
								}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<script src="js/jquery-3.1.0.min.js"> </script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>		
		<script>
			function detailBuku(book_id){
				reviewBuku(book_id);
				$.ajax({
					url: "http://localhost/tp2/ajax.php",
					datatype: "html",
					data: { book_id : book_id, command : "detail" },
					method: "POST"
				}).done(function(obj){
					var temp = JSON.parse(obj);
					$("#displayBuku").html("<td><img id='fotoBuku' src='"+ temp[1] + "'></td>");
					$("#judulBuku").html(temp[2]);
					$("#deskripsiBuku").html(temp[5]);
					$("#detailBuku").html("<td id='book_id'>"+ temp[0] + "</td>" + "<td>"+ temp[3] + "</td>" + "<td>"+ temp[4] + "</td>" + 
					"<td>"+ temp[6] + "</td>");
				});
			}
			function reviewBuku(book_id){
				$.ajax({
					url: "http://localhost/tp2/ajax.php",
					datatype: "html",
					data: { book_id : book_id, command : "review" },
					method: "POST"
				}).done(function(obj){
					var temp = JSON.parse(obj);
					$("#reviewBuku").html("");
					$("#detailReview").html("");
					for (var i = 0; i < temp.length; i++){
						$("#reviewBuku").html($("#reviewBuku").html() + (i+1) + ".	" + temp[i][4] + "<br>");
						for (var j = 0; j < temp[i].length; j++){
							if (j === 0){
								$("#detailReview").html($("#detailReview").html() + "<tr>");
							}
							if (j !== 4){
								$("#detailReview").html($("#detailReview").html() + "<td>" + temp[i][j] + "</td>");
							}
							if (j === 4){
								$("#detailReview").html($("#detailReview").html() + "</tr>");	
							}
						}
					}
				}); 
			}
			function komenBuku(user_id){
				var idBuku = $("#book_id").val();
				var isi = $("#update-reviewBuku").val();
				$.ajax({
					url: "http://localhost/tp2/ajax.php",
					datatype: "html",
					data: { book_id : idBuku, user_id : user_id, content : isi, command : "komentar" },
					method: "POST"
				}).done(function(obj){
					console.log(obj);
					var temp = JSON.parse(obj);
					$("#reviewBuku").html("");
					$("#reviewBuku").html(temp[3] + " " + temp[4]);
				});ts3
			}
		</script>
	</body>
</html>							