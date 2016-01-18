<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$barisData 	= 50;
$halaman 	= isset($_GET['hal']) ? mysql_real_escape_string($_GET['hal']) : 0;
$pageSql 	= "SELECT * FROM penjualan";
$pageQry 	= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumData	= mysql_num_rows($pageQry);
$maksData	= ceil($jumData/$barisData);
?>
<h2> DATA TRANSAKSI PENJUALAN </h2>
<br />
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="?open=Penjualan-Baru" target="_self">Penjualan Baru</a> | 
	<a href="?open=Penjualan-Tampil" target="_self">Tampil Penjualan</a> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


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
			  LEFT JOIN penjualan ON penjualan_item.kd_jual=penjualan.kd_jual
			  ORDER BY penjualan_item.kd_jual DESC LIMIT $halaman, $barisData";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$jumData	= mysql_num_rows($myQry);
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
    
    <td width="45" align="center"><a href="penjualan/penjualan_nota.php?noNota=<?php echo $myData ['kd_jual'];?>" target="_blank">Nota</a></td>
    <td width="37" align="center"><a href="?open=Penjualan-Hapus&amp;Kode=<?php echo $myData ['kd_jual'];?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENJUALAN INI ... ?')">Delete</a></td>
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
<p>&nbsp;</p>
