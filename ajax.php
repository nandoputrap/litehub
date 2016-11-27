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
	
	function detailBuku($book_id) {
		
		$conn = connectDB();
		
		$sql = "SELECT * FROM book WHERE book_id = $book_id";
		
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_array();
		// echo $row[5];
		// if(!$result = mysqli_query($conn, $sql)) {
			// die("Error: $sql");
		// }
		
		// $row = mysqli_fetch_row($result);
		// echo $row[0];
		//$hasil='';
		//$hasil.=(($hasil!=''?',':'').'{"book_id":"'.$baris[1].'","nama":"'.trim($ar[2]).'"}');
		mysqli_close($conn);
		$json =  json_encode($row);
		//return '{"detailBuku":['.$hasil.']}';
		return $json;
		
	}
	
	function reviewBuku($book_id) {
		
		$conn = connectDB();
		
		$sql = "SELECT * FROM review WHERE book_id = $book_id";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		
		$row = mysql_fetch_row($result);
		mysqli_close($conn);
		$json =  json_encode($row);
		return $json;
		
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ($_POST['command'] === 'detail'){
			$detail = detailBuku($_POST['book_id']);
			echo $detail;
		}else if ($_POST['command'] === 'review'){
			$review = reviewBuku($_POST['book_id']);
			echo $review;
		}			
	}
?>