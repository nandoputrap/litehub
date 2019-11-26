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

?>

<div class="register">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="register-title">Status Pembayaran?</h1>
        
        <div class="btn-metode-pembayaran">
        <div class="row">
            <div class="col-md-6">
              <a href="buku-saya.php" class="btn btn-success btn-block btn-register btn-lg">
              <?php 
                $conn = connectDB();
                if (isset($_GET['id'])) {
                  $no = $_GET['id'];
                  $user_id = $_SESSION['user_id'];
                  $datePaid = date("Y-m-d");
                  $query = mysqli_query($conn, "INSERT INTO purchase (book_id, user_id, date) VALUES ('$no', '$user_id', '$datePaid')");
                  echo 'SUCCESS';
                }
              ?>
              </a>
              
            </div>
            <div class="col-md-6">
              <a href="buku-saya.php" class="btn btn-danger btn-block btn-register btn-lg">FAILED</a>
            </div>
          </div>
        </div>
                 
      </div>

      <div class="col-md-9 form-register-group">
        <form>
        </form>
      </div>

    </div>


  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
