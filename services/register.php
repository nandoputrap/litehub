<?php
	
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
    
    function daftarUser($table) {
		$conn = connectDB();
		
		$sql = "SELECT * FROM $table";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = connectDB();
		// username and password sent from form 
		session_start();
		
		$username = $_POST['username'];
        $password = $_POST['password']; 
        $role = $_POST['role']; 
        
        $daftaruser = daftarUser("user");
		$sdhAda = false;
		$last = 0;
		while ($row = mysqli_fetch_row($daftaruser)) {	
			if($row[1] == $username) {
				$sdhAda = true;
				break;
			}
			$last = $row[0];
		}
        $_SESSION["namauser"] = $username;
		$_SESSION["role"] = $role;
		$_SESSION["user_id"] = $last + 1;
		
		if($sdhAda == true) {
            echo  "<script type='text/javascript'>alert('Register Gagal');</script>";
		} else {
			$sql = "INSERT INTO user(username, password, role) VALUES('$username', '$password', LOWER('$role'))";
		}

		if($result = mysqli_query($conn, $sql)) {
			if ($row["role"] === "user"){
				header("Location: ../home.php");
			}else if ($row["role"] === "penulis"){
				header("Location: ../unggah.php");
			}else if ($row["role"] === "editor"){
				header("Location: ../unduh.php");
			}else{
				header("Location: ../daftar.php");
			}
		} else {
		    die("Error: $sql");
		}
		mysqli_close($conn);
					
	}
	
?>