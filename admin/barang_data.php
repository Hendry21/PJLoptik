<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
error_reporting(0);



// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		$filterSql = "WHERE nama_barang LIKE '%$dataCari%'";
	}
}
else {
	if($KeyWord){
		$filterSql = "WHERE nama_barang LIKE '%$dataCari%'";
	}
	else {
		$filterSql = "";
	}
} 

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang $filterSql";
$pageQry = mysql_query($pageSql) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<style type="text/css">
#form1 {
	text-align: right;
}
</style>

<h2> MANAJEMEN DATA BARANG </h2>

<br />
<table class="table table-condensed">
  <tr>
    <td width="123"><a href="?open=Barang-Add" target="_self"><img src="../images/btn_add_data.png" alt="" height="30" border="0" /></a></td>
    <td width="461" height="32"><a href="?open=Barang-Data" target="_self"><img src="../images/btn_show.png" height="34" border="0" /></a></td>
    <td width="228"><form name="cari" method="post" action="?open=Barang-Data" id="form1">
      <b>
      <input name="txtCari" type="text" value="<?php echo $dataCari; ?>"  placeholder="Cari Nama Barang"/>
      <input name="btnCari" type="submit" value="Cari" />
      </b></a>
    </form></td>
  </tr>
</table>
<table class="table table-striped table-bordered table-condensed" width="901" border="0" cellspacing="1" cellpadding="2">
  <tr >
    <th align="center" bgcolor="#CCCCCC">No</th>
    <th bgcolor="#CCCCCC">Kode</th>
    <th bgcolor="#CCCCCC">Nama Barang</th>
    <th bgcolor="#CCCCCC">Merk</th>
    <th align="center" bgcolor="#CCCCCC">Jenis Ukuran</th>
    <th align="right" bgcolor="#CCCCCC">H Beli(Rp)</th>
    <th width="83" align="right" bgcolor="#CCCCCC">H Jual(Rp)</th>
    <th width="51" align="right" bgcolor="#CCCCCC">Stok</th>
    <th colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></th>
  </tr>
  <?php
	$mySql = "SELECT * FROM barang $filterSql ORDER BY kd_barang ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td bordercolor="#000000"><?php echo $myData['kd_barang']; ?></td>
    <td bordercolor="#000000"><?php echo $myData['nama_barang']; ?></td>
    <td bordercolor="#000000"><?php echo $myData['merk']; ?></td>
    <td  align="center" bordercolor="#000000"><?php echo $myData['nama_jenis']; ?><?php echo $myData['ukuran']; ?></td>
    <td  align="center" bordercolor="#000000"><?php echo format_angka($myData['harga_beli']); ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
    <td align="right"><?php echo format_angka($myData['stok']); ?></td>
    <td align="center"><a href="?open=Barang-Edit&amp;Kode=<?php echo $myData ['kd_barang']; ?>" target="_self" alt="Edit Data">Edit</a></td>
    <td align="center"><a href="?open=Barang-Delete&amp;Kode=<?php echo $myData ['kd_barang']; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BARANG INI ... ?')">Delete</a></td>
  </tr>
  <?php } ?>
  <tr  >
    <td colspan="4"><strong>Jumlah Data :</strong> <?php echo $jml; ?></td>
    <td colspan="6" align="right"><strong>Halaman ke :</strong>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pencarian-Pasien&hal=$list[$h]&KeyWord=$dataCari'>$h</a> ";
	}
	?></td>
  </tr>
</table>
<p>&nbsp;</p>
