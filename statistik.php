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
	
	function statusPengajuan($status, $date) {
		$conn = connectDB();
		
		$sql = "SELECT * FROM unggah
				WHERE status = '".$status."' AND upload_date LIKE '".$date."'";
		
		if(!$result = mysqli_query($conn, $sql)) {
			die("Error: $sql");
		}
		mysqli_close($conn);
		return $result;
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
		<link rel="stylesheet" href="css/all.min.css">
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
					<li><a href="daftar.php">Daftar Buku</a></li>
					
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
					<li class="active"><a href="statistik.php">Statistik</a></li>

				
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
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Statistik</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Penjualan</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary" style="color:#007bff"></i> Non Fiksi
                  </span>

                  <span>
                    <i class="fas fa-square text-gray" style="color:#ced4da"></i> Fiksi
                  </span>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pengajuan</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fa-square text-primary" style="color:#007bff"></i> Dalam proses pengajuan
                  </span>

                  <span>
                    <i class="fa-square text-gray" style="color:#ced4da"></i> Sudah diterima
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="js/jquery-3.1.0.min.js"> </script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>	

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="js/Chart.min.js"></script>
<script>
$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : ['JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
		  data           : [10,
							15,
							10, 
							5, 
							<?php 
							$jumlah_pengajuan = statusPengajuan("Dalam Proses Penyuntingan", "%2019-11%");
							echo mysqli_num_rows($jumlah_pengajuan);
							?>]
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
		  data           : [6,
							10,
							20, 
							18, 
							<?php 
							$jumlah_pengajuan = statusPengajuan("Sudah Diterima", "%2019-11%");
							echo mysqli_num_rows($jumlah_pengajuan);
							?>]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })

  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : ['Juli', 'Agustus', 'September', 'Oktober', 'November'],
      datasets: [{
        type                : 'line',
        data                : [96, 50, 60, 85, 83],
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
        {
          type                : 'line',
          data                : [30, 40, 35, 33, 40, 38],
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
</script>
<!-- <script src="dist/js/dashboard3.js"></script> -->
	</body>
	<footer>
		<hr>
		<h4>&copy; 2019 Litehub Inc. All rights reserved</h4>
	</footer>
</html>							

