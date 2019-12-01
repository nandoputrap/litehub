<?php
    function connectDB() {
		$servername = "sql12.freesqldatabase.com";
		$username = "sql12313869";
		$password = "qy1jlUjdiy";
		$dbname = "sql12313869";
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " + mysqli_connect_error());
		}
		return $conn;
	}
    $conn = connectDB();		
    $diterima = 'Sudah Diterbitkan';
    $idUnggah = '0';
    $sql = "UPDATE unggah SET status = '$diterima' WHERE status = '$idUnggah'";
    if($result = mysqli_query($conn, $sql)) {
		echo "New record created successfully <br/>";
		header("Location: ../daftar-pengajuan.php");
    }else {
        die("Error: $sql");
    }
    mysqli_close($conn);
?>