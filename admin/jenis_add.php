<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once "library/inc.seslogin.php";
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";
# SKRIP SAAT TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Membaca Variabel Form
	$txtNama	= mysql_real_escape_string($_POST['txtNama']);
	$txtUkuran	= mysql_real_escape_string($_POST['txtUkuran']);
	# Validasi Form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Jenis</b> tidak boleh kosong !";		
	}
	if (trim($txtUkuran)=="") {
		$pesanError[] = "Data <b>Ukuran</b> tidak boleh kosong !";		
	}
	
	# Menampilkan pesan Error dari validasi
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database
		
		$mySql	= "INSERT INTO jenis (nama_jenis, ukuran) VALUES('$txtNama', '$txtUkuran')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Jenis-Data'>";
		}
		exit;
	}	
}

# VARIABEL DATA UNTUK DIBACA FORM
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah

$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataUkuran	= isset($_POST['txtUkuran']) ? $_POST['txtUkuran'] : '';

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th colspan="3" scope="col">TAMBAH DATA KATEGORI </th>
    </tr>
    <tr>
      <td width="181"><strong>Nama Jenis </strong></td>
      <td width="3">:</td>
      <td width="1019"><input name="txtNama" value="<?php echo $dataNama; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Ukuran</strong></td>
      <td>:</td>
      <td><input name="txtUkuran" value="<?php echo $dataUkuran; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN "></td>
    </tr>
  </table>
</form>
