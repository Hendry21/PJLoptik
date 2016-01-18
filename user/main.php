<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


if(isset($_SESSION['SES_LOGIN'])) {
	echo "<h2>Selamat pada PROGRAM PENJUALAN OPTIK !</h2>";
	echo "<b> Anda berhasil login";
	
}
else {
	echo "<h2>Selamat datang PROGRAM PENJUALAN OPTIK !</h2>";
	echo "<b>Anda belum login, silahkan <a href='?open=Login' alt='Login'>login </a>untuk mengakses sitem ini ";	
	exit;
}
?>