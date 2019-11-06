<?php
	session_start();
	function connectDB() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ebookhub";
		
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
		
		$sql = "SELECT no, title, author, category, description, file, upload_date, status FROM $table";
		
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

	function unggahBuku() {
		$conn = connectDB();
		
		$judulBuku = $_POST['judulBuku'];
		$namaPenulis = $_POST['namaPenulis'];
		$kategori = $_POST['kategori'];
		$deskripsiBuku = $_POST['deskripsiBuku'];
		$file = $_POST['fileBuku'];
		$tanggalUpload = date("Y-m-d");
		$status = 'Dalam proses penyuntingan';

		$daftarbuku = daftarBuku("unggah");

		
		// if(isset($_POST['submit']))
		// {

    if (isset($_POST['submit'])) {

		$currentDir = getcwd();
    $uploadDirectory = "/file_buku/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['doc','docx']; // Get all the file extensions

    $fileName = $_FILES['fileBuku']['name'];
    $fileSize = $_FILES['fileBuku']['size'];
    $fileTmpName  = $_FILES['fileBuku']['tmp_name'];
    $fileType = $_FILES['fileBuku']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
	die($fileName . $fileSize);
    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    // }
		// 	$temp_file = $_FILES['fileBuku']['tmp_name'];
		// 	$name_file = $_FILES['fileBuku']['name'];
		// 	$type = $_FILES['fileBuku']['type'];
		// 	$x = explode('.', $name_file);
        // 	$ekstensi = strtolower(end($x));
		// 	$type_apr = array('doc','docx');
		// 	$size = $_FILES['fileBuku']['size'];
		// 	$folder = "file_buku/";
		// 	die($temp_file);
		// 	if ($size < 52428800 and (in_array($ekstensi, $type_apr) === true)) {
		// 		move_uploaded_file($temp_file, $folder . $name_file);
		// 		mysqli_query($conn, "INSERT into unggah (file) values ('$name_file')");
		// 		header('location:unggah.php');
				
		// 	}else{
		// 		echo "Gagal Upload File";
		// 	}
		}

		// if($_POST['submit']){
		// 	$fileTmpPath = $_FILES['fileBuku']['tmp_name'];
		// 	$fileName = $_FILES['fileBuku']['name'];
		// 	$fileSize = $_FILES['fileBuku']['size'];
		// 	$fileType = $_FILES['fileBuku']['type'];
		// 	$fileNameCmps = explode(".", $fileName);
		// 	$fileExtension = strtolower(end($fileNameCmps));
			// $diizinkan	= array('doc','docx');
			// $nama = $_FILES['fileBuku']['name'];
			// $x = explode('.', $nama);
			// $ekstensi = strtolower(end($x));
			// $ukuran	= $_FILES['fileBuku']['size'];
			// $file_tmp = $_FILES['fileBuku']['tmp_name'];
			// $allowedfileExtensions = array('doc', 'docx');
			// if (in_array($fileExtension, $allowedfileExtensions)) {
			// 	$uploadFileDir = './file_buku/';
			// 	$dest_path = $uploadFileDir . $newFileName;
				
			// 	if(move_uploaded_file($fileTmpPath, $dest_path))
			// 	{
			// 		$message ='File is successfully uploaded.';
			// 	}
			// 	else
			// 	{
			// 		$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
			// 	}
			// }
			// if(in_array($ekstensi, $diizinkan) === true){
			// 	if($ukuran <= 52428800){			
			// 		move_uploaded_file($file_tmp, './file_buku/'.$nama);
			// 		$query = mysql_query("INSERT INTO unggah VALUES(NULL, '$nama')");
			// 		if($query){
			// 			echo 'FILE BERHASIL DI UPLOAD';
			// 		}else{
			// 			echo 'GAGAL MENGUPLOAD FILE';
			// 		}
			// 	}else{
			// 	echo 'UKURAN FILE TERLALU BESAR';
			// 	}
			// }else{
			// 	echo 'EKSTENSI INI TIDAK DIPERBOLEHKAN';
			// }
		// }

		$_SESSION["titlebookadded"] = $judulBuku;
		
		$sql = "INSERT into unggah (title, author, category, description, file, upload_date, status) values('$judulBuku', '$namaPenulis', '$kategori', '$deskripsiBuku', '$file', '$tanggalUpload', '$status')";

		if($result = mysqli_query($conn, $sql)) {
			echo "New record created successfully <br/>";
			// echo"
			// <script type='text/javascript'>
			// 	alert('Buku berhasil ditambahkan!');
			// 	history.back(self);
			// </script>";
			header("Location: unggah.php");
			} else {
			die("Error: $sql");
		}
		mysqli_close($conn);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['command'] === 'insert') {
			unggahBuku();
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
		<style>
			.labelunggah{
                font-style: normal;
                font-weight: bold;
                color: #0A5494;
                font-size: 20px;
            }
			.field-pengajuan{
                font-weight: bold;
                vertical-align: text-top;
                width: 130px; 
        	}
            .isi-pengajuan{
                text-align:justify;
            }
		</style>
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
					<li><a href="daftar.php">Daftar Buku</a></li>
					<li class="active"><a href="unggah.php">Unggah Buku</a></li>
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
		<div class="container">
            <?php
                if (isset($_SESSION["namauser"]) && $_SESSION["role"] === "admin"){
                    echo "<br><button type='button' class='btn-addbook btn btn-primary' data-toggle='modal' data-target='#insertModal'>
                        Unggah Buku
                    </button>";
                }
            ?>
            <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title black-modal" id="insertModalLabel">Unggah Buku</h4>
                        </div>
                        <div class="modal-body">
                            <form action="unggah.php" method="post">
								<div class="form-group">
                                    <label for="judulBuku">Judul Buku</label>
                                    <input type="text" class="form-control" id="insert-judulBuku" name="judulBuku" placeholder="Masukkan Judul Buku" required>
                                </div>
								<div class="form-group">
                                    <label for="namaPenulis">Nama Penulis</label>
                                    <input type="text" class="form-control" id="insert-namaPenulis" name="namaPenulis" placeholder="Masukkan Nama Penulis">
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
									<select class="form-control" id="insert-kategori" name="kategori" placeholder="Pilih Kategori">
										<option>Pilih kategori...</option>
									</select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsiBuku">Deskripsi Buku</label>
                                    <textarea class="form-control" id="insert-deskripsiBuku" name="deskripsiBuku" placeholder="Deskripsi Buku" rows="3"></textarea>
                                </div>
                                <div class="form-group" action="" enctype="multipart/form-data">
									<input type="file" id="insert-fileBuku" name="fileBuku">
									<!-- <button class="btn btn-secondary" method="post" action="upload.php" enctype="multipart/form-data">Upload Buku</button> -->
                					<h6>Format buku dalam bentuk .doc atau .docx. Format penulisan dan layout dapat dilihat pada halaman <a href="#">ini</a>. Ukuran file maksimal 50 MB.</h6>
                                </div>
                                <input type="hidden" id="insert-command" name="command" value="insert">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<div class="uploadpage">
				<form action="#" method="post">
					<label class="labelunggah">Menunggu Proses Pengajuan</label>
					<table class="table info-upload">
						<thead>
							<tr>
								<th>Judul Buku</th>
								<th>Penulis</th>
								<th>Tanggal Unggah</th>
								<th>Detail</th>
							</tr>
						</thead>
						<?php
							$daftarbuku = daftarBuku("unggah");
							if(isset($_SESSION['namauser'])) {
								$daftardiunggah = selectRowsFromSubmission();
							    $arraysubmission = array();
							    while ($baris = mysqli_fetch_row($daftardiunggah)) {
							    	array_push($arraysubmission, $baris[1]);
							    }
							}
							while ($row = mysqli_fetch_row($daftarbuku)) {
								 if($row[7] = "Dalam Proses Penyuntingan") {
									echo'
									<tbody>
									<tr>
										<td>'.$row[1].'</td>
										<td>'.$row[2].'</td>
										<td>'.$row[6].'</td>
										<td><a data-toggle="modal" data-target="#detailUpload" href="#detailUpload?id='.$row[1].'">Detail</a></td>
									</tr>
									</tbody>';
								 }
							}
						?>
					</table>
					<label class="labelunggah">Sudah Diterima</label>
					<table class="table info-upload">
						<thead>
							<tr>
								<th>Judul Buku</th>
								<th>Penulis</th>
								<th>Tanggal Unggah</th>
								<th>Detail</th>
							</tr>
						</thead>
						<?php
							$daftarbuku = daftarBuku("unggah");
							if(isset($_SESSION['namauser'])) {
								$daftardiunggah = selectRowsFromSubmission();
							    $arraysubmission = array();
							    while ($baris = mysqli_fetch_row($daftardiunggah)) {
							    	array_push($arraysubmission, $baris[1]);
							    }
							}
							while ($row = mysqli_fetch_row($daftarbuku)) {
								 if($row[7] == "Sudah Diterima") {
									echo'
									<tbody>
									<tr>
										<td>'.$row[1].'</td>
										<td>'.$row[2].'</td>
										<td>'.$row[6].'</td>
										<td><a data-toggle="modal" data-target="#detailUpload">Detail</a></td>
									</tr>
									</tbody>';
								 }
							}	
						?>
					</table>
				</form>
			</div>
			<?php
				$daftarbuku = daftarBuku("unggah");
				if(isset($_SESSION['namauser'])) {
					$daftardiunggah = selectRowsFromSubmission();
				    $arraysubmission = array();
				    while ($baris = mysqli_fetch_row($daftardiunggah)) {
				    	array_push($arraysubmission, $baris[1]);
				    }
				}
				while ($row = mysqli_fetch_array($daftarbuku)) {
					echo'
					<div class="modal fade" id="detailUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title black-modal" id="detailModalLabel">Detail Buku</h4>
								</div>
								<div class="modal-body">
									<table class="detail-pengajuan">
										<tbody>
											<tr>
												<td class="field-pengajuan">Judul Buku</td>
												<td class="isi-pengajuan">'.$row[1].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Nama Penulis</td>
												<td class="isi-pengajuan">'.$row[2].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Kategori</td>
												<td class="isi-pengajuan">'.$row[3].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Deskripsi</td>
												<td class="isi-pengajuan">'.$row[4].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Tanggal unggah</td>
												<td class="isi-pengajuan">'.$row[6].'</td>
											</tr>
											<tr>
												<td class="field-pengajuan">Status pengajuan</td>
												<td class="isi-pengajuan" style="font-weight: bold">'.$row[7].'</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>';
				}
			?>
        </div>
		<script src="js/jquery-3.1.0.min.js"> </script>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>	
	</body>
	<footer>
		<hr>
		<h4>&copy; 2019 Litehub Inc. All rights reserved</h4>
	</footer>
</html>							