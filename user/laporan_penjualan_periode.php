<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";
# Deklarasi variabel
$filterSQL = ""; 
$tglAwal	= ""; 
$tglAkhir	= "";

# Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
$tglAwal 	= isset($_POST['cmbTglAwal']) ? mysql_real_escape_string($_POST['cmbTglAwal']) : "01-".date('m-Y');
$tglAkhir 	= isset($_POST['cmbTglAkhir']) ? mysql_real_escape_string($_POST['cmbTglAkhir']) : date('d-m-Y');

// Jika tombol filter tanggal (Tampilkan) diklik
if (isset($_POST['btnTampil'])) {
	// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterSQL = "WHERE ( tgl_penjualan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
else {
	// Membaca data tanggal dari URL, saat menu Pages diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? mysql_real_escape_string($_GET['tglAwal']) : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? mysql_real_escape_string($_GET['tglAkhir']) : $tglAkhir; 
	
	// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterSQL = "WHERE ( tgl_penjualan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$barisData 	= 50;
$halaman 	= isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql 	= "SELECT penjualan_item.*, penjualan.tgl_penjualan FROM penjualan_item
			  LEFT JOIN penjualan ON penjualan_item.kd_jual=penjualan.kd_jual $filterSQL"; 
$pageQry 	= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumData	= mysql_num_rows($pageQry);
$maksData	= ceil($jumData/$barisData);

// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");
?>
<html>
<head>
<title> :: Laporan Pembelian Per Periode</title>
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css"/>
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
</head>
<body>
<h2>LAPORAN PENJUALAN PER PERIODE</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table class="table table-striped table-bordered table-condensed">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>PERIODE PENJUALAN </strong></td>
    </tr>
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="391"><input name="cmbTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" />
        s/d <input name="cmbTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
  <br>
</form>
<table class="table table-striped table-bordered table-condensed">
  <tr>
    <td width="21" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="79" bgcolor="#CCCCCC"><strong>Tanggal</strong></td>
    <td width="108" bgcolor="#CCCCCC"><strong>No. Penjualan </strong></td>
    <td width="70" align="left" bgcolor="#CCCCCC"><strong>Kode Barang</strong></td>
    <td width="48" align="right" bgcolor="#CCCCCC"><strong>Jumlah</strong></td>
    <td width="85" align="right" bgcolor="#CCCCCC"><strong>Sub Total (Rp.)</strong></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan$subTotalJual	= 0;
	$grandTotalJual	= 0;
	$jumlahbarang	= 0;
	// SQL menampilkan item barang yang dijual
	$mySql ="SELECT penjualan_item.*, penjualan.tgl_penjualan FROM penjualan_item
			  LEFT JOIN penjualan ON penjualan_item.kd_jual=penjualan.kd_jual $filterSQL
			  ORDER BY penjualan_item.kd_jual DESC LIMIT $halaman, $barisData";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$nomor  = 0;  
	while($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$subTotalJual 	= $myData['jumlah'] * $myData['harga'];
		$grandTotalJual	= $grandTotalJual + $subTotalJual;        $jumlahbarang	= $jumlahbarang + $myData['jumlah'];
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
    <td><?php echo $myData['kd_jual']; ?></td>
    <td align="left"><?php echo $myData['kd_barang']; ?></td>
    <td align="right"><?php echo $myData['jumlah']; ?></td>
    <td align="right"><?php echo format_angka($subTotalJual); ?></td>
    <td width="37" align="center"><a href="penjualan/penjualan_cetak.php?noNota=<?php echo $myData ['kd_jual'];?>" target="_blank">Cetak</a></td>
    <td width="45" align="center"><a href="penjualan/penjualan_nota.php?noNota=<?php echo $myData ['kd_jual'];?>" target="_blank">Nota</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right" bgcolor="#F5F5F5"><strong>GRAND TOTAL : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><b><?php echo $jumlahbarang; ?></b></td>
    <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($grandTotalJual); ?></b></td>
    <td colspan="2" bgcolor="#F5F5F5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><strong>Jumlah Data :<?php echo $jumData; ?></strong></td>
    <td colspan="2" align="right"><strong>Halaman ke :
      <?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $barisData * $h - $barisData;
		echo " <a href='?open=Laporan-Penjualan&hal=$list[$h]'>$h</a> ";
	}
	?>
    </strong></td>
  </tr>
</table>
</body>
</html>