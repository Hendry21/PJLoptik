
<?php
session_start();
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";
define('BASEPATH','TEST');
// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");

if(isset($_SESSION['SES_LOGIN']))
{
   
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Penjualan Optik</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                  <a class="navbar-brand" href="index.php"><i class="fa fa-xing">      Aplikasi Penjualan Optik</i></a>
          </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['SES_USER']; ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li>
                          <a href="?open=User-Edit&Kode=<?php echo $_SESSION['SES_LOGIN']; ?>">Profile Settings</a>                      </li>
                      
                      <li class="divider"></li>
                      <li>
                          <a href='../login_out.php' title='Logout (Exit)' onclick="if (confirm(&quot;Do you want Logout ?&quot;)) { return true; } return false;">Log Out</a>
                      </li>
                </ul>
              </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
         <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href='index.php'><i class="fa fa-fw fa-desktop"></i> Beranda</a>
                    </li>
                   
                   
                   <li><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-file-text"></i> Laporan <i class="fa fa-fw fa-caret-down"></i></a></li>
        <li><ul class="legal-menu nav nav-list collapse">
            <li><a href="?open=Laporan-User"><i class="fa fa-caret-right"> </i> Laporan Data User</a></li>
			<li><a href="?open=Laporan-Merk"><i class="fa fa-caret-right"> </i> Laporan Data Merk Barang</a></li>			
			<li><a href="?open=Laporan-Barang"><i class="fa fa-caret-right"> </i> Laporan Data Barang</a></li>
			<li><a href="?open=Laporan-Penjualan"><i class="fa fa-caret-right"> </i> Laporan Penjualan</a></li>
			<li><a href="?open=Laporan-Penjualan-Periode"><i class="fa fa-caret-right"> </i> Laporan Penjualan per Periode</a></li>
    </ul></li>
                   
                </ul>
          </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                      <div class="col-lg-12">
                        
                        <?php include "buka_file.php";?>
                    
          	
		
    </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>
<?php 
}
else
{
	 header("Location:../index.php");
}

?>