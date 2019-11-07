<?php
// error_reporting(E_ALL);
// ini_set('display_errors',1);
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "ebookhub";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " + mysqli_connect_error());
    }
    return $conn;
}
$target_dir = __DIR__ . "/../file_buku/";
$name_file = $_FILES["fileToUpload"]["name"];
$target_file = $target_dir . basename($name_file);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file is on .doc or .docx format
$type_apr = array('doc','docx');
$x = explode('.', $name_file);
$ekstensi = strtolower(end($x));
if(isset($_POST["submit"])) {
    if(in_array($ekstensi, $type_apr) === true) {
        echo "File is a document.";
        $uploadOk = 1;
    } else {
        echo "File is not a document.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 52428800) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "doc" && $fileType != "docx" && $fileType != "pdf"
&& $fileType != "txt" ) {
    echo "Sorry, only DOC, DOCX, PDF, TXT files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $conn = connectDB();
        $judulBuku = $_POST['judulBuku'];
        $namaPenulis = $_POST['namaPenulis'];
        $kategori = $_POST['kategori'];
        $deskripsiBuku = $_POST['deskripsiBuku'];
        $file = $_POST['fileBuku'];
        $tanggalUpload = date("Y-m-d");
        $status = 'Dalam proses penyuntingan';
        $_SESSION["titlebookadded"] = $judulBuku;
		
        $sql = "INSERT into unggah (title, author, category, description, file, upload_date, status) values('$judulBuku', '$namaPenulis', '$kategori', '$deskripsiBuku', '$file', '$tanggalUpload', '$status')";

        if($result = mysqli_query($conn, $sql)) {
            echo "New record created successfully <br/>";
            header("Location: ../unggah.php");
        } 
        else {
            die("Error: $sql");
        }
    } else {
        echo "Sorry, there was an error ". $_FILES['fileToUpload']['error']. " uploading your file.";
    }
}
?>