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
	function getpenulis() {
		$conn = connectDB();
		
		$sql = "SELECT count(*) FROM user WHERE role = 'penulis'";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}

		mysqli_close($conn);
		return $result;
	}

	function getpembaca() {
		$conn = connectDB();
		
		$sql = "SELECT count(*) FROM user WHERE role = 'user'";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}

		mysqli_close($conn);
		return $result;
	}
	function getbook() {
		$conn = connectDB();
		
		$sql = "SELECT count(*) FROM book";
		
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

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EBOOKHUB.ID</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
			</div>
		</div>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Ebookhub.ID</a>
				</div>
				<ul class="nav navbar-nav">
					<?php
					if(isset($_SESSION['namauser']) && $_SESSION['role'] === 'user') {
						echo '
						<li><a href="home.php">Home</a></li>
						';
					}
					?>
					<li class="active"><a href="dashboard.php">Dashboard</a></li>
					<li class="active"><a href="daftar.php">Daftar Buku</a></li>
					<li>
					<form action="search.php" method="GET">
    					<input type="text" name="query" placeholder="Judul buku/penulis"/>
						<input type="submit" value="Cari" />
					</form>
					</li>
					
					<?php
					if(isset($_SESSION['namauser']) && $_SESSION['role'] === 'penulis') {
						echo '
						<li><a href="unggah.php">Unggah Buku</a></li>
						';
					}
					
					?>
					<?php
					if(isset($_SESSION['namauser']) && $_SESSION['role'] === 'editor') {
						echo '
						<li><a href="unduh.php">Unduh Buku</a></li>
						';
					}
					?>
				
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
						if (isset($_SESSION["namauser"])){
							echo "<li><a href='services/logout.php'><span class='glyphicon glyphicon-log-out'></span>Logout</a></li>";
						}else if(!isset($_SESSION['namauser'])) {
							echo '
								<form class="form-inline navbar-form navbar-left" action="index.php" method="post">
									<div class="form-group">
										<label style="color:white;" for="username">Username</label>
										<input type="text" class="form-control" id="insert-username" name="username" placeholder="Username" required>
									</div>
									<div class="form-group">
										<label style="color:white;" for="password">Password</label>
										<input type="password" class="form-control" id="insert-password" name="password" placeholder="Password" required>
									</div>
									<input type="hidden" id="insert-command" name="command" value="insert">
									<button type="submit" class="btn btn-default">Login</button>
								</form>
							';
						}
					?>
				</ul>
			</div>
		</nav>
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Statistic</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
            <div class='col-lg-3 col-md-6'>
                <div class='panel panel-primary panel-ebookhub-red'>
                    <div class='panel-heading'>
                        <div class='row'>
                            <div class='col-xs-3'>
                                <i class='fa fa-pen fa-5x'></i>
                            </div>
                            <div class='col-xs-9 text-right'>
                                            <!-- here i want to fetch result -->
                                            <div id="leadmonth"></div>
                                <div>Total Penulis</div>
				<?php 
					$countuser = getpenulis();
					while ($row = mysqli_fetch_row($countuser)) {
						echo '<h1>'.$row[0].'</h1>';
					}
				?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-lg-3 col-md-6'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <div class='row'>
                            <div class='col-xs-3'>
                                <i class='fa fa-user fa-5x'></i>
                            </div>
                            <div class='col-xs-9 text-right'>
                                            <!-- here i want to fetch result -->
                                            <div id="leadmonth"></div>
                                <div>Total Pembaca</div>
																<?php 
																	$countuser = getpembaca();
																	while ($row = mysqli_fetch_row($countuser)) {
																		echo '<h1>'.$row[0].'</h1>';
																	}
																	?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-lg-3 col-md-6'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <div class='row'>
                            <div class='col-xs-3'>
                                <i class='fa fa-book fa-5x'></i>
                            </div>
                            <div class='col-xs-9 text-right'>
                                            <!-- here i want to fetch result -->
                                            <div id="leadmonth"></div>
                                <div>Total Buku Terbit</div>
																<?php 
																	$countuser = getbook();
																	while ($row = mysqli_fetch_row($countuser)) {
																		echo '<h1>'.$row[0].'</h1>';
																	}
																	?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-lg-3 col-md-6'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <div class='row'>
                            <div class='col-xs-3'>
                                <i class='fa fa-book fa-5x'></i>
                            </div>
                            <div class='col-xs-9 text-right'>
                                            <!-- here i want to fetch result -->
                                            <div id="leadmonth"></div>
                                <div>Total Buku</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">User Register Statistics</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">820</span>
                    <span>Register Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray" style="color:gray"></i> Last Week
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200" ></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray" style="color:gray"></i> Last year
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
		<script src="js/jquery-3.1.0.min.js"> </script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/home.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>	
		
		<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
	</body>
	<footer>
		<hr>
		<h4>&copy; 2019 Litehub Inc. All rights reserved</h4>
	</footer>
</html>							

