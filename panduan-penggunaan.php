<?php
  require_once("templates/header.php");
?>

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
?>

<div class="about section-margin">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Panduan Penggunaan</h1>

        <img src="https://i.ibb.co/St1dWxg/panduan-publikasi.png" alt="">

        <img src="https://i.ibb.co/DkdcrR7/panduan-unduh.png" alt="">
      </div>
    </div>
  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
